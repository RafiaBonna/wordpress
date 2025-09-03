<?php
/*This file is part of shop kit child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

$shop_toolkit_plus_theme = wp_get_theme();
$shop_toolkit_plus_version = $shop_toolkit_plus_theme->get('Version');
if (!defined('SHOP_TOOLKIT_PLUS_VERSION')) {
	// Replace the version number of the theme on each release.
	define('SHOP_TOOLKIT_PLUS_VERSION', $shop_toolkit_plus_version);
}



function shop_toolkit_plus_fonts_url()
{
	$fonts_url = '';

	$font_families = array();

	$font_families[] = 'Platypi:400,500,700';
	$font_families[] = 'Fira Sans:400,500,500i,700,700i';
	$font_families[] = 'Noto Serif:400,700';
	$font_families[] = 'Roboto:400,500,700';
	$font_families[] = 'Open Sans:400,600,700';
	$font_families[] = 'Lato:400,700';

	$query_args = array(
		'family' => urlencode(implode('|', $font_families)),
		'subset' => urlencode('latin,latin-ext'),
	);

	$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');


	return esc_url_raw($fonts_url);
}


function shop_toolkit_plus_enqueue_child_styles()
{
	wp_enqueue_style('shop-toolkit-plus-google-font', shop_toolkit_plus_fonts_url(), array(), null);
	wp_enqueue_style('wp-block-library');
	wp_enqueue_style('shop-toolkit-plus-parent-style', get_template_directory_uri() . '/style.css', array('shop-toolkit-main', 'bootstrap', 'shop-toolkit-google-font', 'shop-toolkit-default', 'wp-block-library', 'shop-toolkit-woocommerce-style'), '', 'all');
	wp_enqueue_style('shop-toolkit-plus-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array('shop-toolkit-main','shop-toolkit-default'), SHOP_TOOLKIT_PLUS_VERSION, 'all');

	wp_enqueue_script('masonry');
	
	// Add typography customizations
	shop_toolkit_plus_typography_css();
}
add_action('wp_enqueue_scripts', 'shop_toolkit_plus_enqueue_child_styles');

/**
 * Add custom CSS for typography settings using wp_add_inline_style
 */
function shop_toolkit_plus_typography_css() {
    $body_font_family = get_theme_mod('shop_toolkit_plus_body_font_family', 'Fira Sans');
    $body_font_size = get_theme_mod('shop_toolkit_plus_body_font_size', '16');
    $body_line_height = get_theme_mod('shop_toolkit_plus_font_line_height', '24');
    $header_font_family = get_theme_mod('shop_toolkit_plus_theme_font_head', 'Platypi');
    $header_font_weight = get_theme_mod('shop_toolkit_plus_font_weight_head', '700');
    
    $css = '';
    
    // Body font family
    if ($body_font_family && $body_font_family !== 'Fira Sans') {
        $font_stack = $body_font_family;
        if (in_array($body_font_family, array('Fira Sans', 'Platypi'))) {
            $font_stack .= ', sans-serif';
        } else {
            $font_stack .= ', Arial, sans-serif';
        }
        $css .= 'body, p { font-family: "' . esc_attr($font_stack) . '"; }';
    }
    
    // Body font size
    if ($body_font_size && $body_font_size !== '16') {
        $css .= 'body, p { font-size: ' . absint($body_font_size) . 'px; }';
    }
    
    // Body line height
    if ($body_line_height && $body_line_height !== '24') {
        $css .= 'body, p { line-height: ' . esc_attr($body_line_height) . 'px; }';
    }
    
    // Header font family
    if ($header_font_family && $header_font_family !== 'Platypi') {
        $header_font_stack = $header_font_family;
        if (in_array($header_font_family, array('Platypi', 'Noto Serif', 'Roboto', 'Open Sans', 'Lato'))) {
            $header_font_stack .= ', sans-serif';
        } else {
            $header_font_stack .= ', Arial, sans-serif';
        }
        $css .= 'h1, h2, h3, h4, h5, h6, .site-title { font-family: "' . esc_attr($header_font_stack) . '"; }';
    }
    
    // Header font weight
    if ($header_font_weight && $header_font_weight !== '700') {
        $css .= 'h1, h2, h3, h4, h5, h6, .site-title { font-weight: ' . absint($header_font_weight) . '; }';
    }
    
    // Add inline styles to the main stylesheet
    if (!empty($css)) {
        wp_add_inline_style('shop-toolkit-plus-main', $css);
    }
}



function shop_toolkit_plus_excerpt_more($more)
{
	if (is_admin()) {
		return $more;
	}
	return '';
}
add_filter('excerpt_more', 'shop_toolkit_plus_excerpt_more', 9999);


/**
 * Enhanced author meta display for blog posts
 */
function shop_toolkit_plus_posts_author_meta($show_avatar = true, $avatar_size = 40)
{
	$author_avatar = $show_avatar ? get_avatar(get_the_author_meta('user_email'), $avatar_size) : '';
	$author_name = get_the_author();
	$author_url = get_author_posts_url(get_the_author_meta('ID'));
	$post_date = get_the_date();

	$allowed_tags = array(
		'img' => array(
			'src' => true,
			'alt' => true,
			'class' => true,
			'width' => true,
			'height' => true,
			'srcset' => true,
			'sizes' => true,
		),
	);

?>
	<div class="stplus-ameta">
		<div class="author-details">
			<?php if ($show_avatar) : ?>
				<div class="ameta-img">
					<?php echo wp_kses($author_avatar, $allowed_tags); ?>
				</div>
			<?php endif; ?>
			<div class="ameta-author">
					<a href="<?php echo esc_url($author_url); ?>"><?php echo esc_html($author_name); ?></a>
			</div>
		</div>
		<div class="ameta-details">
			<div class="ameta-date-time">
				<span class="post-date"><?php echo esc_html($post_date); ?></span>
				
			</div>
		</div>
	</div>
<?php
}
include_once get_stylesheet_directory() . '/inc/customizer.php';