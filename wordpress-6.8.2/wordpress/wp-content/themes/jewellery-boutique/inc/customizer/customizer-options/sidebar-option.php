<?php
function jewellery_boutique_sidebar_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'jewellery_boutique_sidebar', array(
			'priority' => 31,
			'title' => esc_html__( 'Sidebar Options', 'jewellery-boutique' ),
		)
	);

	/*=========================================
	Sidebar Option  Section
	=========================================*/
	$wp_customize->add_section(
		'jewellery_boutique_sidebar_settings', array(
			'title' => esc_html__( 'Sidebar Options', 'jewellery-boutique' ),
			'priority' => 1,
			'panel' => 'jewellery_boutique_general',
		)
	);
	

	// Archive Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_archive_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_archive_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Archive Sidebar', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_sidebar_settings',
			'settings'    => 'jewellery_boutique_archive_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Index Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_index_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_index_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Index Sidebar', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_sidebar_settings',
			'settings'    => 'jewellery_boutique_index_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Pages Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_paged_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_paged_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Pages Sidebar', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_sidebar_settings',
			'settings'    => 'jewellery_boutique_paged_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Search Result Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_search_result_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_search_result_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Search Result Sidebar', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_sidebar_settings',
			'settings'    => 'jewellery_boutique_search_result_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Single Post Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_single_post_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_single_post_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Single Post Sidebar', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_sidebar_settings',
			'settings'    => 'jewellery_boutique_single_post_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Sidebar Page Sidebar Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_single_page_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_single_page_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Page Width Sidebar', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_sidebar_settings',
			'settings'    => 'jewellery_boutique_single_page_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting( 'jewellery_boutique_sidebar_position', array(
        'default'   => 'right',
        'sanitize_callback' => 'jewellery_boutique_sanitize_sidebar_position',
    ));

    $wp_customize->add_control( 'jewellery_boutique_sidebar_position', array(
        'label'    => __( 'Sidebar Position', 'jewellery-boutique' ),
        'section'  => 'jewellery_boutique_sidebar_settings',
        'settings' => 'jewellery_boutique_sidebar_position',
        'type'     => 'radio',
        'choices'  => array(
            'right' => __( 'Right Sidebar', 'jewellery-boutique' ),
            'left'  => __( 'Left Sidebar', 'jewellery-boutique' ),
        ),
    ));

	 $wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_15',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
        $wp_customize, 'jewellery_boutique_upgrade_page_settings_15',
            array(
                'priority'      => 200,
                'section'       => 'jewellery_boutique_sidebar_settings',
                'settings'      => 'jewellery_boutique_upgrade_page_settings_15',
                'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
            )
        )
    ); 
}

add_action( 'customize_register', 'jewellery_boutique_sidebar_setting' );