<?php
register_default_headers( array(
	'default-image' => array(
		'url'           => get_template_directory_uri() . '/assets/images/custom-header.png',
		'thumbnail_url' => get_template_directory_uri() . '/assets/images/custom-header.png',
		'description'   => __( 'Default Header Image', 'jewellery-boutique' ),
	),
) );