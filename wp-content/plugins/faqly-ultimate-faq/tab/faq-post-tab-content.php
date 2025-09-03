<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Retrieve saved meta values (if any)
$post_type = get_post_meta( get_the_ID(), '_faq_post_type', true );
$order_by = get_post_meta( get_the_ID(), '_faq_order_by', true );
$order = get_post_meta(get_the_ID(), '_faq_order', true); //(ASC/DESC)

// $faq_icon = get_post_meta(get_the_ID(), '_faq_icon', true); 
?>

<div class="form-group">
    <label for="faq_post_type">Post Type:</label>
    <select name="faq_post_type" id="faq_post_type" class="form-control">
        <option value="faqly_faq" <?php selected( $post_type, 'faqly_faq' ); ?>>All Posts (FAQ)</option>
        <option value="post" <?php selected( $post_type, 'post' ); ?>>Normal Posts</option>
    </select>
</div>

<div class="form-group">
    <label for="faq_order_by">Order By:</label>
    <select name="faq_order_by" id="faq_order_by" class="form-control">
        <option value="title" <?php selected( $order_by, 'title' ); ?>>Title</option>
        <option value="date" <?php selected( $order_by, 'date' ); ?>>Date</option>
        <option value="ID" <?php selected( $order_by, 'ID' ); ?>>ID</option>
    </select>
</div>

<div class="form-group">
    <label for="faq_order">Order (Ascending/Descending):</label>
    <select name="faq_order" id="faq_order" class="form-control">
        <option value="ASC" <?php selected($order, 'ASC'); ?>>Ascending</option>
        <option value="DESC" <?php selected($order, 'DESC'); ?>>Descending</option>
    </select>
</div>


<!-- //new -->
 <div class="form-group">
    <label for="faq_exclude_ids">Exclude by ID (comma separated):</label>
    <input type="text" name="faq_exclude_ids" id="faq_exclude_ids" class="form-control"
           value="<?php echo esc_attr( get_post_meta( get_the_ID(), '_faq_exclude_ids', true ) ); ?>"
           placeholder="e.g. 12,45,89">
</div>

<div class="form-group">
    <label for="faq_limit">Limit:</label>
    <input type="number" name="faq_limit" id="faq_limit" class="form-control"
           value="<?php echo esc_attr( get_post_meta( get_the_ID(), '_faq_limit', true ) ); ?>"
           placeholder="Leave empty for no limit" min="1">
</div>
