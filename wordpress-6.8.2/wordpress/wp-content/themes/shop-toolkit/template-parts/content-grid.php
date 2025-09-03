<?php
/*
*
* The file for display blog content for Shop Toolkit theme
*
*/
$shop_toolkit_blogdate = get_theme_mod('shop_toolkit_blogdate', 1);
$shop_toolkit_blogauthor = get_theme_mod('shop_toolkit_blogauthor', 1);
$shop_toolkit_blog_readmore = get_theme_mod('shop_toolkit_blog_readmore', esc_html__('Read More', 'shop-toolkit'));

?>
<div class="col-lg-4">
	<div class="xskit-blog-grid mb-5">
		<?php if (has_post_thumbnail()) : ?>
			<div class="xskit-hasimg">
				<div class="shop-toolkit-grid-img">
					<?php shop_toolkit_post_thumbnail(); ?>
				</div>
			<?php else : ?>
				<div class="xskit-hasimg-no-img">
				<?php endif; ?>

				<div class="shop-toolkit-grid-text">
					<header class="entry-header">
						<?php
						the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');

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

					<div class="entry-content">
						<?php the_excerpt(); ?>
						<a href="<?php the_permalink(); ?>" class="readmore"><?php echo esc_html($shop_toolkit_blog_readmore); ?></a>
					</div><!-- .entry-content -->

				</div>

				</div>
			</div>
	</div>