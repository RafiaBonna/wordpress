<?php


/**
 * EliteGrove functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @subpackage EliteGrove
 * @since EliteGrove 1.0
 */

 function elitegrove_block_assets(){
    // Enqueue theme stylesheet for the front-end.
    wp_enqueue_style( 'elitegrove-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'elitegrove-fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/all.css', array(), '5.15.3' );
	wp_enqueue_style( 'elitegrove-animatecss', get_template_directory_uri() . '/assets/css/animate.css');
	wp_enqueue_script('elitegrove-wow-script', get_template_directory_uri() . '/assets/js/wow.js', array('jquery'));
	wp_enqueue_script('elitegrove-main-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('elitegrove-jquery-sticky', get_template_directory_uri() . '/assets/js/jquery-sticky.js', array('jquery') );    
}

add_action('enqueue_block_assets', 'elitegrove_block_assets');

// register own theme pattern

function elitegrove_register_pattern_category() {

	$patterns = array();

	$block_pattern_categories = array(
		'elitegrove' => array( 'label' => __( 'EliteGrove', 'elitegrove' ) )
	);

	$block_pattern_categories = apply_filters( 'elitegrove_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}
}

add_action( 'init', 'elitegrove_register_pattern_category');

// Admin Info
require get_template_directory() . '/class/admin-info.php';

//recommend plugins
require get_theme_file_path( '/inc/tgm-plugin/tgmpa-hook.php' );