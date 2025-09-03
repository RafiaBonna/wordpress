<?php

/**
 * WooCommerce Guest Checkout Account Creator Settings
 *
 * @package GuestCheckoutAccountCreator
 */

defined('ABSPATH') || exit;

// Ensure WooCommerce is loaded
if (!class_exists('WooCommerce')) {
    return;
}

if (!class_exists('WC_Settings_Page')) {
    include_once WC()->plugin_path() . '/includes/admin/settings/class-wc-settings-page.php';
}

/**
 * Settings class
 */
class GUESCHAC_WC_Settings extends WC_Settings_Page
{
    /**
     * Constructor.
     */    public function __construct()
    {
        $this->id    = 'gueschac';
        $this->label = __('Guest Checkout Accounts', 'guest-checkout-account-creator');

        parent::__construct();

        add_action('init', array($this, 'init_hooks'));
    }

    /**
     * Initialize hooks
     */
    public function init_hooks()
    {
        // Add the tab to WooCommerce settings
        add_filter('woocommerce_settings_tabs_array', array($this, 'add_settings_tab'), 50);

        // Add content to our tab
        add_action('woocommerce_settings_' . $this->id, array($this, 'output'));

        // Save settings
        add_action('woocommerce_settings_save_' . $this->id, array($this, 'save'));

        // Add sections
        add_action('woocommerce_sections_' . $this->id, array($this, 'output_sections'));

        // Enqueue admin scripts and styles
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts')); // Add sections
        add_action('woocommerce_sections_' . $this->id, array($this, 'output_sections'));
    }

    /**
     * Enqueue admin scripts and styles
     */    public function enqueue_admin_scripts()
    {
        $screen = get_current_screen();

        // Get current tab for admin interface navigation - nonce verification not required for GET parameters in admin interface
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        $current_tab = isset($_GET['tab']) ? sanitize_key(wp_unslash($_GET['tab'])) : '';

        if (!$screen || 'woocommerce_page_wc-settings' !== $screen->id || $this->id !== $current_tab) {
            return;
        }

        wp_enqueue_style(
            'gueschac-admin',
            plugins_url('/assets/css/admin.css', dirname(dirname(__FILE__))),
            array(),
            GUESCHAC_VERSION
        );

        wp_enqueue_script(
            'gueschac-admin',
            plugins_url('/assets/js/admin.js', dirname(dirname(__FILE__))),
            array('jquery'),
            GUESCHAC_VERSION,
            true
        );

        wp_localize_script(
            'gueschac-admin',
            'gueschac_params',
            array(
                'nonce' => wp_create_nonce('gueschac_admin_nonce'),
                'ajax_url' => admin_url('admin-ajax.php'),
                'i18n' => array(
                    'available_placeholders' => __('Available placeholders:', 'guest-checkout-account-creator'),
                    'site_name' => __('Your site name', 'guest-checkout-account-creator'),
                    'customer_name' => __('Customer\'s full name', 'guest-checkout-account-creator'),
                    'customer_email' => __('Customer\'s email address', 'guest-checkout-account-creator'),
                    'customer_password' => __('Generated password', 'guest-checkout-account-creator'),
                    'my_account_url' => __('WooCommerce My Account page URL', 'guest-checkout-account-creator'),
                    'order_number' => __('WooCommerce order number', 'guest-checkout-account-creator'),
                    'confirm_reset_template' => __('Are you sure you want to reset to the default email template? This will overwrite your current template.', 'guest-checkout-account-creator')
                )
            )
        );
    }
    /**
     * Add settings tab to WooCommerce
     *
     * @param array $settings_tabs Array of WooCommerce setting tabs.
     * @return array
     */
    public function add_settings_tab($settings_tabs)
    {
        $settings_tabs[$this->id] = $this->label;
        return $settings_tabs;
    }

    /**
     * Get sections.
     *
     * @return array
     */    public function get_sections()
    {
        return array(
            '' => __('Settings', 'guest-checkout-account-creator'),
        );
    }

