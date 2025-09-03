<?php
if ( ! function_exists( 'jewellery_boutique_enqueue_files' ) ) :
function jewellery_boutique_enqueue_files() {

// Root path/URI.
define( 'JEWELLERY_BOUTIQUE_PARENT_DIR', get_template_directory() );
define( 'JEWELLERY_BOUTIQUE_PARENT_URI', get_template_directory_uri() );

// Root path/URI.
define( 'JEWELLERY_BOUTIQUE_PARENT_INC_DIR', JEWELLERY_BOUTIQUE_PARENT_DIR . '/inc');
define( 'JEWELLERY_BOUTIQUE_PARENT_INC_URI', JEWELLERY_BOUTIQUE_PARENT_URI . '/inc');

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-slider' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'custom-header' );

	add_theme_support( 'responsive-embeds' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	
	//Add selective refresh for sidebar widget
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'jewellery-boutique', get_stylesheet_directory() . '/languages' );
		
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'  => esc_html__( 'Primary Menu', 'jewellery-boutique' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
		
	add_theme_support('custom-logo');

	/*
	 * WooCommerce Plugin Support
	 */
	add_theme_support( 'woocommerce' );
	
	// Gutenberg wide images.
	add_theme_support( 'align-wide' );
	
	
	//Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'jewellery_boutique_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css', jewellery_boutique_google_font_url() ) );

    add_theme_support( 'custom-header', apply_filters( 'jewellery_boutique_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/assets/images/custom-header.png',
		'default-text-color'     => 'ffffff',
		'width'                  => 2000, 
		'height'                 => 200,
		'flex-width'    		 => true,
		'flex-height'    		 => true,
	)));

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	*/
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	
	//  --------------------------------------------- ENQUEUE ----------------------------------------------------- //

    /**
     * Implement the Custom Header feature.
     */
    require_once get_template_directory() . '/inc/custom-header.php';

    /**
     * Load Theme About Page
     */
    require get_parent_theme_file_path( '/inc/aboutthemes/about-theme.php' );

    /**
     * Demo Import
     */
    require get_parent_theme_file_path( '/demo-import/demo-import-settings.php' );

}
endif;
add_action( 'after_setup_theme', 'jewellery_boutique_enqueue_files' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jewellery_boutique_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jewellery_boutique_content_width', 1170 );
}
add_action( 'after_setup_theme', 'jewellery_boutique_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function jewellery_boutique_widgets_init() {
	
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'jewellery-boutique' ),
		'id' => 'jewellery-boutique-sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'jewellery-boutique' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><div class="title"><span class="shap"></span></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'jewellery-boutique' ),
		'id' => 'jewellery-boutique-footer-widget-area',
		'description' => __( 'The Footer Widget Area', 'jewellery-boutique' ),
		'before_widget' => '<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.2s"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside></div>',
		'before_title' => '<h5 class="widget-title w-title">',
		'after_title' => '</h5><span class="shap"></span>',
	) );
}
add_action( 'widgets_init', 'jewellery_boutique_widgets_init' );


// Load styles and scripts
require_once get_template_directory() . '/inc/enqueue.php';

// Bootstrap Nav Walker
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

// Template Tags
require_once get_template_directory() . '/inc/template-tags.php';

// Extras
require_once get_template_directory() . '/inc/extras.php';

// Fonts
require_once get_template_directory() . '/inc/fonts.php';

// Webfont Loader
require_once get_template_directory() . '/wptt-webfont-loader.php';

// Customizer
require_once get_template_directory() . '/inc/customizer.php';


