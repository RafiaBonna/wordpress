<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FAQLY_Post_Type {

    public function __construct() {
        add_action( 'init', [ $this, 'register_faq_post_type' ] );
        add_action( 'init', [ $this, 'register_faq_group_post_type' ] );

        add_filter('manage_edit-faqly_faq_columns', function($columns) {
            $new_columns = [];
            foreach ($columns as $key => $label) {
                $new_columns[$key] = $label;
                if ($key === 'title') {
                    $new_columns['faq_id'] = __('ID', 'faqly');
                }
            }
            return $new_columns;
        });

        add_action('manage_faqly_faq_posts_custom_column', function($column, $post_id) {
            if ($column === 'faq_id') {
                echo '<code class="faq-copy-id" data-id="' . esc_attr($post_id) . '">[' . $post_id . ']</code>';
            }
        }, 10, 2);


        add_action('admin_enqueue_scripts', function($hook) {
            if ('edit.php' === $hook && isset($_GET['post_type']) && $_GET['post_type'] === 'faqly_faq') {
                wp_add_inline_script('jquery-core', "
                    jQuery(document).on('click', '.faq-copy-id', function(){
                        var id = jQuery(this).data('id');
                        navigator.clipboard.writeText(id).then(function(){
                            var el = jQuery('<span>Copied!</span>');
                            jQuery('.faq-copy-id').removeClass('copied');
                            jQuery(this).after(el);
                            setTimeout(function(){ el.fadeOut(300, function(){ jQuery(this).remove(); }); }, 1000);
                        }.bind(this));
                    });
                ");
            }
        });
    }

    public function register_faq_post_type() {
        $labels = [
            'name'               => 'FAQs',
            'singular_name'      => 'FAQ',
            'add_new'            => 'Add New FAQ',
            'add_new_item'       => 'Add New FAQ',
            'edit_item'          => 'Edit FAQ',
            'new_item'           => 'New FAQ',
            'view_item'          => 'View FAQ',
            'search_items'       => 'Search FAQs',
            'not_found'          => 'No FAQs found',
            'not_found_in_trash' => 'No FAQs found in Trash',
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'has_archive'        => true,
            'supports'           => [ 'title', 'editor' ],
            'show_ui'            => true,
            'show_in_menu'       => false,
        ];

        register_post_type( 'faqly_faq', $args ); 
    }

    public function register_faq_group_post_type() {
        $labels = [
            'name'               => 'FAQ Groups',
            'singular_name'      => 'FAQ Group',
            'add_new'            => 'Add New FAQ Group',
            'add_new_item'       => 'Add New FAQ Group',
            'edit_item'          => 'Edit FAQ Group',
            'new_item'           => 'New FAQ Group',
            'view_item'          => 'View FAQ Group',
            'search_items'       => 'Search FAQ Groups',
            'not_found'          => 'No FAQ Groups found',
            'not_found_in_trash' => 'No FAQ Groups found in Trash',
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'has_archive'        => true,
            'supports'           => [ 'title' ],
            'show_ui'            => true,
            'show_in_menu'       => false,
        ];

        register_post_type( 'faqly_faq_group', $args ); 
    }
}