    /**
     * Get settings array
     *
     * @return array
     */
    public function get_settings()
    {
        $settings = array(
            array(
                'title' => __('Guest Checkout Account Settings', 'guest-checkout-account-creator'),
                'type'  => 'title',
                'desc'  => __('Configure how guest checkout accounts are created.', 'guest-checkout-account-creator'),
                'id'    => 'gueschac_settings_section'
            ),

            array(
                'title'   => __('Enable/Disable', 'guest-checkout-account-creator'),
                'desc'    => __('Enable automatic account creation for guest checkouts', 'guest-checkout-account-creator'),
                'id'      => 'gueschac_enabled',
                'default' => 'yes',
                'type'    => 'checkbox'
            ),

            array(
                'title'             => __('Minimum Order Value', 'guest-checkout-account-creator'),
                'desc'              => __('Only create accounts for orders above this amount (optional)', 'guest-checkout-account-creator'),
                'id'                => 'gueschac_minimum_order',
                'default'           => '',
                'type'              => 'number',
                'custom_attributes' => array(
                    'min'  => '0',
                    'step' => '0.01'
                ),
                'css'               => 'width:100px;',
            ),

            array(
                'title'    => __('Welcome Email Subject', 'guest-checkout-account-creator'),
                'desc'     => __('Available placeholders: {site_name}, {customer_name}', 'guest-checkout-account-creator'),
                'id'       => 'gueschac_email_subject',
                'default'  => __('Welcome to {site_name} - Your Account Details', 'guest-checkout-account-creator'),
                'type'     => 'text',
                'css'      => 'min-width:400px;',
            ),

            array(
                'title'    => __('Welcome Email Content', 'guest-checkout-account-creator'),
                'desc'     => __('Available placeholders: {site_name}, {customer_name}, {customer_email}, {customer_password}, {my_account_url}, {order_number}', 'guest-checkout-account-creator'),
                'id'       => 'gueschac_email_content',
                'default'  => $this->get_default_email_content(),
                'type'     => 'textarea',
                'css'      => 'min-width:400px; height:200px;',
            ),

            array(
                'type' => 'sectionend',
                'id'   => 'gueschac_settings_section'
            )
        );

        return apply_filters('gueschac_get_settings_' . $this->id, $settings);
    }

    /**
     * Get default email content
     *
     * @return string
     */
    private function get_default_email_content()
    {
        return sanitize_textarea_field(__(
            "Hello {customer_name},

Thank you for your order #{order_number}! We're excited to let you know that we've created an account for you to manage your orders easily.

Your Account Details:
- Username: {customer_email}
- Password: {customer_password}
- Account URL: {my_account_url}

With your account, you can:
- Track your orders
- View order history
- Manage your shipping addresses
- Update your account details

Please keep your login credentials safe. You can change your password after logging in.

Thank you for shopping with {site_name}!",
            'guest-checkout-account-creator'
        ));
    }

    /**
     * Output the settings
     */
    public function output()
    {
        $settings = $this->get_settings();
        WC_Admin_Settings::output_fields($settings);
    }

    /**
     * Save settings
     */

    public function save()
    {
        // Verify nonce
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['_wpnonce'])), 'woocommerce-settings')) {
            wp_die(esc_html__('Security check failed. Please try again.', 'guest-checkout-account-creator'));
        }

        // Check user capabilities
        if (!current_user_can('manage_woocommerce')) {
            wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'guest-checkout-account-creator'));
        }

        // Check if this is a POST request
        if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $settings = $this->get_settings();        // Process and sanitize form data
        $fields_to_process = [
            'gueschac_email_subject' => 'sanitize_text_field',
            'gueschac_email_content' => 'sanitize_textarea_field',
            'gueschac_minimum_order' => 'sanitize_text_field'
        ];        // Create sanitized data array
        $sanitized_data = [];
        foreach ($fields_to_process as $field => $sanitize_function) {
            if (isset($_POST[$field])) {
                // Handle different field types appropriately
                if ($sanitize_function === 'sanitize_textarea_field') {
                    // For textarea fields, preserve newlines but sanitize content
                    // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
                    $raw_value = wp_unslash($_POST[$field]);
                } else {
                    // For other fields, use basic sanitization first
                    $raw_value = sanitize_text_field(wp_unslash($_POST[$field]));
                }
                $sanitized_data[$field] = $sanitize_function($raw_value);
            }
        }

        // Update $_POST with sanitized values
        foreach ($sanitized_data as $field => $sanitized_value) {
            $_POST[$field] = $sanitized_value;
        }

        // Save the settings
        WC_Admin_Settings::save_fields($settings);
    }


}
