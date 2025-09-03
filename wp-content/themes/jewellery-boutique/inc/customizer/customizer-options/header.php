<?php
function jewellery_boutique_header_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	/*=========================================
	Header Settings Panel
	=========================================*/
	// $wp_customize->add_panel( 
	// 	'jewellery_boutique_header_section', 
	// 	array(
	// 		'priority'      => 2,
	// 		'capability'    => 'edit_theme_options',
	// 		'title'			=> __('Header', 'jewellery-boutique'),
	// 	) 
	// );

	/*=========================================
	Jewellery Boutique Site Identity
	=========================================*/
	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> __('Site Identity','jewellery-boutique'),
			'panel'  		=> 'jewellery_boutique_frontpage_sections',
		)
    );

    // Site Title Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_site_title_setting' , 
			array(
			'default' => '0',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_site_title_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Site Title', 'jewellery-boutique' ),
			'section'     => 'title_tagline',
			'settings'    => 'jewellery_boutique_site_title_setting',
			'type'        => 'checkbox'
		) 
	);

	// Tagline Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_tagline_setting' , 
			array(
			'default' => '',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_tagline_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Tagline', 'jewellery-boutique' ),
			'section'     => 'title_tagline',
			'settings'    => 'jewellery_boutique_tagline_setting',
			'type'        => 'checkbox'
		) 
	);

	// Add the setting for logo width
	$wp_customize->add_setting(
		'jewellery_boutique_logo_width',
		array(
			'default'           => '100',
			'sanitize_callback' => 'jewellery_boutique_sanitize_logo_width',
			'priority'          => 2,
		)
	);

	// Add control for logo width
	$wp_customize->add_control( 
		'jewellery_boutique_logo_width',
		array(
			'label'     => __('Logo Width', 'jewellery-boutique'),
			'section'   => 'title_tagline',
			'type'      => 'number',
			'input_attrs' => array(
				'min'   => 1,
				'max'   => 150,
				'step'  => 1,
			),
			'transport' => $selective_refresh,
		)  
	);

	$wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_156',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
        $wp_customize, 'jewellery_boutique_upgrade_page_settings_156',
            array(
                'priority'      => 200,
                'section'       => 'title_tagline',
                'settings'      => 'jewellery_boutique_upgrade_page_settings_156',
                'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
            )
        )
    );
	
    /*=========================================
	top header
	=========================================*/
	$wp_customize->add_section(
        'jewellery_boutique_topbar',
        array(
        	'priority'      => 3,
            'title' 		=> __('Header Information','jewellery-boutique'),
			'panel'  		=> 'jewellery_boutique_frontpage_sections',
		)
    );

    $wp_customize->add_setting('jewellery_boutique_call',array(
		'default'=> '',
		'sanitize_callback'	=> 'jewellery_boutique_sanitize_phone_number'
	));
	$wp_customize->add_control('jewellery_boutique_call',array(
		'label'	=> __('Add Phone Number','jewellery-boutique'),
		'section'=> 'jewellery_boutique_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_156a',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
        $wp_customize, 'jewellery_boutique_upgrade_page_settings_156a',
            array(
                'priority'      => 200,
                'section'       => 'jewellery_boutique_topbar',
                'settings'      => 'jewellery_boutique_upgrade_page_settings_156a',
                'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
            )
        )
    );

	$wp_customize->register_panel_type( 'jewellery_boutique_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'jewellery_boutique_WP_Customize_Section' );

}
add_action( 'customize_register', 'jewellery_boutique_header_settings' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class jewellery_boutique_WP_Customize_Panel extends WP_Customize_Panel {
	   public $panel;
	   public $type = 'jewellery_boutique_panel';
	   public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class jewellery_boutique_WP_Customize_Section extends WP_Customize_Section {
	   public $section;
	   public $type = 'jewellery_boutique_section';
	   public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
    	}
  	}
}