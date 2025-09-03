<?php
/**
 * Related posts based on categories and tags.
 * 
 */

$jewellery_boutique_related_post_counts = get_theme_mod( 'jewellery_boutique_related_post_counts', 3 );

$jewellery_boutique_post_args = array(
    'posts_per_page'    => $jewellery_boutique_related_post_counts,
    'orderby'           => 'rand',
    'post__not_in'      => array( get_the_ID() ),
    'ignore_sticky_posts' => 1,
);

$jewellery_boutique_tax_terms = wp_get_post_terms( get_the_ID(), 'category' );
$jewellery_boutique_terms_ids = array();

foreach( $jewellery_boutique_tax_terms as $tax_term ) {
	$jewellery_boutique_terms_ids[] = $tax_term->term_id;
}

$jewellery_boutique_post_args['tag__in'] = wp_get_post_tags( get_the_ID(), array('fields' => 'ids') ); 

if ( !empty($jewellery_boutique_terms_ids) ) {
    $jewellery_boutique_post_args['category__in'] = $jewellery_boutique_terms_ids;
}

$jewellery_boutique_related_posts = new WP_Query( $jewellery_boutique_post_args );
?>

<?php if ( $jewellery_boutique_related_posts->have_posts() ) : ?>
    <div class="related-post">
        <h3><?php echo esc_html(get_theme_mod('jewellery_boutique_related_posts_heading', 'Related Posts')); ?></h3>
        <div class="row">
            <?php while ( $jewellery_boutique_related_posts->have_posts() ) : $jewellery_boutique_related_posts->the_post(); ?>
              <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                <div class="blog-item inner-related-post">
                  <?php  
                    the_title(sprintf('<h5 class="post-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h5>');
                  ?>
                  <?php
                    $jewellery_boutique_excerpt_limit = 20;
                    echo "<p>" . wp_trim_words(get_the_excerpt(), $jewellery_boutique_excerpt_limit) . "</p>";
                  ?>
                  <ul class="comment-timing">
                    <li><a href="javascript:void(0);"><i class="fa fa-comment"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></a></li>
                    <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><i class="fa fa-user"></i><?php esc_html_e('By', 'jewellery-boutique'); ?> <?php the_author(); ?></a></li>
                    <li><a href="javascript:void(0);"><i class="fas fa-clock pe-1"></i> <?php echo esc_html( get_the_time( 'F j, Y' ) ); ?> <?php echo esc_html( get_the_time( 'H:i A' ) ); ?></a></li>
                  </ul>
                </div>
              </div>
            <?php endwhile; ?>
        </div>
    </div>
  <?php else : ?>
    <p class="related-post"><?php echo esc_html__('Sorry, no related posts found.', 'jewellery-boutique'); ?></p>
<?php endif;

wp_reset_postdata();
?>