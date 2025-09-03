<?php

/**
 * Email handler class file.
 *
 * @package GuestCheckoutAccountCreator
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Email handler class
 */
class GUESCHAC_Email_Handler
{
    /**
     * Send welcome email to new customer
     *
     * @param int      $user_id User ID.
     * @param WC_Order $order   Order object.
     */
    public function send_welcome_email($user_id, $order)
    {
        $user = get_user_by('id', $user_id);
        if (!$user) {
            return;
        }

        $settings = get_option('gueschac_settings', array());
        $password = sanitize_text_field(get_user_meta($user_id, '_gueschac_temp_pass', true));

        // Delete temporary password after retrieving it
        delete_user_meta($user_id, '_gueschac_temp_pass');

        // Get email subject and content from settings
        $subject = isset($settings['email_subject'])
            ? sanitize_text_field($settings['email_subject'])
            : sprintf(/* translators: %s: Site name */
                __('Welcome to %s - Your Account Details', 'guest-checkout-account-creator'),
                wp_specialchars_decode(get_bloginfo('name'), ENT_QUOTES)
            );

        $content = isset($settings['email_content'])
            ? wp_kses_post($settings['email_content'])
            : $this->get_default_email_content();

        // Replace placeholders with properly sanitized data
        $placeholders = array(
            '{site_name}'        => sanitize_text_field(get_bloginfo('name')),
            '{site_title}'       => sanitize_text_field(get_bloginfo('name')),
            '{customer_name}'    => sanitize_text_field($user->display_name),
            '{customer_email}'   => sanitize_email($user->user_email),
            '{customer_password}' => esc_html($password),
            '{my_account_url}'   => esc_url(wc_get_page_permalink('myaccount')),
            '{order_number}'     => sanitize_text_field($order->get_order_number()),
        );

        // Apply replacements with sanitized values
        $subject = str_replace(array_keys($placeholders), array_values($placeholders), $subject);
        $content = str_replace(array_keys($placeholders), array_values($placeholders), $content);

        // Final sanitization before sending
        $subject = sanitize_text_field($subject);

        wp_mail(
            sanitize_email($user->user_email),
            wp_strip_all_tags($subject),
            $this->get_email_template(wp_kses_post($content)),
            $this->get_email_headers()
        );
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

Thank you for shopping with {site_title}!",
            'guest-checkout-account-creator'
        ));
    }

    /**
     * Get the email template with content inserted
     *
     * @param string $content
     * @return string
     */
    private function get_email_template($content)
    {
        // Try to get the template file
        $template_path = gueschac_get_email_template_path();

        if (file_exists($template_path)) {
            ob_start();
            include $template_path;
            return ob_get_clean();
        }

        // Fallback to a simple HTML template if the template file doesn't exist
        return '<html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=' . esc_attr('UTF-8') . '" />
                <title>' . esc_html(get_bloginfo('name')) . '</title>
            </head>
            <body>
                <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
                    <div style="text-align: center; margin-bottom: 30px;">
                        <h1>' . esc_html(get_bloginfo('name')) . '</h1>
                    </div>
                    <div style="background-color: #f8f8f8; padding: 20px; border-radius: 5px;">
                        ' . wpautop(wp_kses_post($content)) . '
                    </div>
                    <div style="text-align: center; margin-top: 30px; font-size: 12px; color: #999;">
                        ' . wpautop(wp_kses_post(get_option('woocommerce_email_footer_text', ''))) . '
                    </div>
                </div>
            </body>
        </html>';
    }

    /**
     * Get standardized email headers
     *
     * @return array
     */
    private function get_email_headers()
    {
        $site_name = wp_specialchars_decode(get_bloginfo('name'), ENT_QUOTES);
        $admin_email = sanitize_email(get_option('admin_email'));
        $from_address = sanitize_email(apply_filters('wp_mail_from', $admin_email));
        $from_name = sanitize_text_field(apply_filters('wp_mail_from_name', $site_name));
        $host = sanitize_text_field(wp_parse_url(home_url(), PHP_URL_HOST));
        $message_id = '<' . time() . '.' . sanitize_key(uniqid()) . '@' . $host . '>';

        return array(
            'Content-Type: text/html; charset=UTF-8',
            sprintf('From: %s <%s>', $from_name, $from_address),
            sprintf('Reply-To: %s <%s>', $from_name, $from_address),
            'Message-ID: ' . $message_id,
            'X-Mailer: WordPress/' . sanitize_text_field(get_bloginfo('version')),
            'List-Unsubscribe: <' . esc_url(wc_get_page_permalink('myaccount')) . '>',
            'MIME-Version: 1.0',
            'X-Priority: 3',
            'Precedence: bulk'
        );
    }
}
