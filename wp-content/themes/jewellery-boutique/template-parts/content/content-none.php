<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jewellery Boutique
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-items'); ?>>
	<div class="blog-wrapup">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p class="pt-5"><?php /* translators: %1$s: Link. */ printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'jewellery-boutique' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
		<?php elseif ( is_search() ) : ?>
			<p class="pt-5"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'jewellery-boutique' ); ?></p>
		<?php else : ?>
			<p class="pt-5"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'jewellery-boutique' ); ?></p>
		<?php endif; ?>
	</div>
</article>