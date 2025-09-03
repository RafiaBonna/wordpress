<?php

/**
 * Admin initialization
 *
 * @package GuestCheckoutAccountCreator
 */

defined('ABSPATH') || exit;

/**
 * Initialize admin functionality
 */
// Initialize WooCommerce settings
add_filter('woocommerce_get_settings_pages', 'gueschac_add_settings_page', 20);

add_action('admin_notices', 'gueschac_admin_notices');

// Initialize other admin functionality
add_action('admin_init', function () {

    add_action('wp_ajax_gueschac_dismiss_notice', 'gueschac_dismiss_activation_notice');
});

add_action('admin_enqueue_scripts', 'gueschac_enqueue_admin_scripts');

/**
 * Add settings page
 *
 * @param array $settings Array of WC settings pages.
 * @return array
 */
function gueschac_add_settings_page($settings)
{
    $settings[] = new GUESCHAC_WC_Settings();
    return $settings;
}



/**
 * Enqueue admin scripts
 */
function gueschac_enqueue_admin_scripts()
{
    // Only enqueue on admin pages where notices might appear
    if (!is_admin()) {
        return;
    }

    wp_enqueue_script(
        'gueschac-admin-notices',
        plugins_url('/assets/js/notice.js', dirname(dirname(__FILE__))),
        array('jquery'),
        GUESCHAC_VERSION,
        true
    );

    // Localize script with data
    wp_localize_script('gueschac-admin-notices', 'gueschac_admin_notice', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('gueschac_admin_nonce')
    ));
}

/**
 * Show admin notices
 */
function gueschac_admin_notices()
{
    // Only show notices in admin area
    if (!is_admin()) {
        return;
    }
   
    // Activation notice
    if (get_option('gueschac_activated') && !get_option('gueschac_activation_notice_dismissed91')) {
?>
        <div class="notice notice-success is-dismissible" data-dismissible="gueschac-activated">
            <p><?php
                echo wp_kses(
                    sprintf(
                        /* translators: %s: Settings page link */
                        esc_html__('Guest Checkout Account Creator is now active! %s to configure the plugin.', 'guest-checkout-account-creator'),
                        '<a href="' . esc_url(admin_url('admin.php?page=wc-settings&tab=gueschac')) . '">' . esc_html__('Go to Settings', 'guest-checkout-account-creator') . '</a>'
                    ),
                    array('a' => array('href' => array()))
                );
                ?></p>
        </div>
        
<?php
   }
}

/**
 * Dismiss activation notice
 */
function gueschac_dismiss_activation_notice()
{
    check_ajax_referer('gueschac_admin_nonce', 'nonce');
    update_option('gueschac_activation_notice_dismissed91', true);
    wp_die();
}
