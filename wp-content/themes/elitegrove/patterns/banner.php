<?php
/**
 * Title: Featured Banner
 * Slug: elitegrove/banner
 * Categories: elitegrove
 * Keywords: banner
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() );?>/assets/images/bannerbg.jpg","id":53,"dimRatio":0,"overlayColor":"black","isUserOverlayColor":true,"minHeight":650,"isDark":false,"metadata":{"name":"Banner"},"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-cover is-light" style="margin-top:0;margin-bottom:0;min-height:650px"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-53" alt="" src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/bannerbg.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1,"style":{"elements":{"link":{"color":{"text":"var:preset|color|white-text-color"}}},"typography":{"fontSize":"80px","lineHeight":"1"}},"textColor":"white-text-color"} -->
<h1 class="wp-block-heading has-text-align-center has-white-text-color-color has-text-color has-link-color" style="font-size:80px;line-height:1"><?php echo esc_html__( 'Transform Finance into Innovation', 'elitegrove' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|white-text-color"}}}},"textColor":"white-text-color"} -->
<p class="has-text-align-center has-white-text-color-color has-text-color has-link-color"><?php echo esc_html__( 'Pellentesque dapibus hendrerit tortor. Cras non dolor. Fusce vel dui. Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula. Cras sagittis.', 'elitegrove' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30)"><!-- wp:button {"style":{"spacing":{"padding":{"left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}}} -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" style="padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><?php echo esc_html__( 'Free Consultation', 'elitegrove' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->