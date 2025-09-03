<?php
/**
 * Title: Featured Banner
 * Slug: eliteflow/banner
 * Categories: eliteflow
 * Keywords: banner
 * Block Types: core/post-content
 * Post Types: page, wp_template
 */
?>
<!-- wp:group {"metadata":{"name":"Banner"},"className":"wrapper","style":{"spacing":{"padding":{"right":"40px","left":"40px","top":"40px"},"margin":{"top":"0","bottom":"80px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group wrapper" style="margin-top:0;margin-bottom:80px;padding-top:40px;padding-right:40px;padding-left:40px"><!-- wp:cover {"url":"<?php echo esc_url( get_stylesheet_directory_uri() );?>/assets/images/banner.jpg","id":19,"dimRatio":40,"isUserOverlayColor":true,"minHeight":800,"customGradient":"linear-gradient(135deg,rgb(0,0,0) 0%,rgb(0,0,0) 42%,rgb(20,12,12) 67%,rgb(0,0,0) 100%)","contentPosition":"top center","sizeSlug":"large","className":"banner-with-header","style":{"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|50","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"30px"}},"layout":{"type":"default"}} -->
<div class="wp-block-cover has-custom-content-position is-position-top-center banner-with-header" style="border-radius:30px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:var(--wp--preset--spacing--50);padding-left:0;min-height:800px"><img class="wp-block-cover__image-background wp-image-19 size-large" alt="" src="<?php echo esc_url( get_stylesheet_directory_uri() );?>/assets/images/banner.jpg" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-40 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(135deg,rgb(0,0,0) 0%,rgb(0,0,0) 42%,rgb(20,12,12) 67%,rgb(0,0,0) 100%)"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"wide","className":"wrapper","style":{"spacing":{"padding":{"top":"30px","bottom":"20px","left":"40px","right":"40px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide wrapper" style="padding-top:30px;padding-right:40px;padding-bottom:20px;padding-left:40px"><!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide"><!-- wp:site-title {"level":0,"style":{"spacing":{"margin":{"right":"var:preset|spacing|20"}},"typography":{"fontStyle":"normal","fontWeight":"700"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"large"} /-->

<!-- wp:navigation {"icon":"menu","style":{"typography":{"fontStyle":"normal","fontWeight":"400"},"spacing":{"blockGap":"34px"},"layout":{"selfStretch":"fill","flexSize":null}},"fontSize":"mdm-large","layout":{"type":"flex","justifyContent":"center"}} /-->

<!-- wp:social-links {"iconColor":"white","iconColorValue":"#fff","className":"is-style-logos-only"} -->
<ul class="wp-block-social-links has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"#","service":"facebook"} /-->

<!-- wp:social-link {"url":"#","service":"instagram"} /-->

<!-- wp:social-link {"url":"#","service":"twitter"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"1500px"}} -->
<main class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"90px","fontStyle":"normal","fontWeight":"500","lineHeight":"1"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontFamily":"body"} -->
<h1 class="wp-block-heading has-text-align-center has-white-color has-text-color has-link-color has-body-font-family" style="font-size:90px;font-style:normal;font-weight:500;line-height:1"><?php echo esc_html__( 'Find the Perfect Property for Your Lifestyle', 'eliteflow' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0"}}},"layout":{"type":"constrained","contentSize":"850px"}} -->
<div class="wp-block-group" style="padding-right:0;padding-left:0"><!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30);font-size:18px"><?php echo esc_html__( 'Fusce egestas elit eget lorem. Praesent nec nisl a purus blandit viverra. Praesent egestas neque eu enim. In ac felis quis tortor malesuada pretium. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc.', 'eliteflow' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button {"style":{"spacing":{"padding":{"left":"34px","right":"34px"}}},"fontSize":"sml-medium"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-sml-medium-font-size has-custom-font-size wp-element-button" style="padding-right:34px;padding-left:34px"><?php echo esc_html__( 'Start Searching', 'eliteflow' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></main>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->