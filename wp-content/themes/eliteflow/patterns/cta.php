<?php
/**
 * Title: CTA
 * Slug: eliteflow/cta
 * Categories: eliteflow
 * Keywords: cta
 * Block Types: core/post-content
 * Post Types: page, wp_template
 */
?>
<!-- wp:group {"metadata":{"name":"CTA"},"className":"wrapper","style":{"spacing":{"padding":{"right":"40px","left":"40px","top":"0px"},"margin":{"top":"0","bottom":"80px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group wrapper" style="margin-top:0;margin-bottom:80px;padding-top:0px;padding-right:40px;padding-left:40px"><!-- wp:cover {"url":"<?php echo esc_url( get_stylesheet_directory_uri() );?>/assets/images/banner.jpg","id":1046,"dimRatio":70,"isUserOverlayColor":true,"minHeight":550,"customGradient":"linear-gradient(135deg,rgb(0,0,0) 0%,rgb(0,0,0) 42%,rgb(20,12,12) 67%,rgb(0,0,0) 100%)","contentPosition":"center center","className":"banner-with-header","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"30px"}},"layout":{"type":"default"}} -->
<div class="wp-block-cover banner-with-header" style="border-radius:30px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:550px"><img class="wp-block-cover__image-background wp-image-1046" alt="" src="<?php echo esc_url( get_stylesheet_directory_uri() );?>/assets/images/banner.jpg" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-70 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(135deg,rgb(0,0,0) 0%,rgb(0,0,0) 42%,rgb(20,12,12) 67%,rgb(0,0,0) 100%)"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0"}}},"layout":{"type":"constrained","contentSize":"1500px"}} -->
<div class="wp-block-group" style="padding-top:0"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"60px","fontStyle":"normal","fontWeight":"500","lineHeight":"1"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontFamily":"body"} -->
<h2 class="wp-block-heading has-text-align-center has-white-color has-text-color has-link-color has-body-font-family" style="font-size:60px;font-style:normal;font-weight:500;line-height:1"><?php echo esc_html__( 'You Bring the Idea, We’ll Help You Launch!', 'eliteflow' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0"}}},"layout":{"type":"constrained","contentSize":"850px"}} -->
<div class="wp-block-group" style="padding-right:0;padding-left:0"><!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30);font-size:18px"><?php echo esc_html__( 'Fusce egestas elit eget lorem. Praesent nec nisl a purus blandit viverra. Praesent egestas neque eu enim. In ac felis quis tortor malesuada pretium. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc.', 'eliteflow' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button {"style":{"spacing":{"padding":{"left":"34px","right":"34px"}}},"fontSize":"sml-medium"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-sml-medium-font-size has-custom-font-size wp-element-button" style="padding-right:34px;padding-left:34px"><?php echo esc_html__( 'Start your business', 'eliteflow' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->