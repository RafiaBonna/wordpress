<?php

/**
 * Shop Toolkit  functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Shop Toolkit 
 */

$shop_toolkit_theme = wp_get_theme();
$shop_toolkit_theme_version = $shop_toolkit_theme->get('Version');
$shop_toolkit_theme_domain = $shop_toolkit_theme->get('TextDomain');
if (!defined('SHOP_TOOLKIT_VERSION')) {
	// Replace the version number of the theme on each release.
	define('SHOP_TOOLKIT_VERSION', $shop_toolkit_theme_version);
}

if (!function_exists('shop_toolkit_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function shop_toolkit_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Shop Toolkit , use a find and replace
		 * to change 'shop-toolkit' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('shop-toolkit', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'btop-menu' => esc_html__('Top Menu', 'shop-toolkit'),
				'main-menu' => esc_html__('Main Menu', 'shop-toolkit'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);


		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'shop_toolkit_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'shop_toolkit_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shop_toolkit_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('shop_toolkit_content_width', 1170);
}
add_action('after_setup_theme', 'shop_toolkit_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shop_toolkit_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'shop-toolkit'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'shop-toolkit'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Footer Widget', 'shop-toolkit'),
			'id'            => 'footer-widget',
			'description'   => esc_html__('Add Footer widgets here.', 'shop-toolkit'),
			'before_widget' => '<div class="col-lg-3"><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action('widgets_init', 'shop_toolkit_widgets_init');




/**
 * Add preconnect for Google Fonts.
 */
function shop_toolkit_resource_hints($urls, $relation_type) {
	if (wp_style_is('shop-toolkit-google-font', 'queue') && 'preconnect' === $relation_type) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter('wp_resource_hints', 'shop_toolkit_resource_hints', 10, 2);

/**
 * Shop Toolkit Google fonts fuction
 */
if (!function_exists('shop_toolkit_fonts_url')) :
	function shop_toolkit_fonts_url()
	{
		$shop_toolkit_theme_fonts = get_theme_mod('shop_toolkit_theme_fonts', 'Montserrat');
		$shop_toolkit_theme_font_head = get_theme_mod('shop_toolkit_theme_font_head', 'Noto Serif');

		$fonts_url = '';

		$font_families = array();
		if ($shop_toolkit_theme_fonts == $shop_toolkit_theme_font_head) {
			$font_families[] = str_replace(' ', '+', $shop_toolkit_theme_fonts) . ':wght@300;400;500;600;700;800';
		} else {
			$font_families[] = str_replace(' ', '+', $shop_toolkit_theme_fonts) . ':wght@300;400;500;600;700;800';
			$font_families[] = str_replace(' ', '+', $shop_toolkit_theme_font_head) . ':wght@300;400;500;600;700;800';
		}

		$fonts_url = 'https://fonts.googleapis.com/css2?family=' . implode('&family=', $font_families) . '&display=swap';

		return esc_url_raw($fonts_url);
	}
endif;

/**
 * Enqueue scripts and styles.
 */
function shop_toolkit_scripts()
{
	wp_enqueue_style('shop-toolkit-google-font', shop_toolkit_fonts_url(), array(), null);
	wp_enqueue_style('shop-toolkit-default', get_template_directory_uri() . '/assets/css/default.css', array(), SHOP_TOOLKIT_VERSION, 'all');
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.2.0', 'all');
	wp_enqueue_style('font-awesome-five-all', get_template_directory_uri() . '/assets/css/all.css', array(), '5.14.0', 'all');
	wp_enqueue_style('shop-toolkit-main', get_template_directory_uri() . '/assets/css/main.css', array(), SHOP_TOOLKIT_VERSION, 'all');
	wp_enqueue_style('shop-toolkit-style', get_stylesheet_uri(), array(), SHOP_TOOLKIT_VERSION);

	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap-bundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle.js', array('jquery'), '5.2.0', true);
	wp_enqueue_script('shop-toolkit-mobile-menu', get_template_directory_uri() . '/assets/js/mobile-menu.js', array(), SHOP_TOOLKIT_VERSION, true);

	wp_enqueue_script('shop-toolkit-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), SHOP_TOOLKIT_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	$shop_toolkit_install_date = get_option('shop_toolkit_install_date');
	$shop_toolkit_showtime = round((time() - strtotime($shop_toolkit_install_date)) / 24 / 60 / 60);
	if ($shop_toolkit_showtime > 25) {
		wp_enqueue_script('shop-toolkit-info', get_template_directory_uri() . '/assets/js/info.js', array(), SHOP_TOOLKIT_VERSION, true);

		wp_localize_script('shop-toolkit-info', 'shopToolkitSiteInfo', array(
			'wordpressLink' => esc_url(esc_html__('https://wordpress.org/', 'shop-toolkit')),
			'wordpressText' => esc_html__('Powered by WordPress', 'shop-toolkit'),
			'themeName' => 'Shop Toolkit',
			'themeAuthor' => esc_html__('wp theme space', 'shop-toolkit'),
			'themeAuthorLink' => 'https://wpthemespace.com/',
			'restoreButtonText' => esc_html__('Show Site Info', 'shop-toolkit'),
			'themeTextTemplate' => esc_html__('Theme: %1$s by %2$s.', 'shop-toolkit')
		));
	}
}
add_action('wp_enqueue_scripts', 'shop_toolkit_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * add inline style
 */
require get_template_directory() . '/inc/inline-style.php';

/*
* Customizer pro info .
*/
require get_template_directory() . '/inc/info/class-customize.php';

if (is_admin() && $shop_toolkit_theme_domain !='shop-toolkit-plus') {
	require_once trailingslashit(get_template_directory()) . 'inc/about/about.php';
}

/**
 * Customizer additions.
 */

require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/customizer-helper.php';
/**
 * Recommended plugins
 */
require get_template_directory() . '/libs/plugin-recommend/plugin-recommendations.php';


/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woo-items/woo-extra.php';
}



if (!function_exists('shop_toolkit_is_woocommerce_activated')) {
	function shop_toolkit_is_woocommerce_activated()
	{
		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			return true;
		}
		return false;
	}
}

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
add_filter('excerpt_more', 'shop_toolkit_exerpt_empty_string', 999);
function shop_toolkit_exerpt_empty_string($more)
{

	if (is_admin()) {
		return $more;
	}
	return '';
}
function shop_toolkit_excerpt_length($length)
{
	if (is_admin()) {
		return $length;
	}
	return 30;
}
add_filter('excerpt_length', 'shop_toolkit_excerpt_length', 999);