add_filter( 'nav_menu_link_attributes', 'jewellery_boutique_dropdown_data_attribute', 20, 3 );
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function jewellery_boutique_dropdown_data_attribute( $atts, $item, $args ) {
    if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
        if ( array_key_exists( 'data-toggle', $atts ) ) {
            unset( $atts['data-toggle'] );
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}

function jewellery_boutique_remove_theme_customizer_setting($wp_customize) {
    // Remove the setting
    $wp_customize->remove_setting('display_header_text');
    // Remove the control
    $wp_customize->remove_control('display_header_text');
}
add_action('customize_register', 'jewellery_boutique_remove_theme_customizer_setting', 20); 
// Use a priority greater than the one used for adding the setting


// Set the number of products per row to 3 on the shop page
add_filter('loop_shop_columns', 'jewellery_boutique_custom_shop_loop_columns');

if (!function_exists('jewellery_boutique_custom_shop_loop_columns')) {
    function jewellery_boutique_custom_shop_loop_columns() {
        // Retrieve the number of columns from theme customizer setting (default: 3)
        $jewellery_boutique_columns = get_theme_mod('jewellery_boutique_custom_shop_per_columns', 3);
        return $jewellery_boutique_columns;
    }
}

function jewellery_boutique_custom_controls() {
	
	load_template( trailingslashit( get_template_directory() ) . '/inc/customizer/customizer-custom-controls.php' );
}
add_action( 'customize_register', 'jewellery_boutique_custom_controls' );

// Set the number of products per page on the shop page
add_filter('loop_shop_per_page', 'jewellery_boutique_custom_shop_per_page', 20);

if (!function_exists('jewellery_boutique_custom_shop_per_page')) {
    function jewellery_boutique_custom_shop_per_page($jewellery_boutique_products_per_page) {
        // Retrieve the number of products per page from theme customizer setting (default: 9)
        $jewellery_boutique_products_per_page = get_theme_mod('jewellery_boutique_custom_shop_product_per_page', 9);
        return $jewellery_boutique_products_per_page;
    }
}

/**
 * Generate Google Fonts URL.
 */
function jewellery_boutique_google_font_url() {
    $google_fonts_url = 'https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap';
    return $google_fonts_url;
}

/**
 * Enqueue theme styles and scripts.
 */
function jewellery_boutique_scripts_styles() {
	$jewellery_boutique_headings_font = esc_html(get_theme_mod('jewellery_boutique_headings_text'));
	$jewellery_boutique_body_font = esc_html(get_theme_mod('jewellery_boutique_body_text'));

	if( $jewellery_boutique_headings_font ) {
		wp_enqueue_style( 'jewellery-boutique-headings-fonts', '//fonts.googleapis.com/css?family='. $jewellery_boutique_headings_font );
	} else {
		// Enqueue Google Fonts
        wp_enqueue_style('jewellery-boutique-google-fonts', jewellery_boutique_google_font_url(), array(), null);
	}
	if( $jewellery_boutique_body_font ) {
		wp_enqueue_style( 'jewellery-boutique-body-fonts', '//fonts.googleapis.com/css?family='. $jewellery_boutique_body_font );
	} else {
		// Enqueue main stylesheet
        wp_enqueue_style('jewellery-boutique-main-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
        // Add more enqueuing here if needed
	}
}
add_action( 'wp_enqueue_scripts', 'jewellery_boutique_scripts_styles' );


/**
 * Enqueue theme copyright alignment style.
 */
function jewellery_boutique_copyright_alignment_option() {
    // Get the alignment setting from the theme customizer.
    $jewellery_boutique_copyright_alignment = get_theme_mod('jewellery_boutique_copyright_alignment', 'center');

    // Start building the CSS string for the alignment.
    $jewellery_boutique_copyright_alignment_css = '
        .footer-copyright {
            text-align: ' . esc_attr($jewellery_boutique_copyright_alignment) . ';
        }
    ';

    // Add the inline style to the theme's main stylesheet.
    wp_add_inline_style('jewellery-boutique-style', $jewellery_boutique_copyright_alignment_css);
}

add_action('wp_enqueue_scripts', 'jewellery_boutique_copyright_alignment_option');

function jewellery_boutique_Customize_css() {
    $jewellery_boutique_dynamic_color = get_theme_mod( 'jewellery_boutique_dynamic_color_one', '#CCA633' );
    $jewellery_boutique_custom_css = ":root { --color-primary1: {$jewellery_boutique_dynamic_color}; }";
    wp_add_inline_style( 'jewellery-boutique-style', $jewellery_boutique_custom_css );
}
add_action( 'wp_enqueue_scripts', 'jewellery_boutique_Customize_css' );

// notice
function jewellery_boutique_activation_notice() {
    // Check if the notice has already been dismissed
    if (get_option('jewellery_boutique_notice_dismissed')) {
        return;
    }

    // Avoid showing the notice on the demo import wizard page
    if (isset($_GET['page']) && $_GET['page'] === 'jewelleryboutique-wizard') {
        return;
    }
    ?>
    <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
        <div class="jewellery-boutique-getting-started-notice clearfix">
            <div class="jewellery-boutique-theme-notice-content">
                <h2 class="jewellery-boutique-notice-h2">
                    <?php
                    printf(
                        /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                        esc_html__('Welcome! Thank you for choosing %1$s!', 'jewellery-boutique'), '<strong>' . wp_get_theme()->get('Name') . '</strong>'
                    );
                    ?>
                </h2>
                <a class="jewellery-boutique-btn-get-started button button-primary button-hero jewellery-boutique-button-padding" 
                    href="<?php echo esc_url(admin_url('themes.php?page=jewelleryboutique-wizard')); ?>" 
                    id="jewellery-boutique-import-button">
                    <?php esc_html_e('One Click Demo Import', 'jewellery-boutique') ?>
                </a>
            </div>
        </div>
    </div>
    <?php
}

add_action('admin_notices', 'jewellery_boutique_activation_notice');

// Add Ajax action to handle dismiss
add_action('wp_ajax_jewellery_boutique_dismiss_notice', 'jewellery_boutique_dismiss_notice');

// Reset the dismissed status when the theme is activated
function jewellery_boutique_notice_status() {
    delete_option('jewellery_boutique_notice_dismissed');
}
add_action('after_switch_theme', 'jewellery_boutique_notice_status');

function jewellery_boutique_dismiss_notice() {
    // Update the option to mark the notice as dismissed
    update_option('jewellery_boutique_notice_dismissed', true);

    // Return a JSON response to indicate the success of the action
    wp_send_json_success();
}

// Helper function to get page ID by slug
function get_page_id_by_slug($jewellery_boutique_slug) {
    $jewellery_boutique_page = get_page_by_path($jewellery_boutique_slug); // Get the page by slug
    return $jewellery_boutique_page ? $jewellery_boutique_page->ID : 0;   // Return the page ID or 0 if not found
}