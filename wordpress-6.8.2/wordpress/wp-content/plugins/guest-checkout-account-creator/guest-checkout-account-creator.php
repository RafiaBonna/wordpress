<?php

/** * Plugin Name: Guest Checkout Account Creator
 * Plugin URI: https://wpthemespace.com/product/guest-checkout-account-creator
 * Description: Automatically creates customer accounts for guest checkouts in WooCommerce.
 * Version: 1.0.2
 * Author: Noor Alam
 * Author URI: https://wpthemespace.com
 * Text Domain: guest-checkout-account-creator
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * License: GPL3
 * License URI: http://www.gnu.org/licenses/gpl.html
 * WC requires at least: 5.0
 * WC tested up to: 9.8
 *
 * @package GuestCheckoutAccountCreator
 */

defined('ABSPATH') || exit;



// Define plugin constants
define('GUESCHAC_VERSION', '1.0.2');
define('GUESCHAC_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('GUESCHAC_PLUGIN_URL', plugin_dir_url(__FILE__));
define('GUESCHAC_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * Main plugin class
 */
final class GUESCHAC_Main_Class
{
    /**
     * Single instance of the class
     *
     * @var GUESCHAC_Main_Class
     */
    protected static $_instance = null;

    /**
     * Main plugin instance
     *
     * @return GUESCHAC_Main_Class
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->define_constants();
        $this->init_hooks();
    }

    /**
     * Define plugin constants
     */
    private function define_constants()
    {
        $this->define('GUESCHAC_ABSPATH', dirname(__FILE__) . '/');
        $this->define('GUESCHAC_PLUGIN_FILE', __FILE__);
    }

    /**
     * Define constant if not already defined
     *
     * @param string $name
     * @param string|bool $value
     */
    private function define($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    /**
     * Initialize hooks
     */
    private function init_hooks()
    {
        add_action('plugins_loaded', array($this, 'plugins_loaded'));

        // Plugin activation and deactivation hooks
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));

        // Add settings link to plugins page
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'add_plugin_links'));

        // WooCommerce compatibility
        add_action('before_woocommerce_init', array($this, 'declare_compatibility'));
    }

   

    /**
     * Initialize plugin when plugins are loaded
     */
    public function plugins_loaded()
    {
        // Check if WooCommerce is active
        if (!$this->is_woocommerce_active()) {
            add_action('admin_notices', array($this, 'woocommerce_missing_notice'));
            return;
        }

        // Include required files
        $this->includes();

        // Initialize main functionality
        if (class_exists('GUESCHAC_Main')) {
            GUESCHAC_Main::get_instance();
        }        // Initialize admin functionality

    }

    /**
     * Include required files
     */
    private function includes()
    {
        // Core files
        require_once GUESCHAC_PLUGIN_DIR . 'includes/gueschac-functions.php';
        require_once GUESCHAC_PLUGIN_DIR . 'includes/class-gueschac-main.php';
        require_once GUESCHAC_PLUGIN_DIR . 'includes/gueschac-functions.php';
        require_once GUESCHAC_PLUGIN_DIR . 'includes/class-gueschac-account-creator.php';
        require_once GUESCHAC_PLUGIN_DIR . 'includes/class-gueschac-email-handler.php';

        // Admin includes
        if (is_admin()) {
            require_once GUESCHAC_PLUGIN_DIR . 'includes/admin/class-gueschac-wc-settings.php';
            require_once GUESCHAC_PLUGIN_DIR . 'includes/admin/admin-init.php';
        }
    }

    /**
     * Check if WooCommerce is active
     *
     * @return bool
     */
    private function is_woocommerce_active()
    {
        // Check active plugins
        $active_plugins = get_option('active_plugins', array());
        $is_active = in_array('woocommerce/woocommerce.php', $active_plugins);

        // Check multisite network activation
        if (!$is_active && is_multisite()) {
            $network_plugins = get_site_option('active_sitewide_plugins', array());
            $is_active = isset($network_plugins['woocommerce/woocommerce.php']);
        }

        // Verify WooCommerce class exists (confirms it's actually loaded)
        return $is_active && class_exists('WooCommerce');
    }

    /**
     * Declare WooCommerce compatibility
     */
    public function declare_compatibility()
    {
        if (class_exists('\Automattic\WooCommerce\Utilities\FeaturesUtil')) {
            \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
            \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('cart_checkout_blocks', __FILE__, false);
        }
    }

    /**
     * Display WooCommerce missing notice
     */
    public function woocommerce_missing_notice()
    {
?>
        <div class="error">
            <p><?php
                echo sprintf(
                    /* translators: %s: WooCommerce link */
                    esc_html__('Guest Checkout Account Creator requires %s to be installed and active.', 'guest-checkout-account-creator'),
                    '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a>'
                );
                ?></p>
        </div>
<?php
    }

    /**
     * Activation hook
     */
    public function activate()
    {
        // Check if WooCommerce is active
        if (!$this->is_woocommerce_active()) {
            deactivate_plugins(plugin_basename(__FILE__));
            wp_die(
                esc_html__('Guest Checkout Account Creator requires WooCommerce to be installed and active.', 'guest-checkout-account-creator'),
                esc_html__('Plugin Activation Error', 'guest-checkout-account-creator'),
                array('back_link' => true)
            );
        }        // Initialize default settings if they don't exist
        $default_settings = array(
            'gueschac_enabled' => 'yes',
            'gueschac_minimum_order' => '0',
            'gueschac_email_subject' => __('Welcome to {site_name} - Your Account Details', 'guest-checkout-account-creator'),
            'gueschac_email_content' => $this->get_default_email_content()
        );
        foreach ($default_settings as $key => $value) {
            if (get_option($key) === false) {
                update_option($key, $value);
            }
        }

        // Set activation flag
        update_option('gueschac_activated', true);

        // Clear any cached data
        if (function_exists('wp_cache_flush')) {
            wp_cache_flush();
        }
    }

    /**
     * Get default email content
     *
     * @return string
     */
    private function get_default_email_content()
    {
        return __(
            "Hello {customer_name},\n\nAn account has been created for you on {site_name}.\n\nYour login details:\nUsername: {customer_email}\nPassword: {customer_password}\n\nYou can access your account here: {my_account_url}\n\nThank you for shopping with us!",
            'guest-checkout-account-creator'
        );
    }

    /**
     * Deactivation hook
     */
    public function deactivate()
    {
        // Clear any cached data
        if (function_exists('wp_cache_flush')) {
            wp_cache_flush();
        }
    }

    /**
     * Add plugin links
     *
     * @param array $links
     * @return array
     */
    public function add_plugin_links($links)
    {
        $plugin_links = array(
            '<a href="' . admin_url('admin.php?page=wc-settings&tab=gueschac') . '">' . __('Settings', 'guest-checkout-account-creator') . '</a>',
        );
        return array_merge($plugin_links, $links);
    }
}

/**
 * Returns the main instance of GUESCHAC_Main_Class
 *
 * @return GUESCHAC_Main_Class
 */
function GUESCHAC()
{
    return GUESCHAC_Main_Class::instance();
}

// Global for backwards compatibility
$GLOBALS['gueschac_main_class'] = GUESCHAC();

