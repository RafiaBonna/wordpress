<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jewellery Boutique
 */

// For archive post setting
$jewellery_boutique_post_heading = get_theme_mod('jewellery_boutique_post_heading_settings', '1');
$jewellery_boutique_post_content = get_theme_mod('jewellery_boutique_post_content_settings', '1');
$jewellery_boutique_post_feature_image = get_theme_mod('jewellery_boutique_post_featured_image_settings', '1');
$jewellery_boutique_post_date = get_theme_mod('jewellery_boutique_post_date_settings', '1');
$jewellery_boutique_post_comments = get_theme_mod('jewellery_boutique_post_comments_settings', '1');
$jewellery_boutique_post_author = get_theme_mod('jewellery_boutique_post_author_settings', '1');
$jewellery_boutique_post_timing = get_theme_mod('jewellery_boutique_post_timing_settings', '1');
$jewellery_boutique_post_tags = get_theme_mod('jewellery_boutique_post_tags_settings', '1');

// For single post setting
$jewellery_boutique_single_post_heading = get_theme_mod('jewellery_boutique_single_post_heading_settings', '1');
$jewellery_boutique_single_post_content = get_theme_mod('jewellery_boutique_single_post_content_settings', '1');
$jewellery_boutique_single_post_feature_image = get_theme_mod('jewellery_boutique_single_post_featured_image_settings', '1');
$jewellery_boutique_single_post_date = get_theme_mod('jewellery_boutique_single_post_date_settings', '1');
$jewellery_boutique_single_post_comments = get_theme_mod('jewellery_boutique_single_post_comments_settings', '1');
$jewellery_boutique_single_post_author = get_theme_mod('jewellery_boutique_single_post_author_settings', '1');
$jewellery_boutique_single_post_timing = get_theme_mod('jewellery_boutique_single_post_timing_settings', '1');
$jewellery_boutique_single_post_tags = get_theme_mod('jewellery_boutique_single_post_tags_settings', '1');

$jewellery_boutique_is_archive_visible = (
    $jewellery_boutique_post_heading == '1' ||
    $jewellery_boutique_post_content == '1' ||
    $jewellery_boutique_post_feature_image == '1' ||
    $jewellery_boutique_post_date == '1' ||
    $jewellery_boutique_post_comments == '1' ||
    $jewellery_boutique_post_author == '1' ||
    $jewellery_boutique_post_timing == '1' ||
    $jewellery_boutique_post_tags == '1'
);

$jewellery_boutique_is_single_visible = (
    $jewellery_boutique_single_post_heading == '1' ||
    $jewellery_boutique_single_post_content == '1' ||
    $jewellery_boutique_single_post_feature_image == '1' ||
    $jewellery_boutique_single_post_date == '1' ||
    $jewellery_boutique_single_post_comments == '1' ||
    $jewellery_boutique_single_post_author == '1' ||
    $jewellery_boutique_single_post_timing == '1' ||
    $jewellery_boutique_single_post_tags == '1'
);

if (!is_single() && !$jewellery_boutique_is_archive_visible) {
    return;
}

