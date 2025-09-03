<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shop-toolkit
 */
$shop_toolkit_breadcrump_show = get_theme_mod('shop_toolkit_breadcrump_show', 1);
$shop_toolkit_breadcrump_position = get_theme_mod('shop_toolkit_breadcrump_position', 'left');
$shop_toolkit_shopbanner_show = get_theme_mod('shop_toolkit_shopbanner_show');
$shop_toolkit_banner_subtext = get_theme_mod('shop_toolkit_banner_subtext');
$shop_toolkit_banner_title = get_theme_mod('shop_toolkit_banner_title');
$shop_toolkit_banner_desc = get_theme_mod('shop_toolkit_banner_desc');
$shop_toolkit_banner_btn = get_theme_mod('shop_toolkit_banner_btn', esc_html__('Shop Now', 'shop-toolkit'));
$shop_toolkit_banner_url = get_theme_mod('shop_toolkit_banner_url', '#');
$shop_toolkit_text_position = get_theme_mod('shop_toolkit_text_position', 'left');
$shop_toolkit_banner_overlay = get_theme_mod('shop_toolkit_banner_overlay');
$shop_toolkit_shop_container = get_theme_mod('shop_toolkit_shop_container', 'container');
$shop_toolkit_shop_layout = get_theme_mod('shop_toolkit_shop_layout', 'rightside');
$shop_toolkit_shop_style = get_theme_mod('shop_toolkit_shop_style', '1');
if (is_active_sidebar('shop-sidebar') && $shop_toolkit_shop_layout != 'fullwidth') {
	$shop_toolkit_column_set = 'col-lg-9';
} else {
	$shop_toolkit_column_set = 'col-lg-12';
}
get_header();

?>
<?php if ($shop_toolkit_shopbanner_show && is_shop()) : ?>
	<div class="shop-toolkit-banner bg-overlay">
		<div class="container">
			<div class="bbanner-text text-<?php echo esc_attr($shop_toolkit_text_position); ?>">
				<h4><?php echo esc_html($shop_toolkit_banner_subtext); ?></h4>
				<h1><?php echo esc_html($shop_toolkit_banner_title); ?></h1>
				<?php echo apply_filters('the_content', $shop_toolkit_banner_desc); ?>
				<?php if ($shop_toolkit_banner_url) : ?>
					<div class="bsbanner-btn">
						<a href="<?php echo esc_url($shop_toolkit_banner_url); ?>" class="btn xskit-btn"><?php echo esc_html($shop_toolkit_banner_btn); ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php if ($shop_toolkit_banner_overlay) : ?>
			<div class="overlay-banner"></div>
		<?php endif; ?>
	</div>
<?php endif; ?>
<?php if ($shop_toolkit_breadcrump_show && !(is_front_page() && is_shop() || is_shop())) : ?>
	<div class="shop-toolkit-wbreadcrump text-<?php echo esc_attr($shop_toolkit_breadcrump_position); ?>">
		<div class="<?php echo esc_attr($shop_toolkit_shop_container); ?>">
			<?php woocommerce_breadcrumb(); ?>
		</div>
	</div>
<?php endif; ?>
<div class="<?php echo esc_attr($shop_toolkit_shop_container); ?> mt-3 mb-5 pt-5 pb-3">
	<div class="row">
		<?php if (is_active_sidebar('shop-sidebar') && $shop_toolkit_shop_layout == 'leftside') : ?>
			<div class="col-lg-3">
				<aside id="secondary" class="widget-area shop-sidebar">
					<?php dynamic_sidebar('shop-sidebar'); ?>
				</aside><!-- #secondary -->
			</div>
		<?php
		endif; ?>
		<div class="<?php echo esc_attr($shop_toolkit_column_set); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main bstyle<?php echo esc_attr($shop_toolkit_shop_style); ?>">

					<?php woocommerce_content(); ?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- #primary -->
		<?php if (is_active_sidebar('shop-sidebar') && $shop_toolkit_shop_layout == 'rightside') : ?>
			<div class="col-lg-3">
				<aside id="secondary" class="widget-area <?php if (!(is_front_page() && is_shop())) : ?>shop-sidebar<?php endif; ?>">
					<?php dynamic_sidebar('shop-sidebar'); ?>
				</aside><!-- #secondary -->
			</div>
		<?php
		endif; ?>
	</div>
</div>

<?php
get_footer();
