<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Faqly_General_Settings_Metabox {

    public static function faqly_render_metabox( $post ) {
        $accordion_event = get_post_meta( $post->ID, '_accordion_event', true ) ?: '.click';
        $accordion_mode = get_post_meta( $post->ID, '_accordion_mode', true ) ?: '.first_open';
        $faq_search = get_post_meta( $post->ID, '_faq_search', true ) ?: 'disable';

        $faq_title_font_size = get_post_meta( $post->ID, '_faq_title_font_size', true ) ?: '25'; // Default font size
        $faq_desc_font_size = get_post_meta( $post->ID, '_faq_desc_font_size', true ) ?: '18';  // Default font size
        //nounce
        wp_nonce_field( 'save_faq_settings', 'faq_settings_nonce' );
        ?>
        <div id="accordion-settings-metabox" class="settings-metabox">
           
    
            <!-- Accordion Event Setting -->
            <div class="setting-group">
                <p class="setting-label"><strong>Accordion Event:</strong></p>
                <div class="radio-group">
                    <label class="radio-option">
                        <input type="radio" name="accordion_event" value=".click" <?php checked( $accordion_event, '.click' ); ?> /> Click
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="accordion_event" value=".mouseover" <?php checked( $accordion_event, '.mouseover' ); ?> /> Mouseover
                    </label>
                </div>
            </div>
    
            <hr class="setting-divider" />
    
            <!-- Accordion Mode Setting -->
            <div class="setting-group">
                <p class="setting-label"><strong>Accordion Mode:</strong></p>
                <div class="radio-group">
                    <label class="radio-option">
                        <input type="radio" name="accordion_mode" value=".first_open" <?php checked( $accordion_mode, '.first_open' ); ?> /> First Open
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="accordion_mode" value=".all_open" <?php checked( $accordion_mode, '.all_open' ); ?> /> All Open
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="accordion_mode" value=".all_folded" <?php checked( $accordion_mode, '.all_folded' ); ?> /> All Folded
                    </label>
                </div>
            </div>
    
            <hr class="setting-divider" />
    
            <!-- FAQ Search Setting -->
            <div class="setting-group">
                <p class="setting-label"><strong>FAQ Search:</strong></p>
                <div class="radio-group">
                    <label class="radio-option">
                        <input type="radio" name="faq_search" value="enable" <?php checked( $faq_search, 'enable' ); ?> /> Enable
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="faq_search" value="disable" <?php checked( $faq_search, 'disable' ); ?> /> Disable
                    </label>
                </div>
            </div>

            <hr class="setting-divider" />

            <!-- FAQ Title Font Size -->
            <div class="setting-group">
                <p class="setting-label"><strong>FAQ Title Font Size (px):</strong></p>
                <input type="number" name="faq_title_font_size" value="<?php echo esc_attr( $faq_title_font_size ); ?>" min="10" max="50" />
            </div>
            
            <hr class="setting-divider" />
            
            <!-- FAQ Description Font Size -->
            <div class="setting-group">
                <p class="setting-label"><strong>FAQ Description Font Size (px):</strong></p>
                <input type="number" name="faq_desc_font_size" value="<?php echo esc_attr( $faq_desc_font_size ); ?>" min="10" max="50" />
            </div>
             
            <hr class="setting-divider" />

            <!-- FAQ Border Radius -->
            <div class="setting-group">
                <p class="setting-label"><strong>FAQ Border Radius (px):</strong></p>
                <input type="number" name="faq_border_radius" value="<?php echo esc_attr( get_post_meta( $post->ID, '_faq_border_radius', true ) ?: '0' ); ?>" min="0" max="80" />
            </div>
            
        </div>
        <?php
    }
    

    public static function faqly_save_metabox( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

        if ( ! isset( $_POST['faq_settings_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['faq_settings_nonce'] ) ), 'save_faq_settings' ) ) {
            return;
        }
        update_post_meta( $post_id, '_accordion_event', sanitize_text_field( wp_unslash( $_POST['accordion_event'] ?? '' ) ) );
        update_post_meta( $post_id, '_accordion_mode', sanitize_text_field( wp_unslash( $_POST['accordion_mode'] ?? '' ) ) );
        update_post_meta( $post_id, '_faq_search', sanitize_text_field( wp_unslash( $_POST['faq_search'] ?? 'disable' ) ) );
    
        update_post_meta( $post_id, '_faq_title_font_size', intval( wp_unslash( $_POST['faq_title_font_size'] ?? '25' ) ) );
        update_post_meta( $post_id, '_faq_desc_font_size', intval( wp_unslash( $_POST['faq_desc_font_size'] ?? '18' ) ) );

        update_post_meta( $post_id, '_faq_border_radius', intval( wp_unslash( $_POST['faq_border_radius'] ?? '0' ) ) );
    }
}