<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shop Toolkit 
 */
$shop_toolkit_topfooter_show = get_theme_mod('shop_toolkit_topfooter_show', 1);

?>
<?php if (is_active_sidebar('footer-widget') && $shop_toolkit_topfooter_show) : ?>
	<div class="footer-top mt-5 pb-5 pt-5 bg-light">
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar('footer-widget') ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<footer id="colophon" class="site-footer text-center">
	<div class="footer-cradit">
		&copy; <?php echo get_bloginfo('name') .  esc_html__(' All rights reserved ', 'shop-toolkit') . ' - ' . date('Y'); ?>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>

</html>