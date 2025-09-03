<?php
function jewellery_boutique_blog_setting( $wp_customize ) {

$wp_customize->register_control_type( 'Jewellery_Boutique_Control_Upgrade' );

$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'jewellery_boutique_frontpage_sections', array(
			'priority' => 1,
			'title' => esc_html__( 'Frontpage Sections', 'jewellery-boutique' ),
		)
	);
	
	/*=========================================
	Slider Section
	=========================================*/
	$wp_customize->add_section( 'jewellery_boutique_slider_section' , array(
    	'title'      => __( 'Banner Section', 'jewellery-boutique' ),
    	'priority' => 2,
		'panel' => 'jewellery_boutique_frontpage_sections'
	) );

	// Slider Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_slider_arrows' , 
			array(
			'default' => false,
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	$wp_customize->add_control(
	'jewellery_boutique_slider_arrows', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_slider_section',
			'settings'    => 'jewellery_boutique_slider_arrows',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting( 'jewellery_boutique_slider_page', array(
		'default'           => get_page_id_by_slug('slider-page'),
		'sanitize_callback' => 'jewellery_boutique_sanitize_dropdown_pages'
	) );

	$wp_customize->add_control( 'jewellery_boutique_slider_page', array(
		'label'    => __( 'Select Banner Page', 'jewellery-boutique' ),
		'section'  => 'jewellery_boutique_slider_section',
		'type'     => 'dropdown-pages'
	) );

	$wp_customize->add_setting('jewellery_boutique_slider_short_heading',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('jewellery_boutique_slider_short_heading',array(
		'label'	=> __('Add Banner short Heading','jewellery-boutique'),
		'section'=> 'jewellery_boutique_slider_section',
		'type'=> 'text'
	));
	
	$wp_customize->add_setting('jewellery_boutique_banner_slider_first', array(
	    'default'           => '',
	    'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'jewellery_boutique_banner_slider_first', array(
	    'label'   => __('Add Banner Image 1', 'jewellery-boutique'),
	    'section' => 'jewellery_boutique_slider_section',
	)));

	$wp_customize->add_setting('jewellery_boutique_banner_slider_sec', array(
	    'default'           => '',
	    'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'jewellery_boutique_banner_slider_sec', array(
	    'label'   => __('Add Banner Image 2', 'jewellery-boutique'),
	    'section' => 'jewellery_boutique_slider_section',
	)));

	$wp_customize->add_setting('jewellery_boutique_banner_slider_third', array(
	    'default'           => '',
	    'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'jewellery_boutique_banner_slider_third', array(
	    'label'   => __('Add Banner Image 3', 'jewellery-boutique'),
	    'section' => 'jewellery_boutique_slider_section',
	)));

	$wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_11101',
	array(
		'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
		$wp_customize, 'jewellery_boutique_upgrade_page_settings_11101',
			array(
				'priority'      => 200,
				'section'       => 'jewellery_boutique_slider_section',
				'settings'      => 'jewellery_boutique_upgrade_page_settings_11101',
				'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
			)
		)
	); 

	// Category Tab Section

	$wp_customize->add_section('jewellery_boutique_our_products_section',array(
		'title'	=> __('Product Categories Section','jewellery-boutique'),
		'panel' => 'jewellery_boutique_frontpage_sections',
		'priority' => 3,
	));

	// Slider Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'jewellery_boutique_our_products_show_hide_section' , 
			array(
			'default' => false,
			'sanitize_callback' => 'jewellery_boutique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	$wp_customize->add_control(
	'jewellery_boutique_our_products_show_hide_section', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'jewellery-boutique' ),
			'section'     => 'jewellery_boutique_our_products_section',
			'settings'    => 'jewellery_boutique_our_products_show_hide_section',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting( 
    	'jewellery_boutique_our_products_heading_section',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);	
	$wp_customize->add_control( 
		'jewellery_boutique_our_products_heading_section',
		array(
		    'label'   		=> __('Add Heading','jewellery-boutique'),
		    'section'		=> 'jewellery_boutique_our_products_section',
			'type' 			=> 'text',
		)
	);

	$wp_customize->add_setting('jewellery_boutique_product_section_btn_text1',array(
		'default'=> 'View All',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('jewellery_boutique_product_section_btn_text1',array(
		'label'	=> esc_html__('Add Button Text','jewellery-boutique'),
		'section'=> 'jewellery_boutique_our_products_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('jewellery_boutique_product_section_btn_link1',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('jewellery_boutique_product_section_btn_link1',array(
		'label'	=> esc_html__('Add Button link','jewellery-boutique'),
		'section'=> 'jewellery_boutique_our_products_section',
		'type'=> 'url'
	));

	$jewellery_boutique_args = array(
	    'type'           => 'product',
	    'child_of'       => 0,
	    'parent'         => '',
	    'orderby'        => 'term_group',
	    'order'          => 'ASC',
	    'hide_empty'     => false,
	    'hierarchical'   => 1,
	    'number'         => '',
	    'taxonomy'       => 'product_cat',
	    'pad_counts'     => false
	);
	$categories = get_categories($jewellery_boutique_args);
	$jewellery_boutique_cats = array();
	$i = 0;
	foreach ($categories as $category) {
	    if ($i == 0) {
	        $default = $category->slug;
	        $i++;
	    }
	    $jewellery_boutique_cats[$category->slug] = $category->name;
	}

	// Set the default value to "none"
	$jewellery_boutique_default_value = 'product_cat1';

	$wp_customize->add_setting(
	    'jewellery_boutique_our_product_product_category',
	    array(
	        'default'           => $jewellery_boutique_default_value,
	        'sanitize_callback' => 'jewellery_boutique_sanitize_select',
	    )
	);
	// Add "None" as an option in the select dropdown
	$jewellery_boutique_cats_with_none = array_merge(array('none' => 'None'), $jewellery_boutique_cats);

	$wp_customize->add_control(
	    'jewellery_boutique_our_product_product_category',
	    array(
	        'type'    => 'select',
	        'choices' => $jewellery_boutique_cats_with_none,
	        'label'   => __('Select Product Category', 'jewellery-boutique'),
	        'section' => 'jewellery_boutique_our_products_section',
	    )
	);

	$wp_customize->add_setting('jewellery_boutique_product_section_btn_text1',array(
		'default'=> 'View All',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('jewellery_boutique_product_section_btn_text1',array(
		'label'	=> esc_html__('Add Button Text','jewellery-boutique'),
		'section'=> 'jewellery_boutique_our_products_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('jewellery_boutique_product_section_btn_link1',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('jewellery_boutique_product_section_btn_link1',array(
		'label'	=> esc_html__('Add Button link','jewellery-boutique'),
		'section'=> 'jewellery_boutique_our_products_section',
		'type'=> 'url'
	));

	$wp_customize->add_setting( 'jewellery_boutique_upgrade_page_settings_1110',
	array(
		'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Jewellery_Boutique_Control_Upgrade(
		$wp_customize, 'jewellery_boutique_upgrade_page_settings_1110',
			array(
				'priority'      => 200,
				'section'       => 'jewellery_boutique_our_products_section',
				'settings'      => 'jewellery_boutique_upgrade_page_settings_1110',
				'label'         => __( 'Jewellery Boutique Pro comes with additional features.', 'jewellery-boutique' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'jewellery-boutique' ), __( 'One-Click Demo Import', 'jewellery-boutique' ), __( 'WooCommerce Integrated', 'jewellery-boutique' ), __( 'Drag & Drop Section Reordering', 'jewellery-boutique' ),__( 'Advanced Typography Control', 'jewellery-boutique' ),__( 'Intuitive Customization Options', 'jewellery-boutique' ),__( '24/7 Support', 'jewellery-boutique' ), )
			)
		)
	); 

}

add_action( 'customize_register', 'jewellery_boutique_blog_setting' );

// service selective refresh
function jewellery_boutique_blog_section_partials( $wp_customize ){	
	// blog_title
	$wp_customize->selective_refresh->add_partial( 'blog_title', array(
		'selector'            => '.home-blog .title h6',
		'settings'            => 'blog_title',
		'render_callback'  => 'jewellery_boutique_blog_title_render_callback',
	
	) );
	
	// blog_subtitle
	$wp_customize->selective_refresh->add_partial( 'blog_subtitle', array(
		'selector'            => '.home-blog .title h2',
		'settings'            => 'blog_subtitle',
		'render_callback'  => 'jewellery_boutique_blog_subtitle_render_callback',
	
	) );
	
	// blog_description
	$wp_customize->selective_refresh->add_partial( 'blog_description', array(
		'selector'            => '.home-blog .title p',
		'settings'            => 'blog_description',
		'render_callback'  => 'jewellery_boutique_blog_description_render_callback',
	
	) );	
	}

add_action( 'customize_register', 'jewellery_boutique_blog_section_partials' );

// blog_title
function jewellery_boutique_blog_title_render_callback() {
	return get_theme_mod( 'blog_title' );
}

// blog_subtitle
function jewellery_boutique_blog_subtitle_render_callback() {
	return get_theme_mod( 'blog_subtitle' );
}

// service description
function jewellery_boutique_blog_description_render_callback() {
	return get_theme_mod( 'blog_description' );
}