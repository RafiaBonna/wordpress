<?php

/**
 * shop Toolkit Plus Theme Customizer
 *
 * @package shop Toolkit Plus
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function shop_toolkit_plus_customize_register($wp_customize)
{

    $wp_customize->remove_control('shop_toolkit_blog_style');
    $wp_customize->remove_control('shop_toolkit_theme_fonts_control');
    $wp_customize->remove_control('shop_toolkit_font_size_control');
    $wp_customize->remove_control('shop_toolkit_font_line_height_control');
    $wp_customize->remove_control('shop_toolkit_theme_font_head_control');
    $wp_customize->remove_control('shop_toolkit_font_weight_head_control');

   

    // Body Font Family Setting
    $wp_customize->add_setting('shop_toolkit_plus_body_font_family', array(
        'default'        => 'Fira Sans',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('shop_toolkit_plus_body_font_family', array(
        'label'      => __('Body Font Family', 'shop-toolkit-plus'),
        'section'    => 'shop_toolkit_typography',
        'settings'   => 'shop_toolkit_plus_body_font_family',
        'type'       => 'select',
        'description' => __('Choose the font family for body text.', 'shop-toolkit-plus'),
        'choices'    => array(
            'Fira Sans' => __('Fira Sans (Default)', 'shop-toolkit-plus'),
            'Platypi' => __('Platypi', 'shop-toolkit-plus'),
            'Arial' => __('Arial', 'shop-toolkit-plus'),
            'Helvetica' => __('Helvetica', 'shop-toolkit-plus'),
            'Georgia' => __('Georgia', 'shop-toolkit-plus'),
            'Times New Roman' => __('Times New Roman', 'shop-toolkit-plus'),
        ),
    ));

    // Body Font Size Setting
    $wp_customize->add_setting('shop_toolkit_plus_body_font_size', array(
        'default'        => '16',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('shop_toolkit_plus_body_font_size', array(
        'label'      => __('Body Font Size (px)', 'shop-toolkit-plus'),
        'section'    => 'shop_toolkit_typography',
        'settings'   => 'shop_toolkit_plus_body_font_size',
        'type'       => 'number',
        'description' => __('Set the font size for body text in pixels.', 'shop-toolkit-plus'),
        'input_attrs' => array(
            'min' => 12,
            'max' => 24,
            'step' => 1,
        ),
    ));
     $wp_customize->add_setting('shop_toolkit_plus_font_line_height', array(
        'default' =>  '24',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_plus_font_line_height', array(
        'label'      => __('Body font line height', 'shop-toolkit-plus'),
        'description'     => __('Default body line height is 24px', 'shop-toolkit-plus'),
        'section'    => 'shop_toolkit_typography',
        'settings'   => 'shop_toolkit_plus_font_line_height',
        'type'       => 'text',

    ));
    $wp_customize->add_setting('shop_toolkit_plus_theme_font_head', array(
        'default'       => 'Platypi',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_theme_head_font',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_plus_theme_font_head', array(
        'label'      => __('Select theme header Font', 'shop-toolkit-plus'),
        'section'    => 'shop_toolkit_typography',
        'settings'   => 'shop_toolkit_plus_theme_font_head',
        'type'       => 'select',
        'choices'    => array(
            'Platypi' => __('Platypi', 'shop-toolkit-plus'),
            'Noto Serif' => __('Noto Serif', 'shop-toolkit-plus'),
            'Roboto' => __('Roboto', 'shop-toolkit-plus'),
            'Open Sans' => __('Open Sans', 'shop-toolkit-plus'),
            'Lato' => __('Lato', 'shop-toolkit-plus'),
        ),
    ));
    $wp_customize->add_setting('shop_toolkit_plus_font_weight_head', array(
        'default'       => '700',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_plus_font_weight_head', array(
        'label'      => __('Site header font weight', 'shop-toolkit-plus'),
        'section'    => 'shop_toolkit_typography',
        'settings'   => 'shop_toolkit_plus_font_weight_head',
        'type'       => 'select',
        'choices'    => array(
            '400' => __('Normal', 'shop-toolkit-plus'),
            '500' => __('Semi Bold', 'shop-toolkit-plus'),
            '700' => __('Bold', 'shop-toolkit-plus'),
            '900' => __('Extra Bold', 'shop-toolkit-plus'),
        ),
    ));


    $wp_customize->add_setting('shop_toolkit_plus_blog_style', array(
        'default'        => 'grid',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'shop_toolkit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('shop_toolkit_plus_blog_style', array(
        'label'      => __('Select Blog Style', 'shop-toolkit-plus'),
        'section'    => 'shop_toolkit_blog',
        'settings'   => 'shop_toolkit_plus_blog_style',
        'type'       => 'select',
        'choices'    => array(
            'grid' => __('Grid Style', 'shop-toolkit-plus'),
            'style1' => __('List over Image', 'shop-toolkit-plus'),
            'style2' => __('List Style', 'shop-toolkit-plus'),
            'style3' => __('Classic Style', 'shop-toolkit-plus'),
        ),
    ));

    
}
add_action('customize_register', 'shop_toolkit_plus_customize_register', 99);
