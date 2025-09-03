<?php
function jewellery_boutique_post_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'jewellery_boutique_post', array(
			'priority' => 31,
			'title' => esc_html__( 'Post Options', 'jewellery-boutique' ),
		)
	);

	/*=========================================
	Archive Post  Section
	=========================================*/
	$wp_customize->add_section(
		'jewellery_boutique_archive_post_setting', array(
			'title' => esc_html__( 'Archive Post', 'jewellery-boutique' ),
			'priority' => 1,
			'panel' => 'jewellery_boutique_post',
		)
	);

	// Layouts Post
	$wp_customize->add_setting('jewellery_boutique_blog_layout_option_setting',array(
	  'default' => 'Default',
	  'sanitize_callback' => 'jewellery_boutique_sanitize_choices'
	));
	$wp_customize->add_control(new Jewellery_Boutique_Image_Radio_Control($wp_customize, 'jewellery_boutique_blog_layout_option_setting', array(
	  'type' => 'select',
	  'label' => __('Blog Post Layouts','jewellery-boutique'),
	  'section' => 'jewellery_boutique_archive_post_setting',
	  'choices' => array(
		'Default' => esc_url(get_template_directory_uri()).'/assets/images/layout-1.png',
		'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout-2.png',
		'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout-3.png',
	))));
		
	// Post Heading Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_post_heading_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
		'jewellery_boutique_post_heading_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Heading', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_archive_post_setting',
			'settings'    => 'jewellery_boutique_post_heading_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Content Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_post_content_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_post_content_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Content', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_archive_post_setting',
			'settings'    => 'jewellery_boutique_post_content_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Featured Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_post_featured_image_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_post_featured_image_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Feature Image', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_archive_post_setting',
			'settings'    => 'jewellery_boutique_post_featured_image_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_post_date_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_post_date_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Date', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_archive_post_setting',
			'settings'    => 'jewellery_boutique_post_date_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_post_comments_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_post_comments_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Comment', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_archive_post_setting',
			'settings'    => 'jewellery_boutique_post_comments_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_post_author_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_post_author_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Author', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_archive_post_setting',
			'settings'    => 'jewellery_boutique_post_author_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Timing Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_post_timing_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_post_timing_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Timings', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_archive_post_setting',
			'settings'    => 'jewellery_boutique_post_timing_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Tags Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_post_tags_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_post_tags_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Tags', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_archive_post_setting',
			'settings'    => 'jewellery_boutique_post_tags_settings',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting('jewellery_boutique_excerpt_limit', array(
        'default'           => 50,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('jewellery_boutique_excerpt_limit', array(
        'label'   => __('Excerpt Word Limit', 'jewellery-boutique'),
        'section' => 'jewellery_boutique_archive_post_setting',
        'type'    => 'number',
    ));

	$wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_133',
	array(
		'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
		$wp_customize, 'jewellery_boutique_upgrade_page_settings_133',
			array(
				'priority'      => 200,
				'section'       => 'jewellery_boutique_archive_post_setting',
				'settings'      => 'jewellery_boutique_upgrade_page_settings_133',
				'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
			)
		)
	); 

	/*=========================================
	Single Post  Section
	=========================================*/
	$wp_customize->add_section(
		'jewellery_boutique_single_post', array(
			'title' => esc_html__( 'Single Post', 'jewellery-boutique' ),
			'priority' => 3,
			'panel' => 'jewellery_boutique_post',
		)
	);
	
	// Post Heading Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_single_post_heading_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_single_post_heading_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Heading', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_single_post',
			'settings'    => 'jewellery_boutique_single_post_heading_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Content Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_single_post_content_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_single_post_content_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Content', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_single_post',
			'settings'    => 'jewellery_boutique_single_post_content_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Featured Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_single_post_featured_image_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_single_post_featured_image_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Feature Image', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_single_post',
			'settings'    => 'jewellery_boutique_single_post_featured_image_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_single_post_date_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_single_post_date_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Date', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_single_post',
			'settings'    => 'jewellery_boutique_single_post_date_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_single_post_comments_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_single_post_comments_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Comment', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_single_post',
			'settings'    => 'jewellery_boutique_single_post_comments_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_single_post_author_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_single_post_author_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Author', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_single_post',
			'settings'    => 'jewellery_boutique_single_post_author_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_single_post_timing_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_single_post_timing_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Timings', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_single_post',
			'settings'    => 'jewellery_boutique_single_post_timing_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Tags Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_single_post_tags_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_single_post_tags_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Tags', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_single_post',
			'settings'    => 'jewellery_boutique_single_post_tags_settings',
			'type'        => 'checkbox'
		) 
	);
	
	// Related Posts Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_show_hide_related_post' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'jewellery_boutique_show_hide_related_post', 
		array(
			'label'	      => esc_html__( 'Hide / Show Related Posts', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_single_post',
			'settings'    => 'jewellery_boutique_show_hide_related_post',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting( 
    	'jewellery_boutique_related_posts_heading',
    	array(
			'default' => 'Related Posts',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority'      => 1,
		)
	);	

	$wp_customize->add_control( 
		'jewellery_boutique_related_posts_heading',
		array(
		    'label'   		=> __('Related Post Heading','jewellery-boutique'),
		    'section'		=> 'jewellery_boutique_single_post',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_setting('jewellery_boutique_related_post_counts', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('jewellery_boutique_related_post_counts', array(
        'label'   => __('Number Of Related Posts To Show', 'jewellery-boutique'),
        'section' => 'jewellery_boutique_single_post',
        'type'    => 'number',
    ));

	$wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_58',
	array(
		'sanitize_callback' => 'sanitize_text_field'
	)
	);
	$wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
		$wp_customize, 'jewellery_boutique_upgrade_page_settings_58',
			array(
				'priority'      => 200,
				'section'       => 'jewellery_boutique_single_post',
				'settings'      => 'jewellery_boutique_upgrade_page_settings_58',
				'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
			)
		)
	); 
}

add_action( 'customize_register', 'jewellery_boutique_post_setting' );