if (is_single() && !$jewellery_boutique_is_single_visible) {
    return;
}

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('blog-item'); ?>>
	<?php
		$jewellery_boutique_post_id = get_the_ID();
		$jewellery_boutique_post = get_post($jewellery_boutique_post_id);
		$jewellery_boutique_content = do_shortcode(apply_filters('the_content', $jewellery_boutique_post->post_content));
		$jewellery_boutique_embeds = get_media_embedded_in_content($jewellery_boutique_content);

		if (!empty($jewellery_boutique_embeds)) {
			foreach ($jewellery_boutique_embeds as $jewellery_boutique_embed) {
				$jewellery_boutique_embed = wp_kses($jewellery_boutique_embed, array(
					'iframe' => array(
						'src' => array(),
						'width' => array(),
						'height' => array(),
						'frameborder' => array(),
						'allowfullscreen' => array(),
					),
					'video' => array(
						'src' => array(),
						'width' => array(),
						'height' => array(),
						'controls' => array(),
					),
				));
				if (strpos($jewellery_boutique_embed, 'video') !== false || 
					strpos($jewellery_boutique_embed, 'youtube') !== false || 
					strpos($jewellery_boutique_embed, 'vimeo') !== false || 
					strpos($jewellery_boutique_embed, 'dailymotion') !== false || 
					strpos($jewellery_boutique_embed, 'vine') !== false || 
					strpos($jewellery_boutique_embed, 'wordpress.tv') !== false || 
					strpos($jewellery_boutique_embed, 'hulu') !== false) {
					?>
					<div class="custom-embedded-video">
						<div class="video-container">
							<?php echo $jewellery_boutique_embed; ?>
						</div>
						<div class="video-comments">
							<?php comments_template(); ?>
						</div>
					</div>
					<?php
				}
			}
		}
	?>
	<?php
	if (is_single()) :
        if ($jewellery_boutique_single_post_date == '1') : ?>
            <h6 class="theme-button"><?php echo esc_html(get_the_date('j')); ?>, <?php echo esc_html(get_the_date('M')); ?> <?php echo esc_html(get_the_date('Y')); ?></h6>
        <?php endif;
    else :
        if ($jewellery_boutique_post_date == '1') : ?>
            <h6 class="theme-button"><?php echo esc_html(get_the_date('j')); ?>, <?php echo esc_html(get_the_date('M')); ?> <?php echo esc_html(get_the_date('Y')); ?></h6>
        <?php endif;
    endif;
    ?>

    <div class="blog-content">
        <?php
        if (is_single()) :
            if ($jewellery_boutique_single_post_heading == '1') :
                the_title('<h5 class="post-title">', '</h5>');
            endif;
        else :
            if ($jewellery_boutique_post_heading == '1') :
                the_title(sprintf('<h5 class="post-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h5>');
            endif;
        endif;

        if (is_singular()) :
            if ($jewellery_boutique_single_post_content == '1') :
                the_content();
            endif;
        else :
            $jewellery_boutique_excerpt_limit = get_theme_mod('jewellery_boutique_excerpt_limit', 50);

            if ($jewellery_boutique_post_content == '1') :
                echo "<p>" . wp_trim_words(get_the_excerpt(), $jewellery_boutique_excerpt_limit) . "</p>";
            endif;
        endif;
        ?>
    </div>

    <?php if (is_singular()) : ?>
        <ul class="comment-timing">
            <?php if ($jewellery_boutique_single_post_comments == '1') : ?>
                <li><a href="javascript:void(0);"><i class="fa fa-comment"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></a></li>
            <?php endif; ?>

            <?php if ($jewellery_boutique_single_post_author == '1') : ?>
                <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><i class="fa fa-user"></i><?php esc_html_e('By', 'jewellery-boutique'); ?> <?php the_author(); ?></a></li>
            <?php endif; ?>

            <?php if ($jewellery_boutique_single_post_timing == '1') : ?>
                <li><a href="javascript:void(0);"><i class="fas fa-clock pe-1"></i> <?php echo esc_html( get_the_time( 'F j, Y' ) ); ?> <?php echo esc_html( get_the_time( 'H:i A' ) ); ?></a></li>
            <?php endif; ?>

            
        </ul>
        <?php else : ?>
        <ul class="comment-timing">
            <?php if ($jewellery_boutique_post_comments == '1') : ?>
                <li><a href="javascript:void(0);"><i class="fa fa-comment"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></a></li>
            <?php endif; ?>

            <?php if ($jewellery_boutique_post_author == '1') : ?>
                <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><i class="fa fa-user"></i><?php esc_html_e('By', 'jewellery-boutique'); ?> <?php the_author(); ?></a></li>
            <?php endif; ?>

            <?php if ($jewellery_boutique_post_timing == '1') : ?>
                <li><a href="javascript:void(0);"><i class="fas fa-clock pe-1"></i> <?php echo esc_html( get_the_time( 'F j, Y' ) ); ?> <?php echo esc_html( get_the_time( 'H:i A' ) ); ?></a></li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>

    <?php
    if (is_singular()) :
        if ($jewellery_boutique_single_post_tags == '1') : ?>
            <div class="blog-tags mt-3">
                <?php the_tags(); ?>
            </div>
        <?php endif;
        else :
        if ($jewellery_boutique_post_tags == '1') : ?>
            <div class="blog-tags mt-3">
                <?php the_tags(); ?>
            </div>
        <?php endif;
    endif;
    ?>
</div>