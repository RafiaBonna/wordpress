<?php

// In your theme's functions.php or equivalent
add_action('customize_controls_enqueue_scripts', function() {
    $version = wp_get_theme()->get('Version');
    
    // Define parameters
    $customizer_params = array(
        'some_key' => 'some_value', // Add your parameters here
    );
    
    wp_enqueue_script(
        'jewellery-boutique-customize-section-button',
        get_theme_file_uri('assets/js/customize-controls.js'),
        ['customize-controls'],
        $version,
        true
    );

    wp_enqueue_style(
        'jewellery-boutique-customize-section-button',
        get_theme_file_uri('assets/css/customize-controls.css'),
        ['customize-controls'],
        $version
    );

    wp_localize_script(
        'jewellery-boutique-customize-section-button',
        'jewellery_boutique_customizer_params',
        $customizer_params
    );
});


 /**
 * Enqueue scripts and styles.
 */
function jewellery_boutique_scripts() {
	// Styles	 

	wp_enqueue_style('bootstrap-min',get_template_directory_uri().'/assets/css/bootstrap.min.css');

	// owl
	wp_enqueue_style( 'owl-carousel-css', get_theme_file_uri( '/assets/css/owl.carousel.css' ) );
		
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/css/fontawesome-all.css' );
	
	wp_enqueue_style('jewellery-boutique-editor-style',get_template_directory_uri().'/assets/css/editor-style.css');

	wp_enqueue_style('jewellery-boutique-main', get_template_directory_uri() . '/assets/css/main.css');

	wp_enqueue_style('jewellery-boutique-woo', get_template_directory_uri() . '/assets/css/woo.css');
	
	wp_enqueue_style( 'jewellery-boutique-style', get_stylesheet_uri() );


	wp_enqueue_style('jewellery-boutique-main', get_stylesheet_uri(), array() );
		wp_style_add_data('jewellery-boutique-main', 'rtl', 'replace');
	
	// Scripts

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), false, true);

	wp_enqueue_script('jewellery-boutique-theme-js', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), false, true);

	wp_enqueue_script( 'owl-carousel-js', get_theme_file_uri( '/assets/js/owl.carousel.js' ), array( 'jquery' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'jewellery_boutique_scripts' );

// Function to enqueue custom CSS
function jewellery_boutique_enqueue_custom_css() {
    // Define a unique handle for your inline stylesheet
    $handle = 'jewellery-boutique-style';
    
    // Get the generated custom CSS
    $jewellery_boutique_custom_css = "";

    $jewellery_boutique_blog_layouts = get_theme_mod('jewellery_boutique_blog_layout_option_setting', 'Default');
    if ($jewellery_boutique_blog_layouts == 'Default') {
        $jewellery_boutique_custom_css .= '.blog-item{';
        $jewellery_boutique_custom_css .= 'text-align:center;';
        $jewellery_boutique_custom_css .= '}';
    } elseif ($jewellery_boutique_blog_layouts == 'Left') {
        $jewellery_boutique_custom_css .= '.blog-item{';
        $jewellery_boutique_custom_css .= 'text-align:Left;';
        $jewellery_boutique_custom_css .= '}';
    } elseif ($jewellery_boutique_blog_layouts == 'Right') {
        $jewellery_boutique_custom_css .= '.blog-item{';
        $jewellery_boutique_custom_css .= 'text-align:Right;';
        $jewellery_boutique_custom_css .= '}';
    }
    // Enqueue the inline stylesheet
    wp_add_inline_style($handle, $jewellery_boutique_custom_css);

    // Get the generated custom CSS
    $jewellery_boutique_custom_css = "";

    $jewellery_boutique_slider_arrows = get_theme_mod('jewellery_boutique_slider_arrows',false);
    if($jewellery_boutique_slider_arrows == false){
    $jewellery_boutique_custom_css .='.page-template-template-frontpage .headerbox{';
        $jewellery_boutique_custom_css .='position:static; border-bottom:1px solid #ccc';
    $jewellery_boutique_custom_css .='}';
    }

    // Enqueue the inline stylesheet
    wp_add_inline_style($handle, $jewellery_boutique_custom_css);

    // Add inline style for Scroll to Top
    $jewellery_boutique_scroll_top_bg_color = get_theme_mod('jewellery_boutique_scroll_top_bg_color', '#CCA633');
    $jewellery_boutique_scroll_top_color = get_theme_mod('jewellery_boutique_scroll_top_color', '#fff');
    $jewellery_boutique_scroll_custom_css = "
        #scrolltop {
            background-color: {$jewellery_boutique_scroll_top_bg_color};
        }
        #scrolltop span {
            color: {$jewellery_boutique_scroll_top_color};
        }
    ";
    wp_add_inline_style('jewellery-boutique-style', $jewellery_boutique_scroll_custom_css);

    // Add inline style for Preloader
    $jewellery_boutique_preloader_bg_color = get_theme_mod('jewellery_boutique_preloader_bg_color', '#ffffff');
    $jewellery_boutique_preloader_color = get_theme_mod('jewellery_boutique_preloader_color', '#CCA633');
    $jewellery_boutique_preloader_custom_css = "
        .loading {
            background-color: {$jewellery_boutique_preloader_bg_color};
        }
        .loader {
            border-color: {$jewellery_boutique_preloader_color};
            color: {$jewellery_boutique_preloader_color};
            text-shadow: 0 0 10px {$jewellery_boutique_preloader_color};
        }
        .loader::before {
            border-top-color: {$jewellery_boutique_preloader_color};
            border-right-color: {$jewellery_boutique_preloader_color};
        }
        .loader span::before {
            background: {$jewellery_boutique_preloader_color};
            box-shadow: 0 0 10px {$jewellery_boutique_preloader_color};
        }
    ";
    wp_add_inline_style('jewellery-boutique-style', $jewellery_boutique_preloader_custom_css);
}

// Hook the function to the 'wp_enqueue_scripts' action
add_action('wp_enqueue_scripts', 'jewellery_boutique_enqueue_custom_css');

//Admin Enqueue for Admin
function jewellery_boutique_admin_enqueue_scripts(){
    wp_enqueue_style('jewellery-boutique-admin-style', esc_url( get_template_directory_uri() ) . '/inc/aboutthemes/admin.css');
    wp_enqueue_script('dismiss-notice-script', get_stylesheet_directory_uri() . '/inc/aboutthemes/theme-admin-notice.js', array('jquery'), null, true);
}
add_action( 'admin_enqueue_scripts', 'jewellery_boutique_admin_enqueue_scripts' );