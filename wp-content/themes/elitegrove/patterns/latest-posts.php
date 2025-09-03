<?php
/**
 * Title: Latest Posts
 * Slug: elitegrove/latest-posts
 * Categories: elitegrove
 * Keywords: latest-posts
 */
?>
<!-- wp:group {"className":"wow animate__animated animate__slideInUp","style":{"spacing":{"padding":{"top":"100px","bottom":"100px","left":"20px","right":"20px"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"secondary","layout":{"type":"constrained"}} -->
<div class="wp-block-group wow animate__animated animate__slideInUp has-secondary-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:100px;padding-right:20px;padding-bottom:100px;padding-left:20px"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"60px"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group" style="margin-bottom:60px"><!-- wp:heading {"style":{"typography":{"lineHeight":"1.2"}}} -->
<h2 class="wp-block-heading" style="line-height:1.2"><?php echo esc_html__( 'Our News and Blogs', 'elitegrove' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'View All Blogs', 'elitegrove' ); ?> &amp; <?php echo esc_html__( 'News', 'elitegrove' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"style":{"border":{"radius":"10px","color":"#cdcdcd","width":"1px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#cdcdcd;border-width:1px;border-radius:10px"><!-- wp:post-featured-image {"isLink":true,"style":{"border":{"radius":"10px"}}} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|10","left":"var:preset|spacing|10","bottom":"var:preset|spacing|10"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--10)"><!-- wp:post-date /-->

<!-- wp:post-title {"isLink":true,"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"mdm-large"} /-->

<!-- wp:post-excerpt {"moreText":"","excerptLength":16} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->