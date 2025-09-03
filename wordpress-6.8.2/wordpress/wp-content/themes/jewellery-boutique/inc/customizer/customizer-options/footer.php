<?php

function jewellery_boutique_footer( $wp_customize ) {
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Panel // 
	$wp_customize->add_panel( 
		'jewellery_boutique_footer_section', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer Options', 'jewellery-boutique'),
		) 
	);

	// Footer Widgets // 
	$wp_customize->add_section(
        'jewellery_boutique_footer_top',
        array(
            'title' 		=> __('Footer Widgets','jewellery-boutique'),
			'panel'  		=> 'jewellery_boutique_footer_section',
			'priority'      => 3,
		)
    );

    // Footer Widgets Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_footer_widgets_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_footer_widgets_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Footer Widgets', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_footer_top',
			'settings'    => 'jewellery_boutique_footer_widgets_setting',
			'type'        => 'checkbox'
		) 
	);

	// Footer Background Image Setting
	$wp_customize->add_setting('jewellery_boutique_footer_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'jewellery_boutique_footer_bg_image',array(
		'label' => __('Footer Background Image','jewellery-boutique'),
		'section' => 'jewellery_boutique_footer_top'
	)));

	// Footer Background Image Opacity
	$wp_customize->add_setting('jewellery_boutique_footer_bg_image_opacity', array(
		'default'           => 50,
		'sanitize_callback' => 'absint',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control('jewellery_boutique_footer_bg_image_opacity', array(
		'label'    => __('Footer Background Image Opacity (%)', 'jewellery-boutique'),
		'section'  => 'jewellery_boutique_footer_top',
		'type'     => 'range',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
	));

	// Footer Background Color Setting
    $wp_customize->add_setting('jewellery_boutique_footer_bg_color',array(
		'default' => '#000000',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'jewellery_boutique_footer_bg_color',array(
		'label' => esc_html__('Footer Background Color', 'jewellery-boutique'),
		'section' => 'jewellery_boutique_footer_top', // Adjust section if needed
		'settings' => 'jewellery_boutique_footer_bg_color',
	)));

	$wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_1',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
        $wp_customize, 'jewellery_boutique_upgrade_page_settings_1',
            array(
                'priority'      => 200,
                'section'       => 'jewellery_boutique_footer_top',
                'settings'      => 'jewellery_boutique_upgrade_page_settings_1',
                'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
            )
        )
    ); 

	// Footer Bottom // 
	$wp_customize->add_section(
        'jewellery_boutique_footer_bottom',
        array(
            'title' 		=> __('Footer Bottom','jewellery-boutique'),
			'panel'  		=> 'jewellery_boutique_footer_section',
			'priority'      => 3,
		)
    );

	// Site Title Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_footer_copyright_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_footer_copyright_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Footer Copyright', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_footer_bottom',
			'settings'    => 'jewellery_boutique_footer_copyright_setting',
			'type'        => 'checkbox'
		) 
	);
	
	// Footer Copyright 
	$wp_customize->add_setting(
    	'jewellery_boutique_footer_copyright',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 4,
		)
	);

	$wp_customize->add_control( 
		'jewellery_boutique_footer_copyright',
		array(
		    'label'   		=> __('Edit Copyright Text','jewellery-boutique'),
		    'section'		=> 'jewellery_boutique_footer_bottom',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting( 'jewellery_boutique_copyright_alignment', array(
        'default'   => 'center',
        'sanitize_callback' => 'jewellery_boutique_sanitize_copyright_position',
    ));

    $wp_customize->add_control( 'jewellery_boutique_copyright_alignment', array(
        'label'    => __( 'Copyright Position', 'jewellery-boutique' ),
        'section'  => 'jewellery_boutique_footer_bottom',
        'settings' => 'jewellery_boutique_copyright_alignment',
        'type'     => 'radio',
        'choices'  => array(
            'right' => __( 'Right Align', 'jewellery-boutique' ),
            'left'  => __( 'Left Align', 'jewellery-boutique' ),
            'center'  => __( 'Center Align', 'jewellery-boutique' ),
        ),
    ));

	$wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_2',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
        $wp_customize, 'jewellery_boutique_upgrade_page_settings_2',
            array(
                'priority'      => 200,
                'section'       => 'jewellery_boutique_footer_bottom',
                'settings'      => 'jewellery_boutique_upgrade_page_settings_2',
                'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
            )
        )
    ); 
}
add_action( 'customize_register', 'jewellery_boutique_footer' );

// Footer selective refresh
function jewellery_boutique_footer_partials( $wp_customize ){
	// footer_copyright
	$wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
		'selector'            => '.copy-right .copyright-text',
		'settings'            => 'footer_copyright',
		'render_callback'  => 'jewellery_boutique_footer_copyright_render_callback',
	) );
}
add_action( 'customize_register', 'jewellery_boutique_footer_partials' );

// copyright_content
function jewellery_boutique_footer_copyright_render_callback() {
	return get_theme_mod( 'footer_copyright' );
}