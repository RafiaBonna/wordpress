<?php

/**
 * Add inline css 
 *
 * 
 */
if (!function_exists('shop_toolkit_wooinline_css')) :
    function shop_toolkit_wooinline_css()
    {

        $style = '';


        $shop_toolkit_resultcount = get_theme_mod('shop_toolkit_resultcount', 1);
        if (empty($shop_toolkit_resultcount)) {
            $style .= 'p.woocommerce-result-count{display:none !important;}';
        }
        $shop_toolkit_porder = get_theme_mod('shop_toolkit_porder', 1);
        if (empty($shop_toolkit_porder)) {
            $style .= '.woocommerce .woocommerce-ordering{display:none !important;}';
        }

        $shop_toolkit_title_position = get_theme_mod('shop_toolkit_title_position', 'center');
        if ($shop_toolkit_title_position != 'left') {
            $style .= '.woocommerce .page-title,.woocommerce .term-description{text-align:' . $shop_toolkit_title_position . ' !important;}';
        }
        $shop_toolkit_titlecolor = get_theme_mod('shop_toolkit_titlecolor');
        if ($shop_toolkit_titlecolor) {
            $style .= '.woocommerce .page-title{color:' . $shop_toolkit_titlecolor . ' !important;}';
        }
        $shop_toolkit_product_bgcolor = get_theme_mod('shop_toolkit_product_bgcolor');
        if ($shop_toolkit_product_bgcolor) {
            $style .= '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{background:' . $shop_toolkit_product_bgcolor . ' !important;}';
        }
        $shop_toolkit_ptitle_color = get_theme_mod('shop_toolkit_ptitle_color');
        if ($shop_toolkit_ptitle_color) {
            $style .= '.woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce ul.products li.product h3{color:' . $shop_toolkit_ptitle_color . ' !important;}';
        }
        $shop_toolkit_prating_color = get_theme_mod('shop_toolkit_prating_color');
        if ($shop_toolkit_prating_color) {
            $style .= '.woocommerce .star-rating span:before{color:' . $shop_toolkit_prating_color . ' !important;}';
        }
        $shop_toolkit_pprice_color = get_theme_mod('shop_toolkit_pprice_color');
        if ($shop_toolkit_pprice_color) {
            $style .= '.woocommerce ul.products li.product .price{color:' . $shop_toolkit_pprice_color . ' !important;}';
        }
        $shop_toolkit_pbtn_bgcolor = get_theme_mod('shop_toolkit_pbtn_bgcolor');
        $shop_toolkit_pbtn_color = get_theme_mod('shop_toolkit_pbtn_color');
        if ($shop_toolkit_pbtn_bgcolor || $shop_toolkit_pbtn_color) {
            $style .= '.woocommerce a.button, .woocommerce a.added_to_cart, .woocommerce button.button,.woocommerce span.onsale{background:' . $shop_toolkit_pbtn_bgcolor . ' !important;color:' . $shop_toolkit_pbtn_color . ' !important}';
        }
        $shop_toolkit_pbtn_hvbgcolor = get_theme_mod('shop_toolkit_pbtn_hvbgcolor');
        $shop_toolkit_pbtn_hvcolor = get_theme_mod('shop_toolkit_pbtn_hvcolor');
        if ($shop_toolkit_pbtn_hvbgcolor) {
            $style .= '.woocommerce a.button:hover, .woocommerce a.added_to_cart:hover, .woocommerce button.button:hover, .woocommerce input.button:hover a.added_to_cart.wc-forward{background:' . $shop_toolkit_pbtn_hvbgcolor . ' !important;color:' . $shop_toolkit_pbtn_hvcolor . ' !important}';
        }
        $shop_toolkit_shopb_img = get_theme_mod('shop_toolkit_shopb_img');

        if ($shop_toolkit_shopb_img) {
            $shop_toolkit_shopb_img_url = wp_get_attachment_image_src($shop_toolkit_shopb_img, 'full');
            if ($shop_toolkit_shopb_img_url) {
                $style .= '.shop-toolkit-banner.bg-overlay{background:url(' . $shop_toolkit_shopb_img_url[0] . ')}';
            }
        }
        $shop_toolkit_bannertext_color = get_theme_mod('shop_toolkit_bannertext_color', '#fff');
        if ($shop_toolkit_bannertext_color != '#fff') {
            $style .= '.shop-toolkit-banner .bbanner-text h1,.shop-toolkit-banner .bbanner-text h4,.shop-toolkit-banner .bbanner-text p{color:' . $shop_toolkit_bannertext_color . ' !important}';
        }
        $shop_toolkit_bannerbtn_color = get_theme_mod('shop_toolkit_bannerbtn_color', '#fff');
        if ($shop_toolkit_bannerbtn_color != '#fff') {
            $style .= 'a.btn.xskit-btn{color:' . $shop_toolkit_bannerbtn_color . ' !important}';
        }
        $shop_toolkit_bannerbtn_bgcolor = get_theme_mod('shop_toolkit_bannerbtn_bgcolor', '#ee434e');
        if ($shop_toolkit_bannerbtn_bgcolor != '#ee434e') {
            $style .= 'a.btn.xskit-btn{background:' . $shop_toolkit_bannerbtn_bgcolor . ' !important}';
        }
        $shop_toolkit_products_pagination = get_theme_mod('shop_toolkit_products_pagination', 'center');
        if ($shop_toolkit_products_pagination != 'center') {
            $style .= '.woocommerce nav.woocommerce-pagination{text-align:' . $shop_toolkit_products_pagination . '}';
        }
        $shop_toolkit_ftwidget_color = get_theme_mod('shop_toolkit_ftwidget_color');
        if ($shop_toolkit_ftwidget_color) {
            $style .= '.shop-toolkit-products-filter ul li, .shop-toolkit-products-filter ul li a{color:' . $shop_toolkit_ftwidget_color . '}';
        }
        $shop_toolkit_ftwidget_bgcolor = get_theme_mod('shop_toolkit_ftwidget_bgcolor');
        if ($shop_toolkit_ftwidget_bgcolor) {
            $style .= '.shop-toolkit-products-filter ul{background:' . $shop_toolkit_ftwidget_bgcolor . ' !important}';
        }
        $shop_toolkit_ftwidget_hvcolor = get_theme_mod('shop_toolkit_ftwidget_hvcolor');
        if ($shop_toolkit_ftwidget_hvcolor) {
            $style .= '.shop-toolkit-products-filter ul li a:hover{color:' . $shop_toolkit_ftwidget_hvcolor . '}';
        }
        $shop_toolkit_breadcrump_color = get_theme_mod('shop_toolkit_breadcrump_color');
        $shop_toolkit_breadcrump_bgcolor = get_theme_mod('shop_toolkit_breadcrump_bgcolor');
        if ($shop_toolkit_breadcrump_color) {
            $style .= '.woocommerce .woocommerce-breadcrumb, .woocommerce .woocommerce-breadcrumb a{color:' . $shop_toolkit_breadcrump_color . ' !important}';
        }
        if ($shop_toolkit_breadcrump_bgcolor) {
            $style .= '.shop-toolkit-wbreadcrump{background:' . $shop_toolkit_breadcrump_bgcolor . ' !important}';
        }
        $shop_toolkit_pagitext_color = get_theme_mod('shop_toolkit_pagitext_color');
        $shop_toolkit_pagibg_color = get_theme_mod('shop_toolkit_pagibg_color');
        if ($shop_toolkit_pagitext_color || $shop_toolkit_pagibg_color) {
            $style .= '.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current{color:' . $shop_toolkit_pagibg_color . ' !important;background:' . $shop_toolkit_pagitext_color . ' !important}';
            $style .= '.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span{background:' . $shop_toolkit_pagibg_color . ' !important;color:' . $shop_toolkit_pagitext_color . ' !important}';
        }
        /*Single page style*/
        $shop_toolkit_sptitle_color = get_theme_mod('shop_toolkit_sptitle_color');
        if ($shop_toolkit_sptitle_color) {
            $style .= '.single-product .product_title{color:' . $shop_toolkit_sptitle_color . ' !important}';
        }
        $shop_toolkit_ptitle_fsize = get_theme_mod('shop_toolkit_ptitle_fsize');
        if ($shop_toolkit_ptitle_fsize) {
            $style .= '.single-product .product_title{font-size:' . $shop_toolkit_ptitle_fsize . 'px !important}';
        }
        $shop_toolkit_srating_show = get_theme_mod('shop_toolkit_srating_show', '1');
        if (empty($shop_toolkit_srating_show)) {
            $style .= '.single-product .woocommerce-product-rating{display:none}';
        }
        $shop_toolkit_sdesc_show = get_theme_mod('shop_toolkit_sdesc_show', '1');
        if (empty($shop_toolkit_sdesc_show)) {
            $style .= '.single-product .woocommerce-product-details__short-description{display:none}';
        }
        $shop_toolkit_sku_show = get_theme_mod('shop_toolkit_sku_show', '1');
        if (empty($shop_toolkit_sku_show)) {
            $style .= '.single-product .sku_wrapper{display:none}';
        }
        $shop_toolkit_spcat_show = get_theme_mod('shop_toolkit_spcat_show', '1');
        if (empty($shop_toolkit_spcat_show)) {
            $style .= '.single-product .posted_in{display:none}';
        }
        $shop_toolkit_sptag_show = get_theme_mod('shop_toolkit_sptag_show', '1');
        if (empty($shop_toolkit_sptag_show)) {
            $style .= '.single-product .tagged_as{display:none}';
        }
        $shop_toolkit_sptab_show = get_theme_mod('shop_toolkit_sptab_show', '1');
        if (empty($shop_toolkit_sptab_show)) {
            $style .= '.single-product .woocommerce-tabs{display:none}';
        }
        $shop_toolkit_sprelated_show = get_theme_mod('shop_toolkit_sprelated_show', '1');
        if (empty($shop_toolkit_sprelated_show)) {
            $style .= '.single-product .related.products{display:none}';
        }





        wp_add_inline_style('shop-toolkit-main', $style);
    }
    add_action('wp_enqueue_scripts', 'shop_toolkit_wooinline_css');
endif;
