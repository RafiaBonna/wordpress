<?php $jewellery_boutique_slider_arrows = get_theme_mod('jewellery_boutique_slider_arrows', false);

if ($jewellery_boutique_slider_arrows) : ?>
    <section id="banner">
        <div class="container">
            <?php
            $jewellery_boutique_slide_pages = array();
            $jewellery_boutique_mod = absint(get_theme_mod('jewellery_boutique_slider_page',get_page_id_by_slug('slider-page')));
            if ($jewellery_boutique_mod !== 0) {
                $jewellery_boutique_slide_pages[] = $jewellery_boutique_mod;
            }

            if (!empty($jewellery_boutique_slide_pages)) :
                $jewellery_boutique_args = array(
                    'post_type'      => 'page',
                    'post__in'       => $jewellery_boutique_slide_pages,
                    'orderby'        => 'post__in',
                    'posts_per_page' => -1,
                );
                $jewellery_boutique_query = new WP_Query($jewellery_boutique_args);

                if ($jewellery_boutique_query->have_posts()) :
                    while ($jewellery_boutique_query->have_posts()) : $jewellery_boutique_query->the_post(); ?>
                        <div class="item">
                            <div class="row">
                                <div class="col-lg-7 col-md-7 col-12 slider-content-col">
                                    <div class="inner_carousel pe-lg-5">
                                        <h1 class="mt-md-2 mb-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h1>
                                        <?php
                                        $jewellery_boutique_slider_short_heading = get_theme_mod('jewellery_boutique_slider_short_heading', '');
                                        if (!empty($jewellery_boutique_slider_short_heading)) : ?>
                                            <p class="slidetop-text mb-md-3 mt-md-0 mb-2">
                                                <?php echo esc_html($jewellery_boutique_slider_short_heading); ?>
                                            </p>
                                        <?php endif; ?>
                                        <p class="slide-content"><?php echo esc_html(wp_trim_words(get_the_content(), 45)); ?></p>
                                        <div class="more-btn my-md-4 mt-3 mb-4">
                                            <a class="btn-1" href="<?php the_permalink(); ?>">
                                                <?php esc_html_e('Shop Collection', 'jewellery-boutique'); ?>
                                            </a>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-4 banner-1 mb-md-0 mb-3">
                                                <?php if ($jewellery_boutique_banner_img1 = get_theme_mod('jewellery_boutique_banner_slider_first')) : ?>
                                                    <img src="<?php echo esc_url($jewellery_boutique_banner_img1); ?>" alt="<?php esc_attr_e('Banner Image 1', 'jewellery-boutique'); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-4 banner-2 mb-md-0 mb-3">
                                                <?php if ($jewellery_boutique_banner_img2 = get_theme_mod('jewellery_boutique_banner_slider_sec')) : ?>
                                                    <img src="<?php echo esc_url($jewellery_boutique_banner_img2); ?>" alt="<?php esc_attr_e('Banner Image 2', 'jewellery-boutique'); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-4 banner-3 mb-md-0 mb-3">
                                                <?php if ($jewellery_boutique_banner_img3 = get_theme_mod('jewellery_boutique_banner_slider_third')) : ?>
                                                    <img src="<?php echo esc_url($jewellery_boutique_banner_img3); ?>" alt="<?php esc_attr_e('Banner Image 3', 'jewellery-boutique'); ?>" />
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5 col-md-5 col-12 slider-img-col p-md-0">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('full', array('alt' => esc_attr(get_the_title()))); ?>
                                    <?php else : ?>
                                        <div class="banner-color"></div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                endif; ?>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
