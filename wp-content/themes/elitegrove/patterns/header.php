<?php
/**
 * Title: Header
 * Slug: elitegrove/header
 * Categories: header, elitegrove
 * Keywords: header
 * Block Types: core/template-part/header
 */
?>
<!-- wp:group {"tagName":"header","style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"20px","right":"20px"}}},"backgroundColor":"secondary-bg","layout":{"type":"constrained"}} -->
<header id="sticky-header" class="wp-block-group has-secondary-bg-background-color has-background" style="padding-top:24px;padding-right:20px;padding-bottom:24px;padding-left:20px"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:site-title {"style":{"typography":{"fontSize":"26px"}}} /-->

<!-- wp:site-tagline {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontStyle":"italic","fontWeight":"400"}}} /--></div>
<!-- /wp:group -->

<!-- wp:navigation {"textColor":"black","icon":"menu","overlayBackgroundColor":"white-text-color","overlayTextColor":"black","metadata":{"ignoredHookedBlocks":["woocommerce/customer-account","woocommerce/mini-cart"]},"style":{"spacing":{"blockGap":"40px"},"typography":{"fontStyle":"normal","fontWeight":"600"}}} /-->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Get Started', 'elitegrove' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></header>
<!-- /wp:group -->