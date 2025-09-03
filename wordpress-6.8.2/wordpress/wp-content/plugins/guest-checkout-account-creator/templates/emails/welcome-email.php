<?php

/**
 * Welcome email template
 *
 * Override this template by copying it to yourtheme/templates/emails/welcome-email.php
 *
 * @package GuestCheckoutAccountCreator
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo esc_attr(get_bloginfo('charset')); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo esc_html(get_bloginfo('name')); ?></title>
</head>

<body style="background-color: #f7f7f7; margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f7f7f7;">
        <tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; margin: 40px 0; border-radius: 3px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td align="center" valign="top" style="padding: 40px;">
                            <?php if ($img = get_option('woocommerce_email_header_image')) : ?>
                                <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" style="max-width: 300px; height: auto;" />
                            <?php else : ?>
                                <h1 style="color: #333333; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 30px; line-height: 150%; margin: 0; text-align: center;"><?php echo esc_html(get_bloginfo('name')); ?></h1>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td align="left" valign="top" style="padding: 20px 40px; color: #636363; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 150%;">
                            <?php echo wp_kses_post(wpautop(wptexturize($content))); ?>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td align="center" valign="top" style="padding: 20px 40px; color: #999999; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 150%; border-top: 1px solid #e5e5e5;">
                            <?php
                            $footer_text = apply_filters('woocommerce_email_footer_text', get_option('woocommerce_email_footer_text'));
                            $footer_text = wptexturize($footer_text);
                            $footer_text = wpautop($footer_text);
                            echo wp_kses_post($footer_text);

                            ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>