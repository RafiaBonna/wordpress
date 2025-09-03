<?php

/**
 * Account creator class file.
 *
 * @package GuestCheckoutAccountCreator
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Account creator class
 */
class GUESCHAC_Account_Creator
{
    /**
     * Create user account from order
     *
     * @param WC_Order $order Order object.
     * @return int|WP_Error User ID or error
     */
    public function create_account($order)
    {
        // Get customer email
        $email = $order->get_billing_email();

        if (empty($email)) {
            return new WP_Error('no_email', __('No email address provided', 'guest-checkout-account-creator'));
        }

        // Check if user already exists
        if (email_exists($email)) {
            return new WP_Error('email_exists', __('Email address already registered', 'guest-checkout-account-creator'));
        }

        // Generate username from email
        $username = $this->generate_username($email);

        // Generate password
        $password = wp_generate_password(12, true, false);

        // Prepare user data with proper sanitization
        $user_data = array(
            'user_login' => sanitize_user($username),
            'user_email' => sanitize_email($email),
            'user_pass'  => $password, // Password should not be sanitized as it's already generated securely
            'role'       => 'customer',
            'first_name' => sanitize_text_field($order->get_billing_first_name()),
            'last_name'  => sanitize_text_field($order->get_billing_last_name()),
            'display_name' => sanitize_text_field(trim($order->get_billing_first_name() . ' ' . $order->get_billing_last_name())),
        );

        // Create user
        $user_id = wp_insert_user($user_data);

        if (is_wp_error($user_id)) {
            return $user_id;
        }

        // Store password temporarily for welcome email
        update_user_meta($user_id, '_gueschac_temp_pass', $password);

        // Link order to user using HPOS compatible method
        if (function_exists('wc_update_order_customer_id')) {
            wc_update_order_customer_id($order->get_id(), $user_id);
        } else {
            // Fallback for older versions
            $order->set_customer_id($user_id);
            $order->save();
        }

        // Store billing and shipping address
        $this->save_address_data($user_id, $order);

        /**
         * Fires after a new customer account is created
         *
         * @param int      $user_id User ID
         * @param WC_Order $order   Order object
         */
        do_action('gueschac_account_created', $user_id, $order);

        return $user_id;
    }

    /**
     * Generate username from email address
     *
     * @param string $email Email address.
     * @return string
     */
    private function generate_username($email)
    {
        // Sanitize email input
        $email = sanitize_email($email);

        // Get the part before @ symbol
        $username_parts = explode('@', $email);
        $username = sanitize_user($username_parts[0], true);

        // Ensure username is not empty
        if (empty($username)) {
            $username = 'user';
        }

        // Ensure username is unique
        $counter = 1;
        $base_username = $username;

        while (username_exists($username) || email_exists($username . '@example.com')) {
            $username = $base_username . $counter;
            $counter++;

            // Prevent infinite loop
            if ($counter > 1000) {
                $username = $base_username . wp_rand(1000, 9999);
                break;
            }
        }

        return sanitize_user($username);
    }

    /**
     * Save customer address data
     *
     * @param int      $user_id User ID.
     * @param WC_Order $order   Order object.
     */
    private function save_address_data($user_id, $order)
    {
        // Billing address fields
        $billing_fields = array(
            'billing_first_name',
            'billing_last_name',
            'billing_company',
            'billing_address_1',
            'billing_address_2',
            'billing_city',
            'billing_state',
            'billing_postcode',
            'billing_country',
            'billing_email',
            'billing_phone',
        );

        // Shipping address fields
        $shipping_fields = array(
            'shipping_first_name',
            'shipping_last_name',
            'shipping_company',
            'shipping_address_1',
            'shipping_address_2',
            'shipping_city',
            'shipping_state',
            'shipping_postcode',
            'shipping_country',
        );

        // Save billing address
        foreach ($billing_fields as $field) {
            $method = 'get_' . $field;
            if (method_exists($order, $method)) {
                $value = $order->$method();
                if (!empty($value)) {
                    // Sanitize based on field type
                    if (strpos($field, 'email') !== false) {
                        $value = sanitize_email($value);
                    } elseif (strpos($field, 'phone') !== false) {
                        $value = sanitize_text_field($value);
                    } else {
                        $value = wc_clean($value);
                    }
                    update_user_meta($user_id, sanitize_key($field), $value);
                }
            }
        }

        // Save shipping address
        foreach ($shipping_fields as $field) {
            $method = 'get_' . $field;
            if (method_exists($order, $method)) {
                $value = $order->$method();
                if (!empty($value)) {
                    // Sanitize based on field type
                    if (strpos($field, 'email') !== false) {
                        $value = sanitize_email($value);
                    } elseif (strpos($field, 'phone') !== false) {
                        $value = sanitize_text_field($value);
                    } else {
                        $value = wc_clean($value);
                    }
                    update_user_meta($user_id, sanitize_key($field), $value);
                }
            }
        }

        // Set default addresses
        update_user_meta($user_id, 'default_billing_address', '1');
        update_user_meta($user_id, 'default_shipping_address', '1');
    }
}
