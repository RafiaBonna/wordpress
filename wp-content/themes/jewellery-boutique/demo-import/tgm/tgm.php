<?php

	require get_template_directory() . '/demo-import/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function jewellery_boutique_register_recommended_plugins() {
	$plugins = array(
		
		array(
			'name'             => __( 'WooCommerce', 'jewellery-boutique' ),
			'slug'             => 'woocommerce',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'YITH WooCommerce Wishlist', 'jewellery-boutique' ),
			'slug'             => 'yith-woocommerce-wishlist',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),

		array(
			'name'             => __( 'FAQly – Ultimate FAQ', 'jewellery-boutique' ),
			'slug'             => 'faqly-ultimate-faq',
			'required'         => false,
			'force_activation' => false,
		)
		
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'jewellery_boutique_register_recommended_plugins' );