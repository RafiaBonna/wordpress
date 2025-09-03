<?php
/*
*
* The file for display blog content for shop kit theme
*
*/
$shop_toolkit_plus_blog_style = get_theme_mod('shop_toolkit_plus_blog_style', 'grid');
$shop_toolkit_plus_blogdate = get_theme_mod('shop_toolkit_blogdate', 1);
$shop_toolkit_plus_blogauthor = get_theme_mod('shop_toolkit_blogauthor', 1);
$shop_toolkit_plus_postcat = get_theme_mod('shop_toolkit_postcat', 1);
$shop_toolkit_plus_posttag = get_theme_mod('shop_toolkit_posttag', 1);
$shop_toolkit_plus_posttag = get_theme_mod('shop_toolkit_posttag', 1);
$shop_toolkit_plus_post_comment = get_theme_mod('shop_toolkit_post_comment', 1);

if ($shop_toolkit_plus_blog_style == 'style1') {
	$shop_toolkit_plus_stclass = 'xskit-list-flex';
} else {
	$shop_toolkit_plus_stclass = 'xskit-simple-list';
}

if ($shop_toolkit_plus_blog_style != 'style3') :
?>
	<div class="xskit-blog-list">
		<?php if (has_post_thumbnail()) : ?>
			<div class="<?php echo esc_attr($shop_toolkit_plus_stclass); ?> hasimg">
				<div class="shop-toolkit-blog-img">
					<?php shop_toolkit_post_thumbnail(); ?>
				</div>
			<?php else : ?>
				<div class="<?php echo esc_attr($shop_toolkit_plus_stclass); ?> no-img">
				<?php endif; ?>

				<div class="shop-toolkit-blog-text">
					<div class="shop-toolkit-btext">
						<header class="entry-header">
							<?php
							the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');

							if ('post' === get_post_type() && (!empty($shop_toolkit_plus_blogdate) || !empty($shop_toolkit_plus_blogauthor))) :
							?>
								<div class="entry-meta">
									<?php
									if ($shop_toolkit_plus_blogdate) {
										shop_toolkit_posted_on();
									}
									if ($shop_toolkit_plus_blogauthor) {
										shop_toolkit_posted_by();
									}
									?>
								</div><!-- .entry-meta -->
							<?php endif; ?>
						</header><!-- .entry-header -->
						<div class="entry-content">
							<?php
							the_excerpt();
							?>
						</div><!-- .entry-content -->

					</div>

				</div>
				</div>
			</div>
		<?php else : ?>
			<div class="xskit-single-list">
				<header class="entry-header text-center mb-5">
					<?php
					the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');

					if ('post' === get_post_type() && (!empty($shop_toolkit_plus_blogdate) || !empty($shop_toolkit_plus_blogauthor))) :
					?>
						<div class="entry-meta">
							<?php
							if ($shop_toolkit_plus_blogdate) {
								shop_toolkit_posted_on();
							}
							if ($shop_toolkit_plus_blogauthor) {
								shop_toolkit_posted_by();
							}
							?>
						</div><!-- .entry-meta -->
					<?php endif; ?>
				</header><!-- .entry-header -->

				<?php shop_toolkit_post_thumbnail(); ?>

				<div class="entry-content">
					<?php
					the_excerpt();
					?>
				</div><!-- .entry-content -->
				<?php if (!empty($shop_toolkit_plus_postcat) || !empty($shop_toolkit_plus_posttag) || !empty($shop_toolkit_plus_post_comment)) : ?>
					<footer class="entry-footer">
						<?php shop_toolkit_entry_footer($shop_toolkit_plus_postcat, $shop_toolkit_plus_posttag, $shop_toolkit_plus_post_comment); ?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>

			</div>
		<?php endif; ?>