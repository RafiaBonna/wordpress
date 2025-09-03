<?php

/**
 * Shop Toolkit  Theme Customizer
 *
 * @package Shop Toolkit 
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer. 
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function shop_toolkit_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    //select sanitization function
    function shop_toolkit_sanitize_select($input, $setting)
    {
        $input = sanitize_key($input);
        $choices = $setting->manager->get_control($setting->id)->choices;
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }

    $theme_info = wp_get_theme();
    $theme_domain = $theme_info->get('TextDomain');
    if ($theme_domain == 'shop-toolkit') {
        $topbar_default = '1';
    } else {
        $topbar_default = '';
    }

    // Typography section
    $wp_customize->add_section('shop_toolkit_typography', array(
        'title' => __('Shop Toolkit Theme typography', 'shop-toolkit'),
        'capability'     => 'edit_theme_options',
        'description'     => __('You can setup Shop Toolkit  theme typography by these options.', 'shop-toolkit'),
        'priority'       => 4,

    ));
    $wp_customize->add_setting('shop_toolkit_theme_fonts', array(
        'default'       => 'Poppins',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_theme_font',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_theme_fonts_control', array(
        'label'      => __('Select theme body Font', 'shop-toolkit'),
        'section'    => 'shop_toolkit_typography',
        'settings'   => 'shop_toolkit_theme_fonts',
        'type'       => 'select',
        'choices'    => array(
            'Poppins' => __('Poppins', 'shop-toolkit'),
            'Noto Serif' => __('Noto Serif', 'shop-toolkit'),
            'Roboto' => __('Roboto', 'shop-toolkit'),
            'Open Sans' => __('Open Sans', 'shop-toolkit'),
            'Lato' => __('Lato', 'shop-toolkit'),
            'Montserrat' => __('Montserrat', 'shop-toolkit'),
            'Crimson Text' => __('Crimson Text', 'shop-toolkit'),
        ),
    ));
    $wp_customize->add_setting('shop_toolkit_font_size', array(
        'default' =>  '14',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_font_size_control', array(
        'label'      => __('Body font size', 'shop-toolkit'),
        'description'     => __('Default body font size is 14px', 'shop-toolkit'),
        'section'    => 'shop_toolkit_typography',
        'settings'   => 'shop_toolkit_font_size',
        'type'       => 'text',

    ));
    $wp_customize->add_setting('shop_toolkit_font_line_height', array(
        'default' =>  '24',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_font_line_height_control', array(
        'label'      => __('Body font line height', 'shop-toolkit'),
        'description'     => __('Default body line height is 24px', 'shop-toolkit'),
        'section'    => 'shop_toolkit_typography',
        'settings'   => 'shop_toolkit_font_line_height',
        'type'       => 'text',

    ));
    $wp_customize->add_setting('shop_toolkit_theme_font_head', array(
        'default'       => 'Noto Serif',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_theme_head_font',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_theme_font_head_control', array(
        'label'      => __('Select theme header Font', 'shop-toolkit'),
        'section'    => 'shop_toolkit_typography',
        'settings'   => 'shop_toolkit_theme_font_head',
        'type'       => 'select',
        'choices'    => array(
            'Poppins' => __('Poppins', 'shop-toolkit'),
            'Noto Serif' => __('Noto Serif', 'shop-toolkit'),
            'Roboto' => __('Roboto', 'shop-toolkit'),
            'Open Sans' => __('Open Sans', 'shop-toolkit'),
            'Lato' => __('Lato', 'shop-toolkit'),
            'Montserrat' => __('Montserrat', 'shop-toolkit'),
            'Crimson Text' => __('Crimson Text', 'shop-toolkit'),
        ),
    ));
    $wp_customize->add_setting('shop_toolkit_font_weight_head', array(
        'default'       => '700',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_font_weight_head_control', array(
        'label'      => __('Site header font weight', 'shop-toolkit'),
        'section'    => 'shop_toolkit_typography',
        'settings'   => 'shop_toolkit_font_weight_head',
        'type'       => 'select',
        'choices'    => array(
            '400' => __('Normal', 'shop-toolkit'),
            '500' => __('Semi Bold', 'shop-toolkit'),
            '700' => __('Bold', 'shop-toolkit'),
            '900' => __('Extra Bold', 'shop-toolkit'),
        ),
    ));
    /*End typography section*/

    // Add Shop Toolkit top header section
    $wp_customize->add_section('shop_toolkit_topbar', array(
        'title' => __('Shop Toolkit Top bar', 'shop-toolkit'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The Shop Toolkit topbar options ', 'shop-toolkit'),
        'priority'       => 5,

    ));
    $wp_customize->add_setting('shop_toolkit_topbar_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  $topbar_default,
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_topbar_show', array(
        'label'      => __('Show header topbar? ', 'shop-toolkit'),
        'description' => __('You can show or hide header topbar.', 'shop-toolkit'),
        'section'    => 'shop_toolkit_topbar',
        'settings'   => 'shop_toolkit_topbar_show',
        'type'       => 'checkbox',

    ));
    $wp_customize->add_setting('shop_toolkit_topbar_mtext', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  esc_html__('Welcome to Our Website !', 'shop-toolkit'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_topbar_mtext', array(
        'label'      => __('Welcome text', 'shop-toolkit'),
        'description'     => esc_html__('Enter your website welcome text. Leave empty if you don\'t want the text.', 'shop-toolkit'),
        'section'    => 'shop_toolkit_topbar',
        'settings'   => 'shop_toolkit_topbar_mtext',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('shop_toolkit_topbar_menushow', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_topbar_menushow', array(
        'label'      => __('Show header topbar menu? ', 'shop-toolkit'),
        'description' => __('You can show or hide topbar menu. You need to add menu from menu section for display menu.', 'shop-toolkit'),
        'section'    => 'shop_toolkit_topbar',
        'settings'   => 'shop_toolkit_topbar_menushow',
        'type'       => 'checkbox',

    ));

    $wp_customize->add_setting('shop_toolkit_topbar_search_item', array(
        'default'        => 'simple',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_topbar_search_item', array(
        'label'      => __('Select header topbar search type', 'shop-toolkit'),
        'description' => __('You can show two different way or hide topbar search. ', 'shop-toolkit'),
        'section'    => 'shop_toolkit_topbar',
        'settings'   => 'shop_toolkit_topbar_search_item',
        'type'       => 'select',
        'choices'    => array(
            'simple' => __('Simple Search', 'shop-toolkit'),
            'popup' => __('Popup Search', 'shop-toolkit'),
            'hide' => __('Hide Search', 'shop-toolkit'),
        ),
    ));
    // Add setting
    $wp_customize->add_setting('shop_toolkit_topbar_bg', array(
        'default' => '#ededed',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_topbar_bg',
            array(
                'label' => __('Topbar Background Color', 'shop-toolkit'),
                'section' => 'shop_toolkit_topbar'
            )
        )
    );
    // Add setting
    $wp_customize->add_setting('shop_toolkit_topbar_color', array(
        'default' => '#000',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_topbar_color',
            array(
                'label' => __('Topbar text Color', 'shop-toolkit'),
                'section' => 'shop_toolkit_topbar'
            )
        )
    );
    // Add setting
    $wp_customize->add_setting('shop_toolkit_topbar_hcolor', array(
        'default' => '#6b14fa',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_topbar_hcolor',
            array(
                'label' => __('Topbar link hover Color', 'shop-toolkit'),
                'section' => 'shop_toolkit_topbar'
            )
        )
    ); // topbar section end
    /*header image height*/

    /*
      * Logo position 
       */
    $wp_customize->add_setting('shop_toolkit_himg_height', array(
        'default'        => 'fixed',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_select',
        'transport' => 'refresh',
        //  'priority'       => 20,
    ));
    $wp_customize->add_control('shop_toolkit_himg_height', array(
        'label'      => __('Header image height', 'shop-toolkit'),
        'section'    => 'header_image',
        'settings'   => 'shop_toolkit_himg_height',
        'type'       => 'select',
        'choices'    => array(
            'fixed' => __('Fixed Height', 'shop-toolkit'),
            'auto' => __('Auto Height', 'shop-toolkit'),
            'amobile' => __('Auto height only small devices', 'shop-toolkit'),
        ),
    ));

    //logo width
    $wp_customize->add_setting('shop_toolkit_logo_width', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_logo_width_control', array(
        'label'      => __('Set Image Logo Width', 'shop-toolkit'),
        'description'     => __('Set your site logo Width.', 'shop-toolkit'),
        'section'    => 'title_tagline',
        'settings'   => 'shop_toolkit_logo_width',
        'type'       => 'number',
        'priority'       => 6,

    ));
    $wp_customize->add_setting('shop_toolkit_logo_height', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',

    ));
    $wp_customize->add_control('shop_toolkit_logo_height_control', array(
        'label'      => __('Set Image Logo height', 'shop-toolkit'),
        'description'     => __('Set your site logo height. Leave empty for auto height.', 'shop-toolkit'),
        'section'    => 'title_tagline',
        'settings'   => 'shop_toolkit_logo_height',
        'type'       => 'number',
        'priority'       => 7,
    ));
    $wp_customize->add_setting('shop_toolkit_tagline_bgshow', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_tagline_bgshow', array(
        'label'      => __('Show tagline background? ', 'shop-toolkit'),
        'description' => __('You can show or hide header tagline background.', 'shop-toolkit'),
        'section'    => 'title_tagline',
        'settings'   => 'shop_toolkit_tagline_bgshow',
        'type'       => 'checkbox',

    ));
    $wp_customize->add_setting('shop_toolkit_logo_fontsize', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_logo_fontsize', array(
        'label'      => __('Site Title Font Size', 'shop-toolkit'),
        'description'     => __('Set your site title font size.', 'shop-toolkit'),
        'section'    => 'title_tagline',
        'settings'   => 'shop_toolkit_logo_fontsize',
        'type'       => 'number',

    ));
    $wp_customize->add_setting('shop_toolkit_desc_fontsize', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',

    ));
    $wp_customize->add_control('shop_toolkit_desc_fontsize', array(
        'label'      => __('Set Site Tagline Font Size', 'shop-toolkit'),
        'description'     => __('Set your site tabline font size.', 'shop-toolkit'),
        'section'    => 'title_tagline',
        'settings'   => 'shop_toolkit_desc_fontsize',
        'type'       => 'number',
    ));

    /*
      * Logo position 
       */
    $wp_customize->add_setting('shop_toolkit_logo_position', array(
        'default'        => 'left',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_select',
        'transport' => 'refresh',
        //  'priority'       => 20,
    ));
    $wp_customize->add_control('shop_toolkit_logo_position', array(
        'label'      => __('Select Logo Position', 'shop-toolkit'),
        'section'    => 'title_tagline',
        'settings'   => 'shop_toolkit_logo_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Logo left', 'shop-toolkit'),
            'center' => __('Logo center', 'shop-toolkit'),
            'right' => __('Logo right', 'shop-toolkit'),
        ),
    ));

    // Header middle section
    $wp_customize->add_section('shop_toolkit_middle', array(
        'title' => __('Shop Toolkit Header Middle', 'shop-toolkit'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The Shop Toolkit header middle section ', 'shop-toolkit'),
        'priority'       => 6,

    ));
    $wp_customize->add_setting('shop_toolkit_hmiddle_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_hmiddle_show', array(
        'label'      => __('Show header Middle? ', 'shop-toolkit'),
        'description' => __('You can show or hide header middle section. And can show logo in menu bar', 'shop-toolkit'),
        'section'    => 'shop_toolkit_middle',
        'settings'   => 'shop_toolkit_hmiddle_show',
        'type'       => 'checkbox',

    ));
    $wp_customize->add_setting('shop_toolkit_hmiddle_height', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',

    ));
    $wp_customize->add_control('shop_toolkit_hmiddle_height', array(
        'label'      => __('Set header middle section height', 'shop-toolkit'),
        'description'     => __('Set your header middle section height. Leave empty for auto height.', 'shop-toolkit'),
        'section'    => 'shop_toolkit_middle',
        'settings'   => 'shop_toolkit_hmiddle_height',
        'type'       => 'number',
    ));


    // Header middle section
    $wp_customize->add_section('shop_toolkit_main_menu', array(
        'title' => __('Shop Toolkit Main Menu', 'shop-toolkit'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The Shop Toolkit main menu section. You need to add menu from WordPress menu setup for display the menu manu ', 'shop-toolkit'),
        'priority'       => 6,

    ));
    $wp_customize->add_setting('shop_toolkit_main_menu_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_main_menu_show', array(
        'label'      => __('Show Main Menu section? ', 'shop-toolkit'),
        'description' => __('You can show or hide header main menu section.', 'shop-toolkit'),
        'section'    => 'shop_toolkit_main_menu',
        'settings'   => 'shop_toolkit_main_menu_show',
        'type'       => 'checkbox',

    ));
    $wp_customize->add_setting('shop_toolkit_menu_logo', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_menu_logo', array(
        'label'      => __('Show Logo in the Main Menu section? ', 'shop-toolkit'),
        'description' => __('You can show logo in the header main menu section.', 'shop-toolkit'),
        'section'    => 'shop_toolkit_main_menu',
        'settings'   => 'shop_toolkit_menu_logo',
        'type'       => 'checkbox',

    ));
    /*
      * menu position 
       */
    $wp_customize->add_setting('shop_toolkit_menu_position', array(
        'default'        => 'center',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_select',
        'transport' => 'refresh',
        //  'priority'       => 20,
    ));
    $wp_customize->add_control('shop_toolkit_menu_position', array(
        'label'      => __('Select Menu Position', 'shop-toolkit'),
        'section'    => 'shop_toolkit_main_menu',
        'settings'   => 'shop_toolkit_menu_position',
        'type'       => 'select',
        'choices'    => array(
            'flex-start' => __('Menu left', 'shop-toolkit'),
            'center' => __('Menu center', 'shop-toolkit'),
            'flex-end' => __('Menu right', 'shop-toolkit'),
        ),
    ));
    $wp_customize->add_setting('shop_toolkit_menu_tbpadding', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',

    ));
    $wp_customize->add_control('shop_toolkit_menu_tbpadding', array(
        'label'      => __('Menu top bottom padding', 'shop-toolkit'),
        'description'     => __('Add main menu top bottom padding.', 'shop-toolkit'),
        'section'    => 'shop_toolkit_main_menu',
        'settings'   => 'shop_toolkit_menu_tbpadding',
        'type'       => 'number',
    ));
    $wp_customize->add_setting('shop_toolkit_menu_fontsize', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',

    ));
    $wp_customize->add_control('shop_toolkit_menu_fontsize', array(
        'label'      => __('Menu item font size', 'shop-toolkit'),
        'description'     => __('Set menu item font size. Font size set by px', 'shop-toolkit'),
        'section'    => 'shop_toolkit_main_menu',
        'settings'   => 'shop_toolkit_menu_fontsize',
        'type'       => 'number',
    ));
    // Add setting
    $wp_customize->add_setting('shop_toolkit_menu_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_menu_color',
            array(
                'label' => __('Menu font Color', 'shop-toolkit'),
                'section' => 'shop_toolkit_main_menu'
            )
        )
    );
    // Add setting
    $wp_customize->add_setting('shop_toolkit_menubg_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_menubg_color',
            array(
                'label' => __('Menu Background Color', 'shop-toolkit'),
                'section' => 'shop_toolkit_main_menu'
            )
        )
    );
    // Add setting
    $wp_customize->add_setting('shop_toolkit_menudropbg_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_menudropbg_color',
            array(
                'label' => __('Menu dropdown Background Color', 'shop-toolkit'),
                'section' => 'shop_toolkit_main_menu'
            )
        )
    );

    //color section custom options    

    // Add setting
    $wp_customize->add_setting('shop_toolkit_titletag_bgcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_titletag_bgcolor',
            array(
                'label' => __('Title tag background Color', 'shop-toolkit'),
                'section' => 'colors'
            )
        )
    );
    $wp_customize->add_setting('shop_toolkit_header_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
        'priority'       => 2,

    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_header_color',
            array(
                'label' => __('Header tag Font Color', 'shop-toolkit'),
                'section' => 'colors'
            )
        )
    );
    $wp_customize->add_setting('shop_toolkit_bodyfont_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_bodyfont_color',
            array(
                'label' => __('Body Font Color', 'shop-toolkit'),
                'section' => 'colors'
            )
        )
    );
    $wp_customize->add_setting('shop_toolkit_contentbg_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_contentbg_color',
            array(
                'label' => __('Content Background Color', 'shop-toolkit'),
                'section' => 'colors'
            )
        )
    );
    $wp_customize->add_setting('shop_toolkit_basic_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_basic_color',
            array(
                'label' => __('Theme Basic Color', 'shop-toolkit'),
                'section' => 'colors'
            )
        )
    );
    //link color
    $wp_customize->add_setting('shop_toolkit_link_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_link_color',
            array(
                'label' => __('Theme Link Color', 'shop-toolkit'),
                'section' => 'colors'
            )
        )
    );
    //link hover color
    $wp_customize->add_setting('shop_toolkit_linkhvr_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_linkhvr_color',
            array(
                'label' => __('Theme Link Hover Color', 'shop-toolkit'),
                'section' => 'colors'
            )
        )
    );
    // Add Shop Toolkit blog section
    $wp_customize->add_section('shop_toolkit_blog', array(
        'title' => __('Shop Toolkit Blog', 'shop-toolkit'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The Shop Toolkit theme blog options ', 'shop-toolkit'),
        'priority'       => 60,

    ));
    $wp_customize->add_setting('shop_toolkit_blog_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_blog_container', array(
        'label'      => __('Container type', 'shop-toolkit'),
        'description' => __('You can set standard container or full width container. ', 'shop-toolkit'),
        'section'    => 'shop_toolkit_blog',
        'settings'   => 'shop_toolkit_blog_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Container', 'shop-toolkit'),
            'container-fluid' => __('Full width Container', 'shop-toolkit'),
        ),
    ));
    $wp_customize->add_setting('shop_toolkit_blog_layout', array(
        'default'        => 'rightside',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_blog_layout', array(
        'label'      => __('Select Blog Layout', 'shop-toolkit'),
        'description' => __('Right and Left sidebar only show when sidebar widget is available. ', 'shop-toolkit'),
        'section'    => 'shop_toolkit_blog',
        'settings'   => 'shop_toolkit_blog_layout',
        'type'       => 'select',
        'choices'    => array(
            'rightside' => __('Right Sidebar', 'shop-toolkit'),
            'leftside' => __('Left Sidebar', 'shop-toolkit'),
            'fullwidth' => __('Full Width', 'shop-toolkit'),
        ),
    ));

    $wp_customize->add_setting('shop_toolkit_blog_style', array(
        'default'        => 'grid',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_blog_style', array(
        'label'      => __('Select Blog Style', 'shop-toolkit'),
        'section'    => 'shop_toolkit_blog',
        'settings'   => 'shop_toolkit_blog_style',
        'type'       => 'select',
        'choices'    => array(
            'grid' => __('Grid Style', 'shop-toolkit'),
            'style1' => __('List over Image', 'shop-toolkit'),
            'style2' => __('List Style', 'shop-toolkit'),
            'style3' => __('Classic Style', 'shop-toolkit'),
        ),
    ));
    $wp_customize->add_setting('shop_toolkit_blog_readmore', array(
        'default' =>  esc_html__('Read More', 'shop-toolkit'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_blog_readmore', array(
        'label'      => __('Posts Read More Text', 'shop-toolkit'),
        'description'     => __('You can change read more text by this settings', 'shop-toolkit'),
        'section'    => 'shop_toolkit_blog',
        'settings'   => 'shop_toolkit_blog_readmore',
        'type'       => 'text',

    ));

    $wp_customize->add_setting('shop_toolkit_blogdate', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_blogdate', array(
        'label'      => __('Show Posts Date? ', 'shop-toolkit'),
        'section'    => 'shop_toolkit_blog',
        'settings'   => 'shop_toolkit_blogdate',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('shop_toolkit_blogauthor', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_blogauthor', array(
        'label'      => __('Show Posts Author? ', 'shop-toolkit'),
        'section'    => 'shop_toolkit_blog',
        'settings'   => 'shop_toolkit_blogauthor',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('shop_toolkit_postcat', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_postcat', array(
        'label'      => __('Show Single Posts Categories? ', 'shop-toolkit'),
        'section'    => 'shop_toolkit_blog',
        'settings'   => 'shop_toolkit_postcat',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('shop_toolkit_posttag', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_posttag', array(
        'label'      => __('Show Single Posts tags? ', 'shop-toolkit'),
        'section'    => 'shop_toolkit_blog',
        'settings'   => 'shop_toolkit_posttag',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('shop_toolkit_post_comment', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_post_comment', array(
        'label'      => __('Show Single Posts comment? ', 'shop-toolkit'),
        'section'    => 'shop_toolkit_blog',
        'settings'   => 'shop_toolkit_post_comment',
        'type'       => 'checkbox',
    ));

    // Add Shop Toolkit page section
    $wp_customize->add_section('shop_toolkit_page', array(
        'title' => __('Shop Toolkit Page', 'shop-toolkit'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The Shop Toolkit theme Page options ', 'shop-toolkit'),
        'priority'       => 70,

    ));
    $wp_customize->add_setting('shop_toolkit_page_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_page_container', array(
        'label'      => __('Page Container type', 'shop-toolkit'),
        'description' => __('You can set standard container or full width container for page. ', 'shop-toolkit'),
        'section'    => 'shop_toolkit_page',
        'settings'   => 'shop_toolkit_page_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Page Container', 'shop-toolkit'),
            'container-fluid' => __('Full width Page Container', 'shop-toolkit'),
        ),
    ));
    $wp_customize->add_setting('shop_toolkit_page_layout', array(
        'default'        => 'rightside',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_page_layout', array(
        'label'      => __('Select Page Layout', 'shop-toolkit'),
        'description' => __('Right and Left sidebar only show when sidebar widget is available. ', 'shop-toolkit'),
        'section'    => 'shop_toolkit_page',
        'settings'   => 'shop_toolkit_page_layout',
        'type'       => 'select',
        'choices'    => array(
            'rightside' => __('Right Sidebar', 'shop-toolkit'),
            'leftside' => __('Left Sidebar', 'shop-toolkit'),
            'fullwidth' => __('Full Width', 'shop-toolkit'),
        ),
    ));




    /*
* Footer setting section
*
*/
    // Add Shop Toolkit top header section
    $wp_customize->add_panel('shop_toolkit_footer_panel', array(
        //  'priority'       => 75,
        'title'          => __('Shop Toolkit footer settings', 'shop-toolkit'),
        'description'    => __('All Shop Toolkit theme footer settings in the panel', 'shop-toolkit'),
    ));
    $wp_customize->add_section('shop_toolkit_footer_top', array(
        'title' => __('Shop Toolkit Footer Top Settings', 'shop-toolkit'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The Shop Toolkit footer settings options ', 'shop-toolkit'),
        'panel'    => 'shop_toolkit_footer_panel',

    ));
    $wp_customize->add_setting('shop_toolkit_topfooter_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_topfooter_show', array(
        'label'      => __('Show Top Footer? ', 'shop-toolkit'),
        'description' => __('You can show or hide footer top section.The section only visible when you will set footer widget. ', 'shop-toolkit'),
        'section'    => 'shop_toolkit_footer_top',
        'settings'   => 'shop_toolkit_topfooter_show',
        'type'       => 'checkbox',

    ));
    //link hover color
    $wp_customize->add_setting('shop_toolkit_topfooter_bgcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_topfooter_bgcolor',
            array(
                'label' => __('Footer top background color.', 'shop-toolkit'),
                'section' => 'shop_toolkit_footer_top'
            )
        )
    );
    //link hover color
    $wp_customize->add_setting('shop_toolkit_tftitle_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_tftitle_color',
            array(
                'label' => __('Footer Top Widget Title Color.', 'shop-toolkit'),
                'section' => 'shop_toolkit_footer_top'
            )
        )
    );
    //link hover color
    $wp_customize->add_setting('shop_toolkit_tftext_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_tftext_color',
            array(
                'label' => __('Footer Top Widget Text Color.', 'shop-toolkit'),
                'section' => 'shop_toolkit_footer_top'
            )
        )
    );
    //link hover color
    $wp_customize->add_setting('shop_toolkit_tflink_hovercolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_tflink_hovercolor',
            array(
                'label' => __('Footer Top Widget Link hover Color.', 'shop-toolkit'),
                'section' => 'shop_toolkit_footer_top'
            )
        )
    );
    // Footer section
    $wp_customize->add_section('shop_toolkit_footer', array(
        'title' => __('Shop Toolkit Footer Settings', 'shop-toolkit'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The Shop Toolkit footer settings options ', 'shop-toolkit'),
        'panel'    => 'shop_toolkit_footer_panel',

    ));

    $wp_customize->add_setting('shop_toolkit_footer_bgcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_footer_bgcolor',
            array(
                'label' => __('Footer background color.', 'shop-toolkit'),
                'section' => 'shop_toolkit_footer'
            )
        )
    );
    $wp_customize->add_setting('shop_toolkit_footer_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_footer_color',
            array(
                'label' => __('Footer text color.', 'shop-toolkit'),
                'section' => 'shop_toolkit_footer'
            )
        )
    );
    $wp_customize->add_setting('shop_toolkit_footerlink_hcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'shop_toolkit_footerlink_hcolor',
            array(
                'label' => __('Footer Link Hover color.', 'shop-toolkit'),
                'section' => 'shop_toolkit_footer'
            )
        )
    );




    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'shop_toolkit_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'shop_toolkit_customize_partial_blogdescription',
            )
        );
    }
}
add_action('customize_register', 'shop_toolkit_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function shop_toolkit_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function shop_toolkit_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function shop_toolkit_customize_preview_js()
{
    wp_enqueue_script('shop-toolkit-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'shop_toolkit_customize_preview_js');
