<?php
/*
*
* The file for display blog content for Shop Toolkit theme
*
*/
$shop_toolkit_blogdate = get_theme_mod('shop_toolkit_blogdate', 1);
$shop_toolkit_blogauthor = get_theme_mod('shop_toolkit_blogauthor', 1);
$shop_toolkit_postcat = get_theme_mod('shop_toolkit_postcat', 1);
$shop_toolkit_posttag = get_theme_mod('shop_toolkit_posttag', 1);
?>
<div class="xskit-single-list">
	<header class="entry-header text-center mb-5">
		<?php
		if (is_singular()) :
			the_title('<h2 class="entry-title">', '</h2>');
		else :
			the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		endif;

		if ('post' === get_post_type() && (!empty($shop_toolkit_blogdate) || !empty($shop_toolkit_blogauthor))) :
		?>
			<div class="entry-meta">
				<?php
				if ($shop_toolkit_blogdate) {
					shop_toolkit_posted_on();
				}
				if ($shop_toolkit_blogauthor) {
					shop_toolkit_posted_by();
				}
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php shop_toolkit_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		if (is_single()) {
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'shop-toolkit'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'shop-toolkit'),
					'after'  => '</div>',
				)
			);
		} else {
			the_excerpt();
		}


		?>
	</div><!-- .entry-content -->

	<?php if (!empty($shop_toolkit_postcat) || !empty($shop_toolkit_posttag)) : ?>
		<footer class="entry-footer">
			<?php shop_toolkit_entry_footer($shop_toolkit_postcat, $shop_toolkit_posttag); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>


</div>