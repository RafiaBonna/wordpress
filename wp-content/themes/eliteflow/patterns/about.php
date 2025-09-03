<?php
/**
 * Title: About Us
 * Slug: eliteflow/about
 * Categories: eliteflow
 * Keywords: about
 * Block Types: core/post-content
 * Post Types: page, wp_template
 */
?>
<!-- wp:group {"metadata":{"name":"About"},"className":"wrapper","style":{"spacing":{"padding":{"right":"40px","left":"40px","top":"0px"},"margin":{"top":"0","bottom":"80px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group wrapper" style="margin-top:0;margin-bottom:80px;padding-top:0px;padding-right:40px;padding-left:40px"><!-- wp:group {"style":{"border":{"radius":"30px"},"spacing":{"padding":{"right":"60px","left":"60px","top":"80px","bottom":"80px"}}},"backgroundColor":"white","layout":{"type":"default"}} -->
<div class="wp-block-group has-white-background-color has-background" style="border-radius:30px;padding-top:80px;padding-right:60px;padding-bottom:80px;padding-left:60px"><!-- wp:columns {"verticalAlignment":null,"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|20","left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"<?php echo esc_url( get_stylesheet_directory_uri() );?>/assets/images/about.jpg","id":19,"dimRatio":0,"isUserOverlayColor":true,"minHeight":600,"isDark":false,"sizeSlug":"full","style":{"border":{"radius":"20px"},"spacing":{"margin":{"bottom":"34px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light" style="border-radius:20px;margin-bottom:34px;min-height:600px"><img class="wp-block-cover__image-background wp-image-19 size-full" alt="" src="<?php echo esc_url( get_stylesheet_directory_uri() );?>/assets/images/about.jpg" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size"></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"80px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-bottom:80px"><!-- wp:heading {"textAlign":"left","style":{"typography":{"fontStyle":"normal","fontWeight":"500","fontSize":"60px","lineHeight":"1.2"}}} -->
<h2 class="wp-block-heading has-text-align-left" style="font-size:60px;font-style:normal;font-weight:500;line-height:1.2"><?php echo esc_html__( 'Connecting people with perfect homes is our passion.', 'eliteflow' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0"},"margin":{"top":"12px","bottom":"0"}}},"layout":{"type":"constrained","contentSize":""}} -->
<div class="wp-block-group" style="margin-top:12px;margin-bottom:0;padding-right:0;padding-left:0"><!-- wp:paragraph {"align":"left","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
<p class="has-text-align-left" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30);font-size:18px"><?php echo esc_html__( 'Fusce egestas elit eget lorem. Praesent nec nisl a purus blandit viverra. Praesent egestas neque eu enim. In ac felis quis tortor malesuada pretium. Aenean tellus metus, bibendum sed', 'eliteflow' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"textColor":"white","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"fontSize":"sml-medium"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-white-color has-text-color has-link-color has-sml-medium-font-size has-custom-font-size wp-element-button"><?php echo esc_html__( 'Read more', 'eliteflow' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->