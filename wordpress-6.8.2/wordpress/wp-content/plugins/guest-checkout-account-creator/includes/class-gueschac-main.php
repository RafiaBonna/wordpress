<?php

/**
 * Main plugin class file.
 *
 * @package GuestCheckoutAccountCreator
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main plugin class
 */
class GUESCHAC_Main
{
    /**
     * Single instance of the class
     *
     * @var GUESCHAC_Main
     */
    private static $instance = null;

    /**
     * Account creator instance
     *
     * @var GUESCHAC_Account_Creator
     */
    private $account_creator;

    /**
     * Email handler instance
     *
     * @var GUESCHAC_Email_Handler
     */
    private $email_handler;

    /**
     * Returns single instance of the class
     *
     * @return GUESCHAC_Main
     */
    public static function get_instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct()
    {
        $this->init_hooks();
        $this->init_handlers();
    }

    /**
     * Initialize hooks
     */
    private function init_hooks()
    {
        // Hook into WooCommerce checkout process
        add_action('woocommerce_checkout_order_processed', array($this, 'process_guest_checkout'), 10, 3);

        // Hook for older WooCommerce versions
        add_action('woocommerce_thankyou', array($this, 'process_guest_checkout_thankyou'), 10, 1);
    }

    /**
     * Initialize handlers
     */
    private function init_handlers()
    {
        if (class_exists('GUESCHAC_Account_Creator')) {
            $this->account_creator = new GUESCHAC_Account_Creator();
        }

        if (class_exists('GUESCHAC_Email_Handler')) {
            $this->email_handler = new GUESCHAC_Email_Handler();
        }
    }

    /**
     * Process guest checkout
     *
     * @param int   $order_id Order ID.
     * @param array $posted_data Posted data.
     * @param WC_Order $order Order object.
     */
    public function process_guest_checkout($order_id, $posted_data = array(), $order = null)
    {
        // Get order if not provided
        if (!$order) {
            $order = wc_get_order($order_id);
        }

        if (!$order) {
            return;
        }

        // Only process guest checkouts
        if ($order->get_customer_id() > 0) {
            return;
        }

        $this->process_order($order);
    }

    /**
     * Process guest checkout on thank you page (fallback)
     *
     * @param int $order_id Order ID.
     */
    public function process_guest_checkout_thankyou($order_id)
    {
        $order = wc_get_order($order_id);

        if (!$order || $order->get_customer_id() > 0) {
            return;
        }

        // Check if already processed
        if (get_post_meta($order_id, '_gueschac_processed', true)) {
            return;
        }

        $this->process_order($order);

        // Mark as processed
        update_post_meta($order_id, '_gueschac_processed', 1);
    }

    /**
     * Process order for account creation
     *
     * @param WC_Order $order Order object.
     */
    private function process_order($order)
    {
        // Check if plugin is enabled
        if (get_option('gueschac_enabled', 'yes') !== 'yes') {
            return;
        }

        // Check minimum order value if set
        $minimum_order = get_option('gueschac_minimum_order', '');
        if (!empty($minimum_order) && is_numeric($minimum_order)) {
            if ($order->get_total() < floatval($minimum_order)) {
                return;
            }
        }

        // Get customer email and sanitize it
        $customer_email = sanitize_email($order->get_billing_email());

        if (empty($customer_email)) {
            return;
        }

        // Check if user already exists
        if (email_exists($customer_email)) {
            $this->handle_existing_user($customer_email, $order);
            return;
        }

        // Create new account
        if (!$this->account_creator) {
            return;
        }

        $user_id = $this->account_creator->create_account($order);

        if (is_wp_error($user_id)) {
            // Log error
            wp_trigger_error(sprintf('GUESCHAC: Failed to create account for order %d: %s', $order->get_id(), $user_id->get_error_message()));
            return;
        }

        // Send welcome email
        if ($this->email_handler) {
            $this->email_handler->send_welcome_email($user_id, $order);
        }

        // Log success
        if (function_exists('wc_get_logger')) {
            $logger = wc_get_logger();
            $logger->info(
                sprintf('Account created for order %d, user ID: %d', $order->get_id(), $user_id),
                array('source' => 'guest-checkout-account-creator')
            );
        }
    }

    /**
     * Handle existing user
     *
     * @param string   $email Customer email.
     * @param WC_Order $order Order object.
     */
    private function handle_existing_user($email, $order)
    {
        // Ensure email is sanitized
        $email = sanitize_email($email);
        $user = get_user_by('email', $email);

        if ($user) {
            // Link order to existing user using HPOS compatible method
            if (function_exists('wc_update_order_customer_id')) {
                wc_update_order_customer_id($order->get_id(), absint($user->ID));
            } else {
                // Fallback for older versions
                $order->set_customer_id(absint($user->ID));
                $order->save();
            }
        }
    }
}
