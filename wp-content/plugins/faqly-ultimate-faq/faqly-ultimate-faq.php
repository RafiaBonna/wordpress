<?php
/**
 * Plugin Name:       FAQly – Ultimate FAQ
 * Plugin URI:        
 * Description:       A plugin to manage FAQs and display them as an accordion using a shortcode.
 * Version:           1.0.8
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            drakearthur
 * Author URI:        https://www.seothemesexpert.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       faqly-ultimate-faq
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
// Define constants
define('FAQLY_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('FAQLY_PLUGIN_URL', plugin_dir_url(__FILE__));
define('FAQLY_PLUGIN_VERSION', '1.0.8');

define('FAQLY_PLUGIN_MAIN_URL', 'https://www.seothemesexpert.com/');
define('FAQLY_PLUGIN_LICENSE_URL', 'https://license.seothemesexpert.com/api/public/');
define('FAQLY_PLUGIN_THEME_BUNDLE_IMAGE_URL', plugin_dir_url(__FILE__). 'assets/images/get-theme-bundle-img.png');

// Include required files
require_once FAQLY_PLUGIN_DIR . 'includes/class-faq-post-type.php';
require_once FAQLY_PLUGIN_DIR . 'includes/class-faq-admin.php';
require_once FAQLY_PLUGIN_DIR . 'includes/class-faq-metabox.php';
require_once FAQLY_PLUGIN_DIR . 'includes/class-faq-shortcode.php';
require_once FAQLY_PLUGIN_DIR . 'ajax/ajax.php';

// Initialize the plugin
add_action('plugins_loaded', function () {
    new FAQLY_Post_Type();
    new FAQLY_Admin();
    new FAQLY_Shortcode();
    new FAQLY_Metabox();
});

register_activation_hook(__FILE__, 'faqly_plugin_activation_hook');
function faqly_plugin_activation_hook() {
    update_option('faqly_show_activation_popup', true);
}

register_deactivation_hook(__FILE__,'faqly_plugin_deactivation_hook');
function faqly_plugin_deactivation_hook() {
     delete_option('faqly_show_deactivation_popup');
}


add_action( 'wp_login', 'faqly_user_login_hook', 10, 2 );
function faqly_user_login_hook( $user_login, $user ) {
  update_option( 'faqly_show_activation_popup', true );
}

add_action('wp_logout', function() {
        delete_option('faqly_show_deactivation_popup');
});


add_action('admin_footer', 'faqly_custom_popup_html');
function faqly_custom_popup_html() {
    if (!get_option('faqly_show_activation_popup')) return;
    if (isset($_GET['page']) && $_GET['page'] === 'templates_page') {
        return; 
    }
    ?>
    <div id="faqly-popup-overlay">
      <div id="faqly-popup-content">
        <span class="dashicons dashicons-plus-alt2 faqly-popup-dismiss"></span>
        <img src="<?php echo esc_url(FAQLY_PLUGIN_THEME_BUNDLE_IMAGE_URL); ?>" alt="Bundle Image">
        <h2><?php echo esc_html('Elevate Your Website with Premium Themes from $39'); ?></h2>
        <div class="faqly-popup-wrap">
          <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=faqly_faq_group&page=templates_page' ) ); ?>" class="button button-primary faqly-popup-template-btn"><?php echo esc_html('View Premium Templates'); ?></a>
          <a href="<?php echo esc_url( FAQLY_PLUGIN_MAIN_URL ) . 'products/wordpress-theme-bundle'; ?>" target="_blank" class="button button-primary faqly-popup-bundle-btn"><?php echo esc_html('Get Theme Bundle'); ?></a>
        </div>
      </div>
    </div>
    <?php
}

add_action('admin_enqueue_scripts', function() {

    if (isset($_GET['page']) && $_GET['page'] === 'templates_page') {
        return; 
    }
    
    if (!get_option('faqly_show_activation_popup')) {
        update_option('faqly_show_deactivation_popup', true);
    }

    $dismissed = get_option('faqly_show_deactivation_popup'); 

    wp_register_style('faqly-admin-styles', false);
    wp_enqueue_style('faqly-admin-styles');

    if (!$dismissed) {
        $css = '.faqly-premium-floating-btn { display: none !important; position: fixed; bottom: 20px; right: 20px; z-index: 9999; padding: 10px 15px; }';
    } else {
        $css = '.faqly-premium-floating-btn { display: inline-block; position: fixed; bottom: 20px; right: 20px; z-index: 9999; padding: 10px 15px; }';
    }

    wp_add_inline_style('faqly-admin-styles', $css);
});


add_action('admin_footer', function() {

    if (isset($_GET['page']) && $_GET['page'] === 'templates_page') {
        return; 
    }
    ?>
    <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=faqly_faq_group&page=templates_page' ) ); ?>" 
       class="faqly-premium-floating-btn button button-primary">
        <?php echo esc_html('View Premium Templates'); ?>
    </a>
    <?php
});


function faqly_maybe_enqueue_scripts() {
    if (is_admin()) {
        return;
    }
    global $post;

    if (isset($post->post_content) && has_shortcode($post->post_content, 'faqly_accordion')) {
        add_action('wp_enqueue_scripts', 'faqly_accordion_front_enqueue_scripts');
    }
}
add_action('wp', 'faqly_maybe_enqueue_scripts');

// Enqueue frontend scripts and styles
function faqly_accordion_front_enqueue_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_style('faqly-accordion-style', FAQLY_PLUGIN_URL . 'assets/faq-accordion-front.css', array(), FAQLY_PLUGIN_VERSION);
    wp_enqueue_style('faqly-bootstrap-front-css', FAQLY_PLUGIN_URL . 'assets/lib/bootstrap.min.css', array(), FAQLY_PLUGIN_VERSION);
    wp_enqueue_script('faqly-bootstrap-front-js', FAQLY_PLUGIN_URL . 'assets/lib/bootstrap.bundle.min.js', array('jquery'), FAQLY_PLUGIN_VERSION, true);
    wp_enqueue_script(
        'faqly-accordion-front', // Handle
        FAQLY_PLUGIN_URL . 'assets/faq-accordion-front.js',
        array('jquery', 'faqly-bootstrap-front-js'),
        FAQLY_PLUGIN_VERSION,
        true
    );
}


function faqly_enqueue_faq_admin_scripts($hook){

    if ($hook == 'faqs_page_templates_page') {
        wp_enqueue_style('faqly-templates-accordion-style', FAQLY_PLUGIN_URL . 'assets/admin/css/faq-templates-accordion.css', array(), FAQLY_PLUGIN_VERSION);
    }

    wp_enqueue_style('faqly-accordion-style', FAQLY_PLUGIN_URL . 'assets/admin/css/faq-accordion.css', array(), FAQLY_PLUGIN_VERSION);
    wp_enqueue_script('faqly-accordion-script', FAQLY_PLUGIN_URL . 'assets/admin/js/faq-accordion.js', [], FAQLY_PLUGIN_VERSION, true);
        wp_localize_script('faqly-accordion-script', 'faqly_ajax_object', [
            'ajax_url' => admin_url('admin-ajax.php'),
    ]);
    // if ('post.php' === $hook || 'post-new.php' === $hook) {
    if ('post.php' === $hook || 'post-new.php' === $hook || (isset($_GET['page']) && 'templates_page' === $_GET['page'])) {
        wp_enqueue_style('faqly-bootstrap-dash-css', FAQLY_PLUGIN_URL . 'assets/lib/bootstrap.min.css', array(), FAQLY_PLUGIN_VERSION);
        wp_enqueue_script('faqly-bootstrap-dash-js', FAQLY_PLUGIN_URL . 'assets/lib/bootstrap.bundle.min.js', array('jquery'), FAQLY_PLUGIN_VERSION, true);

        add_action('admin_print_scripts', 'faqly_remove_admin_notices', 99);
    }
}
add_action('admin_enqueue_scripts', 'faqly_enqueue_faq_admin_scripts');

function faqly_enqueue_block_editor_assets() {
    wp_register_script(
        'faqly-template-modal-js',
        FAQLY_PLUGIN_URL . 'assets/admin/js/faq-modal.js',
        array( 'jquery' ),
        FAQLY_PLUGIN_VERSION,
        true
    );

    wp_localize_script(
        'faqly-template-modal-js',
        'faqly_template_modal_js',
        array('admin_ajax' =>  admin_url( 'admin-ajax.php' ))
    );
    wp_enqueue_script( 'faqly-template-modal-js' );

    wp_enqueue_style('faqly-template-modal-css', FAQLY_PLUGIN_URL . 'assets/admin/css/faq-template-modal.css', array(), FAQLY_PLUGIN_VERSION);
}
add_action( 'enqueue_block_editor_assets', 'faqly_enqueue_block_editor_assets' );

// for remove admin notices
function faqly_remove_admin_notices()
{
    echo '<style>.notice, .update-nag, .updated, .error, .is-dismissible { display: none !important; }</style>';
    remove_all_actions('admin_notices');
    remove_all_actions('all_admin_notices');
}
//for post messege 

add_filter('post_updated_messages', function ($messages) {
    global $post;

    if ($post && $post->post_type === 'faqly_faq_group') {
        $messages['faqly_faq_group'] = [
            1  => 'Accordion updated.', // Updated
            6  => 'Accordion published.', // Published
            4  => 'Accordion updated.', // Updated
            8  => 'Accordion submitted.', // Submitted for review
            10 => 'Accordion draft updated.', // Draft saved
        ];
    }

    return $messages;
});

// for banner 

add_action('admin_notices', 'faqly_admin_notice_with_html');

function faqly_admin_notice_with_html(){
?>
    <div class="notice is-dismissible faqly-upsell-banner">
        <div class="faqly-notice-notice-main-img faqly-upsell-banner-image">
            <img src="<?php echo esc_url( FAQLY_PLUGIN_URL . 'assets/images/faqly-banner.png'); ?>" alt="">
        </div>
        <div class="faqly-notice-banner-wrap faqly-upsell-banner-container">
            <div class="faqly-notice-left-img faqly-upsell-banner-content">
                <h1><?php echo esc_html('WORDPRESS THEMES BUNDLE'); ?></h1>
                <p><?php echo esc_html('GET OVER 45+ RESPONSIVE WORDPRESS THEMES FOR ONLY $69!'); ?></p>
            </div>

            <div class="faqly-notice-btn faqly-upsell-banner-btn">
                <a class="faqly-buy-btn" target="_blank" href="<?php echo esc_url( FAQLY_PLUGIN_MAIN_URL . 'products/wordpress-theme-bundle' ); ?>"><?php echo esc_html('BUY NOW'); ?></a>
            </div>
        </div>
    </div>
<?php
}
