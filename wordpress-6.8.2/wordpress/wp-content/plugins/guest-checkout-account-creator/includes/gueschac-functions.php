<?php

/**
 * Helper functions
 *
 * @package GuestCheckoutAccountCreator
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get plugin settings
 *
 * @param string $key Optional setting key.
 * @param mixed  $default Default value if setting not found.
 * @return mixed
 */
function gueschac_get_settings($key = '', $default = false)
{
    // Sanitize the key input
    $key = sanitize_key($key);

    if (empty($key)) {
        return array(
            'enabled' => get_option('gueschac_enabled', 'yes'),
            'minimum_order' => get_option('gueschac_minimum_order', ''),
            'email_subject' => get_option('gueschac_email_subject', ''),
            'email_content' => get_option('gueschac_email_content', '')
        );
    }

    $option_name = 'gueschac_' . $key;
    return get_option($option_name, $default);
}

/**
 * Log message to WC_Logger
 *
 * @param string $message Message to log.
 * @param string $level Optional. Default 'info'. Possible values: emergency|alert|critical|error|warning|notice|info|debug.
 */
function gueschac_log($message, $level = 'info')
{
    if (!function_exists('wc_get_logger')) {
        return;
    }

    $logger = wc_get_logger();
    $context = array('source' => 'guest-checkout-account-creator');

    $logger->log($level, $message, $context);
}

/**
 * Generate a random password
 *
 * @return string
 */
function gueschac_generate_password()
{
    return wp_generate_password(12, true);
}

/**
 * Check if an order was placed by a guest
 *
 * @param WC_Order|int $order Order object or ID.
 * @return bool
 */
function gueschac_is_guest_order($order)
{
    if (is_numeric($order)) {
        $order = wc_get_order($order);
    }

    if (!$order) {
        return false;
    }

    return $order->get_customer_id() === 0;
}

/**
 * Get email template path
 *
 * @return string
 */
function gueschac_get_email_template_path()
{
    // Check if template exists in theme
    $template_path = locate_template('templates/emails/welcome-email.php');

    if (!$template_path) {
        $template_path = GUESCHAC_PLUGIN_DIR . 'templates/emails/welcome-email.php';
    }

    return $template_path;
}

/**
 * Format placeholders in text
 *
 * @param string $text Text with placeholders.
 * @param array  $data Data to replace placeholders.
 * @return string
 */
function gueschac_format_placeholders($text, $data)
{
    $placeholders = array();

    foreach ($data as $key => $value) {
        // Sanitize keys and values based on context
        $sanitized_key = sanitize_key($key);

        // Determine appropriate sanitization based on key type
        if (strpos($sanitized_key, 'url') !== false) {
            $sanitized_value = esc_url($value);
        } elseif (strpos($sanitized_key, 'email') !== false) {
            $sanitized_value = sanitize_email($value);
        } else {
            $sanitized_value = sanitize_text_field($value);
        }

        $placeholders['{' . $sanitized_key . '}'] = $sanitized_value;
    }

    return str_replace(array_keys($placeholders), array_values($placeholders), $text);
}

/**
 * Check if plugin dependencies are met
 *
 * @return bool
 */
function gueschac_dependencies_met()
{
    if (!class_exists('WooCommerce')) {
        add_action('admin_notices', 'gueschac_woocommerce_missing_notice');
        return false;
    }

    return true;
}

/**
 * Admin notice for missing WooCommerce
 */
function gueschac_woocommerce_missing_notice()
{
?>
    <div class="error">
        <p><?php
            echo wp_kses(
                sprintf(
                    /* translators: %s: WooCommerce link */
                    esc_html__('Guest Checkout Account Creator requires %s to be installed and active.', 'guest-checkout-account-creator'),
                    '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a>'
                ),
                array('a' => array('href' => array(), 'target' => array()))
            );
            ?></p>
    </div>
<?php
}
