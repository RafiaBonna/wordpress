<?php
/**
 * Settings for demo import
 *
 */

/**
 * Define constants
 **/
if ( ! defined( 'WHIZZIE_DIR' ) ) {
	define( 'WHIZZIE_DIR', dirname( __FILE__ ) );
}
// Load the Whizzie class and other dependencies
require trailingslashit( WHIZZIE_DIR ) . 'demo-import-contents.php';
// Gets the theme object
$jewellery_boutique_current_theme = wp_get_theme();
$jewellery_boutique_theme_title = $jewellery_boutique_current_theme->get( 'Name' );


/**
 * Make changes below
 **/

// Change the title and slug of your wizard page
$config['jewellery_boutique_page_slug'] 	= 'jewellery-boutique';
$config['jewellery_boutique_page_title']	= 'Theme Demo Import';

// You can remove elements here as required
// Don't rename the IDs - nothing will break but your changes won't get carried through
$config['steps'] = array( 
	'intro' => array(
		'id'			=> 'intro', // ID for section - don't rename
		'title'			=> __( 'Welcome to ', 'jewellery-boutique' ) . $jewellery_boutique_theme_title, // Section title
		'icon'			=> 'dashboard', // Uses Dashicons
		'button_text'	=> __( 'Start Now', 'jewellery-boutique' ), // Button text
		'can_skip'		=> false // Show a skip button?
	),
	'plugins' => array(
		'id'			=> 'plugins',
		'title'			=> __( 'Plugins', 'jewellery-boutique' ),
		'icon'			=> 'admin-plugins',
		'button_text'	=> __( 'Install Plugins', 'jewellery-boutique' ),
		'can_skip'		=> true
	),
	'widgets' => array(
		'id'			=> 'widgets',
		'title'			=> __( 'Demo Importer', 'jewellery-boutique' ),
		'icon'			=> 'welcome-widgets-menus',
		'button_text'	=> __( 'Import Demo Content', 'jewellery-boutique' ),
		'can_skip'		=> true
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'All Done', 'jewellery-boutique' ),
		'icon'			=> 'yes',
	)
);

/**
 * This kicks off the wizard
 **/
if( class_exists( 'Whizzie' ) ) {
	$Whizzie = new Whizzie( $config );
}