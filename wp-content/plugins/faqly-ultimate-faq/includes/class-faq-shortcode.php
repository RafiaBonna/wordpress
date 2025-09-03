<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class FAQLY_Shortcode {

    public function __construct() {
        add_shortcode( 'faqly_accordion', [ $this, 'faqly_render_faqly_accordion' ] );
    }

    public function faqly_render_faqly_accordion( $atts ) {
        // Parse shortcode attributes
        $atts = shortcode_atts( [
            'id' => 0,
        ], $atts, 'faqly_accordion' );
    
        $post_id = intval( $atts['id'] );
    
        if ( ! $post_id ) {
            return '<p>Error: No FAQ group specified.</p>';
        }

        $accordion_event = get_post_meta( $post_id, '_accordion_event', true ) ?: '.click';

        wp_enqueue_script( 'faqly-accordion-script1', plugin_dir_url( __FILE__ ) . '../assets/faq-accordion-front.js', [ 'jquery' ], FAQLY_PLUGIN_VERSION, true );
        wp_localize_script( 'faqly-accordion-script1', 'FAQAccordionSettings', [
            'accordionEvent' => $accordion_event,
            'accordionMode'  => get_post_meta( $post_id, '_accordion_mode', true ) ?: '.first_open',
        ]);

        


        // css settings
        $faq_title_font_size = get_post_meta( $post_id, '_faq_title_font_size', true ) ?: '25px';
        $faq_desc_font_size = get_post_meta( $post_id, '_faq_desc_font_size', true ) ?: '18px';
        $faq_border_radius = get_post_meta( $post_id, '_faq_border_radius', true ) ?: '5px'; 
        //end 

        $faq_search      = get_post_meta( $post_id, '_faq_search', true ) === 'enable';
        // Get meta values
        $active_tab = get_post_meta( $post_id, '_faq_active_tab', true ) ?: 'faq-custom';
        $faq_post_type = get_post_meta( $post_id, '_faq_post_type', true ) ?: 'faq';
        $faq_order_by  = get_post_meta( $post_id, '_faq_order_by', true ) ?: 'title';
        $faq_order = get_post_meta( $post_id, '_faq_order', true ) ?: 'ASC';

        $exclude_ids_meta = get_post_meta( $post_id, '_faq_exclude_ids', true );
        $exclude_ids = array_filter( array_map( 'intval', explode( ',', $exclude_ids_meta ) ) );

        $faq_limit = intval( get_post_meta( $post_id, '_faq_limit', true ) );
        if ( $faq_limit <= 0 ) {
            $faq_limit = -1;
        }
    
        if ( $active_tab === 'faq-custom' ) {
            // Fetch FAQs from custom entries
            $custom_faqs = get_post_meta( $post_id, '_faq_items', true );
            $custom_faqs = is_array( $custom_faqs ) ? $custom_faqs : [];
    
            if ( empty( $custom_faqs ) ) {
                return '<p>No custom FAQs found.</p>';
            }

           
            // Build accordion for custom FAQs
            
            $output = '<div class="accordion" id="faqAccordion">';
            if ( $faq_search ) {
                $output .= '<div class="faq-search-container">
                              
                                <input type="text" class="faq-search-box" oninput="filterFAQs()" placeholder="Search FAQs">
                            </div>';
            }
            foreach ( $custom_faqs as $index => $faq ) {
                $is_first = $index === 0 ? ' show' : ''; // Open the first accordion by default
                $output .= '
                 <div class="accordion-item">
                  
                        <h2 class="accordion-header" id="heading' . $index . '">
                            <button class="accordion-button' . ( $is_first ? '' : ' collapsed' ) . '" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $index . '" aria-expanded="' . ( $is_first ? 'true' : 'false' ) . '" aria-controls="collapse' . $index . '" style="font-size: ' . esc_attr( $faq_title_font_size ) . 'px !important; border-radius: ' . esc_attr( $faq_border_radius ) . 'px !important;">
                                ' . esc_html( $faq['title'] ?? 'FAQ ' . ( $index + 1 ) ) . '
                            </button>
                        </h2>
                        <div id="collapse' . $index . '" class="accordion-collapse collapse' . $is_first . '" aria-labelledby="heading' . $index . '" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="font-size: ' . esc_attr( $faq_desc_font_size ) . 'px !important;">
                                ' . wp_kses_post( $faq['description'] ?? '' ) . '
                            </div>
                        </div>
                    </div>

                    <div class="no-results-message" style="display:none;">
                        No FAQs found according to your search.
                    </div>
                    
                    ';
            }
            $output .= '</div>';
            return $output;
    
        } elseif ( $active_tab === 'faq-post' ) {
            $faq_query = new WP_Query( [
                'post_type'     => $faq_post_type,
                'posts_per_page' => $faq_limit,
                'orderby'       => $faq_order_by,
                'order'         => $faq_order,
                'post__not_in'   => $exclude_ids,
            ] );
    
            if ( ! $faq_query->have_posts() ) {
                return '<p>No FAQs found.</p>';
            }

            $output = '<div class="accordion" id="faqAccordion">';
            if ( $faq_search ) {
                $output .= '<div class="faq-search-container">
                              
                                <input type="text" class="faq-search-box" oninput="filterFAQs()" placeholder="Search FAQs">
                            </div>';
            }
            $counter = 0;
    
            while ( $faq_query->have_posts() ) {
                $faq_query->the_post();
                $counter++;
                $is_first = $counter === 1 ? ' show' : '';
    
                $output .= ' 
               
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading' . $counter . '">
                        <button class="accordion-button' . ( $is_first ? '' : ' collapsed' ) . '" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $counter . '" aria-expanded="' . ( $is_first ? 'true' : 'false' ) . '" aria-controls="collapse' . $counter . '" style="font-size: ' . esc_attr( $faq_title_font_size ) . 'px !important; border-radius: ' . esc_attr( $faq_border_radius ) . 'px !important;">
                            ' . esc_html( get_the_title() ) . '
                        </button>
                    </h2>
                    <div id="collapse' . $counter . '" class="accordion-collapse collapse' . $is_first . '" aria-labelledby="heading' . $counter . '" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="font-size: ' . esc_attr( $faq_desc_font_size ) . 'px !important;">
                            ' . wp_kses_post( get_the_content() ) . '
                        </div>
                    </div>
                </div>
            

                    <div class="no-results-message" style="display:none;">
                        No FAQs found according to your search.
                    </div>
                    
                    ';
            }
    
            $output .= '</div>';
    
            wp_reset_postdata();
            return $output;
        }
    
        return '<p>Invalid FAQS.</p>';
    }
    
}

new FAQLY_Shortcode();