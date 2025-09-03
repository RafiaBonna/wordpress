<?php
/**
 * Jewellery Boutique Theme Customizer.
 *
 * @package Jewellery Boutique
 */

 if ( ! class_exists( 'Jewellery_Boutique_Customizer' ) ) {

	/**
	 * Customizer Loader
	 *
	 * @since 1.0.0
	 */
	class Jewellery_Boutique_Customizer {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object
		 */
		private static $jewellery_boutique_instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$jewellery_boutique_instance ) ) {
				self::$jewellery_boutique_instance = new self;
			}
			return self::$jewellery_boutique_instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			/**
			 * Customizer
			 */
			add_action( 'customize_preview_init',                  array( $this, 'Jewellery_Boutique_Customizer_preview_js' ) );
			add_action( 'customize_controls_enqueue_scripts', 	   array( $this, 'Jewellery_Boutique_Customizer_script' ) );
			add_action( 'customize_register',                      array( $this, 'Jewellery_Boutique_Customizer_register' ) );
			add_action( 'after_setup_theme',                       array( $this, 'Jewellery_Boutique_Customizer_settings' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function Jewellery_Boutique_Customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';			
			
			/**
			 * Helper files
			 */
			require JEWELLERY_BOUTIQUE_PARENT_INC_DIR . '/customizer/sanitization.php';
		} 
		
		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		function Jewellery_Boutique_Customizer_preview_js() {
			wp_enqueue_script( 'jewellery-boutique-customizer', JEWELLERY_BOUTIQUE_PARENT_INC_URI . '/customizer/assets/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
		}		
		
		function Jewellery_Boutique_Customizer_script() {
			 wp_enqueue_script( 'jewellery-boutique-customizer-section', JEWELLERY_BOUTIQUE_PARENT_INC_URI .'/customizer/assets/js/customizer-section.js', array("jquery"),'', true  );
		}

		// Include customizer customizer settings.
			
		function Jewellery_Boutique_Customizer_settings() {
			require JEWELLERY_BOUTIQUE_PARENT_INC_DIR . '/customizer/customizer-options/header.php';
			require JEWELLERY_BOUTIQUE_PARENT_INC_DIR . '/customizer/customizer-options/frontpage.php';
			require JEWELLERY_BOUTIQUE_PARENT_INC_DIR . '/customizer/customizer-options/footer.php';
			require JEWELLERY_BOUTIQUE_PARENT_INC_DIR . '/customizer/customizer-options/post.php';
			require JEWELLERY_BOUTIQUE_PARENT_INC_DIR . '/customizer/customizer-options/sidebar-option.php';
			require JEWELLERY_BOUTIQUE_PARENT_INC_DIR . '/customizer/customizer-options/typography.php';
			require JEWELLERY_BOUTIQUE_PARENT_INC_DIR . '/customizer/customizer-options/general.php';
			require JEWELLERY_BOUTIQUE_PARENT_INC_DIR . '/customizer/customizer-pro/class-customize.php';
			require JEWELLERY_BOUTIQUE_PARENT_INC_DIR . '/customizer/customizer-pro/customizer-upgrade-class.php';
		}

	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Jewellery_Boutique_Customizer::get_instance();