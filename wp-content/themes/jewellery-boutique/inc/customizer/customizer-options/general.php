<?php
function jewellery_boutique_general_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'jewellery_boutique_general', array(
			'priority' => 2,
			'title' => esc_html__( 'General Options', 'jewellery-boutique' ),
		)
	);

	/*=========================================
	Breadcrumb  Section
	=========================================*/
	$wp_customize->add_section(
		'jewellery_boutique_breadcrumb_setting', array(
			'title' => esc_html__( 'Breadcrumb Options', 'jewellery-boutique' ),
			'priority' => 1,
			'panel' => 'jewellery_boutique_general',
		)
	);
	
	// Settings 
	$wp_customize->add_setting(
		'jewellery_boutique_breadcrumb_settings'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'jewellery_boutique_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'jewellery_boutique_breadcrumb_settings',
		array(
			'type' => 'hidden',
			'label' => __('Settings','jewellery-boutique'),
			'section' => 'jewellery_boutique_breadcrumb_setting',
		)
	);
	
	// Breadcrumb Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_hs_breadcrumb' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_hs_breadcrumb', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_breadcrumb_setting',
			'settings'    => 'jewellery_boutique_hs_breadcrumb',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting(
    	'jewellery_boutique_breadcrumb_seprator',
    	array(
			'default' => '/',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'jewellery_boutique_breadcrumb_seprator',
		array(
		    'label'   		=> __('Breadcrumb separator','jewellery-boutique'),
		    'section'		=> 'jewellery_boutique_breadcrumb_setting',
			'type' 			=> 'text',
		)  
	);

	$wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_5',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
        $wp_customize, 'jewellery_boutique_upgrade_page_settings_5',
            array(
                'priority'      => 200,
                'section'       => 'jewellery_boutique_breadcrumb_setting',
                'settings'      => 'jewellery_boutique_upgrade_page_settings_5',
                'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
            )
        )
    ); 

	/*=========================================
	Preloader Section
	=========================================*/
	$wp_customize->add_section(
		'jewellery_boutique_preloader_section_setting', array(
			'title' => esc_html__( 'Preloader Options', 'jewellery-boutique' ),
			'priority' => 3,
			'panel' => 'jewellery_boutique_general',
		)
	);

	// Preloader Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_preloader_setting' , 
			array(
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_preloader_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Preloader', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_preloader_section_setting',
			'settings'    => 'jewellery_boutique_preloader_setting',
			'type'        => 'checkbox'
		) 
	);

	
	$wp_customize->add_setting(
    	'jewellery_boutique_preloader_text',
    	array(
			'default' => 'Loading',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'jewellery_boutique_preloader_text',
		array(
		    'label'   		=> __('Preloader Text','jewellery-boutique'),
		    'section'		=> 'jewellery_boutique_preloader_section_setting',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)
	);

	// Preloader Background Color Setting
	$wp_customize->add_setting(
		'jewellery_boutique_preloader_bg_color',
		array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jewellery_boutique_preloader_bg_color',
			array(
				'label' => esc_html__('Preloader Background Color', 'jewellery-boutique'),
				'section' => 'jewellery_boutique_preloader_section_setting', // Adjust section if needed
				'settings' => 'jewellery_boutique_preloader_bg_color',
			)
		)
	);

	// Preloader Color Setting
	$wp_customize->add_setting(
		'jewellery_boutique_preloader_color',
		array(
			'default' => '#CCA633',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jewellery_boutique_preloader_color',
			array(
				'label' => esc_html__('Preloader Color', 'jewellery-boutique'),
				'section' => 'jewellery_boutique_preloader_section_setting', // Adjust section if needed
				'settings' => 'jewellery_boutique_preloader_color',
			)
		)
	);

	$wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_6',
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
		$wp_customize, 'jewellery_boutique_upgrade_page_settings_6',
			array(
				'priority'      => 200,
				'section'       => 'jewellery_boutique_preloader_section_setting',
				'settings'      => 'jewellery_boutique_upgrade_page_settings_6',
				'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
			)
		)
	); 


	/*=========================================
	Scroll To Top Section
	=========================================*/
	$wp_customize->add_section(
		'jewellery_boutique_scroll_to_top_section_setting', array(
			'title' => esc_html__( 'Scroll To Top Options', 'jewellery-boutique' ),
			'priority' => 3,
			'panel' => 'jewellery_boutique_footer_section',
		)
	);

	// Scroll To Top Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_scroll_top_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_scroll_top_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Scroll To Top', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_scroll_to_top_section_setting',
			'settings'    => 'jewellery_boutique_scroll_top_setting',
			'type'        => 'checkbox'
		) 
	);

	// Scroll To Top Color Setting
	$wp_customize->add_setting(
		'jewellery_boutique_scroll_top_color',
		array(
			'default'           => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jewellery_boutique_scroll_top_color',
			array(
				'label'    => esc_html__( 'Scroll To Top Color', 'jewellery-boutique' ),
				'section'  => 'jewellery_boutique_scroll_to_top_section_setting',
				'settings' => 'jewellery_boutique_scroll_top_color',
			)
		)
	);

	// Scroll To Top Background Color Setting
	$wp_customize->add_setting(
		'jewellery_boutique_scroll_top_bg_color',
		array(
			'default'           => '#CCA633',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jewellery_boutique_scroll_top_bg_color',
			array(
				'label'    => esc_html__( 'Scroll To Top Background Color', 'jewellery-boutique' ),
				'section'  => 'jewellery_boutique_scroll_to_top_section_setting',
				'settings' => 'jewellery_boutique_scroll_top_bg_color',
			)
		)
	);

	 $wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_7',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
        $wp_customize, 'jewellery_boutique_upgrade_page_settings_7',
            array(
                'priority'      => 200,
                'section'       => 'jewellery_boutique_scroll_to_top_section_setting',
                'settings'      => 'jewellery_boutique_upgrade_page_settings_7',
                'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
            )
        )
    ); 


	/*=========================================
	Woocommerce Section
	=========================================*/
	$wp_customize->add_section(
		'jewellery_boutique_woocommerce_section_setting', array(
			'title' => esc_html__( 'Woocommerce Settings', 'jewellery-boutique' ),
			'priority' => 3,
			'panel' => 'woocommerce',
		)
	);

	$wp_customize->add_setting(
    	'jewellery_boutique_custom_shop_per_columns',
    	array(
			'default' => '3',
			'sanitize_callback' => 'absint',
		)
	);	
	$wp_customize->add_control( 
		'jewellery_boutique_custom_shop_per_columns',
		array(
		    'label'   		=> __('Product Per Columns','jewellery-boutique'),
		    'section'		=> 'jewellery_boutique_woocommerce_section_setting',
			'type' 			=> 'number',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting(
    	'jewellery_boutique_custom_shop_product_per_page',
    	array(
			'default' => '9',
			'sanitize_callback' => 'absint',
		)
	);	
	$wp_customize->add_control( 
		'jewellery_boutique_custom_shop_product_per_page',
		array(
		    'label'   		=> __('Product Per Page','jewellery-boutique'),
		    'section'		=> 'jewellery_boutique_woocommerce_section_setting',
			'type' 			=> 'number',
			'transport'         => $selective_refresh,
		)  
	);

	// Woocommerce Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_wocommerce_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_wocommerce_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Woocommerce Sidebar', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_woocommerce_section_setting',
			'settings'    => 'jewellery_boutique_wocommerce_sidebar_setting',
			'type'        => 'checkbox'
		)
	);

	$wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_22',
	array(
		'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
		$wp_customize, 'jewellery_boutique_upgrade_page_settings_22',
			array(
				'priority'      => 200,
				'section'       => 'jewellery_boutique_woocommerce_section_setting',
				'settings'      => 'jewellery_boutique_upgrade_page_settings_22',
				'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
			)
		)
	); 

	/*=========================================
	Sticky Header Section
	=========================================*/
	$wp_customize->add_section(
		'sticky_header_section_setting', array(
			'title' => esc_html__( 'Sticky Header Options', 'jewellery-boutique' ),
			'priority' => 3,
			'panel' => 'jewellery_boutique_general',
		)
	);

	// Sticky Header Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_sticky_header' , 
			array(
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_sticky_header', 
		array(
			'label'	      => esc_html__( 'Hide / Show Sticky Header', 'jewellery-boutique' ),
			'section'     => 'sticky_header_section_setting',
			'settings'    => 'jewellery_boutique_sticky_header',
			'type'        => 'checkbox'
		) 
	);

	 $wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_9',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
        $wp_customize, 'jewellery_boutique_upgrade_page_settings_9',
            array(
                'priority'      => 200,
                'section'       => 'sticky_header_section_setting',
                'settings'      => 'jewellery_boutique_upgrade_page_settings_9',
                'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
            )
        )
    ); 

	/*=========================================
	404 Page Options
	=========================================*/
	$wp_customize->add_section(
		'jewellery_boutique_404_section', array(
			'title' => esc_html__( '404 Page Options', 'jewellery-boutique' ),
			'priority' => 1,
			'panel' => 'jewellery_boutique_general',
		)
	);

	$wp_customize->add_setting(
    	'jewellery_boutique_404_title',
    	array(
			'default' => '404',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 2,
		)
	);	
	$wp_customize->add_control( 
		'jewellery_boutique_404_title',
		array(
		    'label'   		=> __('404 Heading','jewellery-boutique'),
		    'section'		=> 'jewellery_boutique_404_section',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting(
    	'jewellery_boutique_404_Text',
    	array(
			'default' => 'Page Not Found',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 2,
		)
	);	
	$wp_customize->add_control( 
		'jewellery_boutique_404_Text',
		array(
		    'label'   		=> __('404 Title','jewellery-boutique'),
		    'section'		=> 'jewellery_boutique_404_section',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting(
    	'jewellery_boutique_404_content',
    	array(
			'default' => 'The page you were looking for could not be found.',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 2,
		)
	);	
	$wp_customize->add_control( 
		'jewellery_boutique_404_content',
		array(
		    'label'   		=> __('404 Content','jewellery-boutique'),
		    'section'		=> 'jewellery_boutique_404_section',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	 $wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_10',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
        $wp_customize, 'jewellery_boutique_upgrade_page_settings_10',
            array(
                'priority'      => 200,
                'section'       => 'jewellery_boutique_404_section',
                'settings'      => 'jewellery_boutique_upgrade_page_settings_10',
                'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
            )
        )
    ); 

}

add_action( 'customize_register', 'jewellery_boutique_general_setting' );