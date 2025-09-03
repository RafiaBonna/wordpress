<header class="main-header">
    <div class="head-img">
        <div class="headerbox">
            <div class="header-main container">
                <div class="row" style="align-items: center;">
                    <div class="col-lg-2 col-md-3">
                        <div class="logo text-md-start text-center">
                            <?php 
                            if (has_custom_logo()) {
                                the_custom_logo();
                            } else {
                                // Check if both title and tagline settings are disabled
                                $jewellery_boutique_tagline_enabled = get_theme_mod('jewellery_boutique_tagline_setting', false);
                                $jewellery_boutique_title_enabled = get_theme_mod('jewellery_boutique_site_title_setting', false);

                                if (!$jewellery_boutique_tagline_enabled && !$jewellery_boutique_title_enabled) {
                                    // Display the default logo
                                    $jewellery_boutique_default_logo_url = get_template_directory_uri() . '/assets/images/logo.png'; // Replace with your default logo path
                                    echo '<a href="' . esc_url(home_url('/')) . '">';
                                    echo '<img src="' . esc_url($jewellery_boutique_default_logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                                    echo '</a>';
                                }

                                // Display tagline if the setting is enabled
                                if ($jewellery_boutique_tagline_enabled) :
                                    $jewellery_boutique_site_desc = get_bloginfo('description'); ?>
                                    <p class="site-description"><?php echo esc_html($jewellery_boutique_site_desc); ?></p>
                                <?php endif; ?>

                                <?php
                                // Display site title if the setting is enabled
                                if ($jewellery_boutique_title_enabled) : ?>
                                    <p class="site-title">
                                        <a href="<?php echo esc_url(home_url('/')); ?>">
                                            <?php echo esc_html(get_bloginfo('name')); ?>
                                        </a>
                                    </p>
                                <?php endif; ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 align-self-center ps-lg-0">
                        <?php 
                        $jewellery_boutique_call = get_theme_mod('jewellery_boutique_call');
                        if ($jewellery_boutique_call) : ?>
                            <div class="contact-col call my-md-0 my-3">
                                <p class="mb-0 contact-content call text-center">
                                    <a href="tel:<?php echo esc_attr($jewellery_boutique_call); ?>"><i class="fas fa-phone"></i>
                                        <span class="ps-1"><?php echo esc_html($jewellery_boutique_call); ?></span>
                                    </a>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-3 align-self-center mb-md-0 mb-3">
                        <div class="main-navhead">
                            <div class="menubox">
                                <div class="menu-content">
                                    <!-- Main menu -->
                                    <div class="navbar-menubar responsive-menu navigation_header">
                                        <div class="toggle-nav mobile-menu">
                                            <button onclick="jewellery_boutique_openNav()">
                                                <i class="fa-solid fa-bars"></i> <!-- Initial hamburger icon -->
                                            </button>
                                        </div>
                                        <div id="mySidenav" class="nav sidenav">
                                            <nav id="site-navigation" class="main-navigation navbar navbar-expand-xl" aria-label="<?php esc_attr_e( 'Top Menu', 'jewellery-boutique' ); ?>">
                                                <?php 
                                                    wp_nav_menu(
                                                        array(
                                                            'theme_location' => 'primary',
                                                            'container_class' => 'main-menu clearfix',
                                                            'menu_class' => 'clearfix menu',
                                                            'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                                                            'fallback_cb' => 'wp_page_menu',
                                                        )
                                                    );
                                                ?>
                                                <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="jewellery_boutique_closeNav()">
                                                    <i class="fa-solid fa-times"></i> <!-- Close icon for the menu -->
                                                </a>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Header Details Section -->
                    <div class="col-xl-1 col-lg-2 col-md-3 align-self-center mb-md-0 mb-3">
                        <div class="header-details">
                            <!-- Search Bar -->
                            <span class="search-bar me-3">
                                <button type="button" class="open-search" aria-label="<?php esc_attr_e('Open Search', 'jewellery-boutique'); ?>">
                                    <i class="fas fa-search"></i>
                                </button>
                            </span>

                            <p class="mb-0">
                                <?php if (class_exists('WooCommerce')): ?> 
                                    <span class="product-cart text-center position-relative pe-2">
                                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('Shopping cart', 'jewellery-boutique'); ?>">
                                            <i class="fas fa-shopping-cart me-3" aria-hidden="true"></i>
                                        </a>
                                        <?php 
                                        $jewellery_boutique_cart_count = WC()->cart->get_cart_contents_count(); 
                                        if ($jewellery_boutique_cart_count > 0): ?>
                                            <span class="cart-count"><?php echo esc_html($jewellery_boutique_cart_count); ?></span>
                                        <?php endif; ?>
                                    </span>
                                <?php endif; ?>
                            </p>
                            <?php 
                            $jewellery_boutique_like_option = get_theme_mod('jewellery_boutique_like_option');
                            if ($jewellery_boutique_like_option): ?>
                                <p class="mb-0">
                                    <a href="<?php echo esc_url($jewellery_boutique_like_option); ?>">
                                        <i class="far fa-heart me-3" aria-hidden="true"></i>
                                    </a>
                                </p>
                            <?php endif; ?>

                            <p class="mb-0">
                                <?php if (class_exists('YITH_WCWL')): ?>
                                    <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>">
                                        <i class="fas fa-heart me-3" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                            </p>

                            <p class="mb-0">
                                <?php if (class_exists('WooCommerce')): ?>
                                    <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
                                        <i class="<?php echo esc_attr(is_user_logged_in() ? 'fas' : 'far'); ?> fa-user" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                            </p>

                        </div>
                    </div>

                    <!-- Search Overlay -->
                    <div class="search-outer">
                        <div class="inner_searchbox w-100 h-100">
                            <?php get_search_form(); ?>
                        </div>
                        <button type="button" class="search-close"><?php esc_html_e('CLOSE', 'jewellery-boutique'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <div class="clearfix"></div>
</header>