<?php

/**
 * Template Name: Front Page
 */
get_header();


$shop_toolkit_blog_container = get_theme_mod('shop_toolkit_blog_container', 'container');
$shop_toolkit_blog_layout = get_theme_mod('shop_toolkit_blog_layout', 'rightside');
$shop_toolkit_shopbanner_show = get_theme_mod('shop_toolkit_shopbanner_show');
$shop_toolkit_banner_subtext = get_theme_mod('shop_toolkit_banner_subtext');
$shop_toolkit_banner_title = get_theme_mod('shop_toolkit_banner_title');
$shop_toolkit_banner_desc = get_theme_mod('shop_toolkit_banner_desc');
$shop_toolkit_banner_btn = get_theme_mod('shop_toolkit_banner_btn', esc_html__('Shop Now', 'shop-toolkit'));
$shop_toolkit_banner_url = get_theme_mod('shop_toolkit_banner_url', '#');
$shop_toolkit_text_position = get_theme_mod('shop_toolkit_text_position', 'left');
$shop_toolkit_banner_overlay = get_theme_mod('shop_toolkit_banner_overlay');
$shop_toolkit_blog_style = get_theme_mod('shop_toolkit_blog_style', 'grid');


if (is_active_sidebar('sidebar-1') && $shop_toolkit_blog_layout != 'fullwidth') {
    $shop_toolkit_column_set = '9';
} else {
    $shop_toolkit_column_set = '12';
}

?>
<?php if ($shop_toolkit_shopbanner_show) : ?>
    <div class="shop-toolkit-banner bg-overlay mb-5">
        <div class="container">
            <div class="bbanner-text text-<?php echo esc_attr($shop_toolkit_text_position); ?>">
                <h4><?php echo esc_html($shop_toolkit_banner_subtext); ?></h4>
                <h1><?php echo esc_html($shop_toolkit_banner_title); ?></h1>
                <?php echo apply_filters('the_content', $shop_toolkit_banner_desc); ?>
                <?php if ($shop_toolkit_banner_url) : ?>
                    <div class="bsbanner-btn">
                        <a href="<?php echo esc_url($shop_toolkit_banner_url); ?>" class="btn xskit-btn"><?php echo esc_html($shop_toolkit_banner_btn); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($shop_toolkit_banner_overlay) : ?>
            <div class="overlay-banner"></div>
        <?php endif; ?>
    </div>
<?php endif; ?>
<div class="<?php echo esc_attr($shop_toolkit_blog_container); ?> <?php if ($shop_toolkit_shopbanner_show) : ?>mb-5 pb-3<?php else : ?>mt-3 mb-5 pt-5 pb-3<?php endif; ?>">
    <?php
    if (shop_toolkit_is_woocommerce_activated() && shop_toolkit_has_woocommerce_products()) :
    ?>
        <main id="primary" class="site-main">
            <?php get_template_part('template-parts/content', 'fshop'); ?>
        </main>
    <?php else : ?>
        <div class="row">
            <?php if (is_active_sidebar('sidebar-1') && $shop_toolkit_blog_layout == 'leftside') : ?>
                <div class="col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php endif; ?>
            <div class="col-lg-<?php echo esc_attr($shop_toolkit_column_set); ?>">
                <main id="primary" class="site-main">
                    <?php
                    if ($shop_toolkit_blog_style == 'grid') :
                    ?>
                        <div class="row" data-masonry='{"percentPosition": true }'>
                            <?php
                        endif;

                        if (have_posts()) :
                            /* Start the Loop */
                            while (have_posts()) :
                                the_post();
                                get_template_part('template-parts/content', get_post_type());


                            endwhile;
                            if ($shop_toolkit_blog_style == 'grid') :
                            ?>
                        </div>
                <?php
                            endif;
                            the_posts_pagination();

                        else :

                            get_template_part('template-parts/content', 'none');

                        endif;
                ?>

                </main><!-- #main -->
            </div>
            <?php if (is_active_sidebar('sidebar-1') && $shop_toolkit_blog_layout == 'rightside') : ?>
                <div class="col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php endif; ?>
        </div> <!-- end row -->
    <?php endif; ?>
</div> <!-- end container -->

<?php
get_footer();
