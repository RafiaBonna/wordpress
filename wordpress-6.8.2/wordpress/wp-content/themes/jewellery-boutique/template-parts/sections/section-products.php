<?php // Get setting to determine whether to display the section
$jewellery_boutique_product_sec = get_theme_mod('jewellery_boutique_our_products_show_hide_section', true);

if ($jewellery_boutique_product_sec == '1') : ?>
<section id="product-section" class="my-5 mx-md-0 mx-3">
  <div class="container">
    <div class="product-main-head">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-12 text-md-start align-self-center">
          <?php if (get_theme_mod('jewellery_boutique_product_short_heading')) : ?>
            <p class="product-top-text mb-3"><?php echo esc_html(get_theme_mod('jewellery_boutique_product_short_heading')); ?></p>
          <?php endif; ?>

          <?php $jewellery_boutique_our_products_heading_section = get_theme_mod('jewellery_boutique_our_products_heading_section');
          if (!empty($jewellery_boutique_our_products_heading_section)) : ?>
              <h2 class="product-heading mb-3">
                  <?php echo esc_html($jewellery_boutique_our_products_heading_section); ?>
              </h2>
          <?php endif; ?>
        </div>
        <div class="col-lg-6 col-md-6 col-12 align-self-center text-md-end text-start mb-3">
          <?php
          // "View All" button
          $jewellery_boutique_product_btn_text = get_theme_mod( 'jewellery_boutique_product_section_btn_text1', __( 'View All', 'jewellery-boutique' ) );
          $jewellery_boutique_product_btn_link = get_theme_mod( 'jewellery_boutique_product_section_btn_link1' );

          if ( ! empty( $jewellery_boutique_product_btn_text ) && ! empty( $jewellery_boutique_product_btn_link ) ) : ?>
            <a class="viewall-btn mb-3" href="<?php echo esc_url( $jewellery_boutique_product_btn_link ); ?>">
              <?php echo esc_html( $jewellery_boutique_product_btn_text ); ?>
              <span class="screen-reader-text"><?php echo esc_html( $jewellery_boutique_product_btn_text ); ?></span>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php if (class_exists('WooCommerce')) : ?>
  <div class="owl-carousel jewellery-products-carousel">
    <?php
    $jewellery_boutique_selected_category = get_theme_mod('jewellery_boutique_our_product_product_category','product_cat1');

    if (!empty($jewellery_boutique_selected_category)) {
      $jewellery_boutique_args = array(
        'post_type'      => 'product',
        'posts_per_page' => 50,
        'product_cat'    => $jewellery_boutique_selected_category,
        'order'          => 'ASC'
      );

      $jewellery_boutique_loop = new WP_Query($jewellery_boutique_args);

      while ($jewellery_boutique_loop->have_posts()) : $jewellery_boutique_loop->the_post();
        global $product;
    ?>
        <div class="item">
          <div class="product-box p-1">
            <div class="product-image">
              <?php echo woocommerce_get_product_thumbnail(); ?>
              <div class="bottom-icons">
                <div class="wishlistbox mb-1">
                  <a href="<?php echo esc_url(wc_get_page_permalink('wishlist')); ?>" class="wishlist-button">
                    <i class="fas fa-heart"></i>
                  </a>
                </div>
                <div class="cart-button">
                  <?php if ($product->is_type('simple')) {
                    woocommerce_template_loop_add_to_cart();
                  } ?>
                </div>
              </div>
            </div>
            <div class="product-content text-start py-3">
              <h3 class="my-1">
                <a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a>
              </h3>
              <p class="my-2 product-price">
                <?php
                echo '<span class="product-price">' . wp_kses_post($product->get_price_html()) . '</span>';
                echo ' <span class="tax-inclusion">' . esc_html__('(Inclusive Of All Taxes)', 'jewellery-boutique') . '</span>';
                ?>
              </p>
              <div class="product-rating mt-2">
                <?php if ($product->is_type('simple')) : ?>
                  <?php woocommerce_template_loop_rating(); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
    <?php
      endwhile;
      wp_reset_postdata();
    }
    ?>
  </div>
<?php endif; ?>

  </div>
</section>
<?php endif; ?>