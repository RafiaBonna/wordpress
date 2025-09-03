<?php
/**
 * Plugin Recommendations for Shop Toolkit Pro Theme
 *
 * @package Blog_Build_Pro
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Silent Upgrader Skin for automatic plugin installation
 * Only define when needed to avoid early loading issues
 */
if (!class_exists('Blog_Build_Pro_Silent_Upgrader_Skin')) {
    
    /**
     * Load the Silent Upgrader Skin class when needed
     */
    function blog_build_load_silent_upgrader_skin() {
        if (!class_exists('WP_Upgrader_Skin')) {
            require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        }
        
        if (!class_exists('Blog_Build_Pro_Silent_Upgrader_Skin')) {
            class Blog_Build_Pro_Silent_Upgrader_Skin extends WP_Upgrader_Skin {
                
                /**
                 * Override feedback method to suppress output
                 */
                public function feedback($string, ...$args) {
                    // Suppress all output during installation
                }
                
                /**
                 * Override header method to suppress output
                 */
                public function header() {
                    // Suppress header output
                }
                
                /**
                 * Override footer method to suppress output
                 */
                public function footer() {
                    // Suppress footer output
                }
                
                /**
                 * Override error method to suppress output
                 */
                public function error($errors) {
                    // Suppress error output but still return the error
                    return $errors;
                }
            }
        }
    }
}

/**
 * Plugin Recommendations Class
 */
class Blog_Build_Pro_Plugin_Recommendations {
    
    /**
     * Plugin directory path
     */
    private $plugin_dir;
    
    /**
     * Plugin directory URL
     */
    private $plugin_url;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->plugin_dir = get_template_directory() . '/libs/plugin-recommend';
        $this->plugin_url = get_template_directory_uri() . '/libs/plugin-recommend';
        
        // Reset old notice dismissals only once (for migration to new system)
        $this->migrate_notice_dismissal();
        
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        add_action('wp_ajax_blog_build_install_plugin', array($this, 'ajax_install_plugin'));
        add_action('wp_ajax_blog_build_activate_plugin', array($this, 'ajax_activate_plugin'));
        add_action('wp_ajax_blog_build_update_plugin', array($this, 'ajax_update_plugin'));
        add_action('wp_ajax_blog_build_dismiss_plugin_notice', array($this, 'ajax_dismiss_plugin_notice'));
        add_action('wp_ajax_blog_build_dismiss_update_notice', array($this, 'ajax_dismiss_update_notice'));
        add_action('wp_ajax_blog_build_update_all_plugins', array($this, 'ajax_update_all_plugins'));
        add_action('wp_ajax_blog_build_install_required_plugins', array($this, 'ajax_install_required_plugins'));
        add_action('wp_ajax_blog_build_install_recommended_plugins', array($this, 'ajax_install_recommended_plugins'));
        add_action('wp_ajax_blog_build_check_recommended_plugins_status', array($this, 'ajax_check_recommended_plugins_status'));
        add_action('wp_ajax_blog_build_check_recommended_plugins_status', array($this, 'ajax_check_recommended_plugins_status'));
        add_action('admin_notices', array($this, 'show_recommendation_notice'));
        add_action('admin_notices', array($this, 'show_update_notice'));
        
        // Auto-install required plugins
        add_action('after_switch_theme', array($this, 'auto_install_required_plugins'));
        add_action('admin_init', array($this, 'check_required_plugins'));
    }
    
    /**
     * Add admin menu page
     */
    public function add_admin_menu() {
        add_theme_page(
            __('Recommended Plugins', 'shop-toolkit'),
            __('Recommended Plugins', 'shop-toolkit'),
            'manage_options',
            'blog-build-plugins',
            array($this, 'render_admin_page')
        );
    }
    
    /**
     * Get recommended plugins (including local plugins)
     */
    public function get_recommended_plugins() {
        return array(
            
            // WordPress.org plugins
            'magical-addons-for-elementor' => array(
                'name' => __('Magical Addons', 'shop-toolkit'),
                'slug' => 'magical-addons-for-elementor',
                'file' => 'magical-addons-for-elementor/magical-addons-for-elementor.php',
                'description' => __('Enhance your site with a collection of magical addons for Elementor.', 'shop-toolkit'),
                'category' => 'Essential',
                'required' => false,
                'featured' => false,
                'is_local' => false
            ),
            'magical-posts-display' => array(
                'name' => __('Magical Posts Display', 'shop-toolkit'),
                'slug' => 'magical-posts-display',
                'file' => 'magical-posts-display/magical-posts-display.php',
                'description' => __('Display your posts in a magical way with this addon for Elementor.', 'shop-toolkit'),
                'category' => 'Essential',
                'required' => false,
                'featured' => true,
                'is_local' => false
            ),
            'elementor' => array(
                'name' => __('Elementor Page Builder', 'shop-toolkit'),
                'slug' => 'elementor',
                'file' => 'elementor/elementor.php',
                'description' => __('Create beautiful pages with drag & drop page builder. Perfect for creating stunning layouts with your theme.', 'shop-toolkit'),
                'category' => 'Page Builder',
                'required' => false,
                'featured' => true,
                'is_local' => false
            ),
            'woocommerce' => array(
                'name' => __('WooCommerce', 'shop-toolkit'),
                'slug' => 'woocommerce',
                'file' => 'woocommerce/woocommerce.php',
                'description' => __('main plugin for shop website.', 'shop-toolkit'),
                'category' => 'Utility',
                'required' => false,
                'featured' => false,
                'is_local' => false
            ),
            'wp-edit-password-protected' => array(
                'name' => __('WP Edit Password Protected', 'shop-toolkit'),
                'slug' => 'wp-edit-password-protected',
                'file' => 'wp-edit-password-protected/wp-edit-password-protected.php',
                'description' => __('Easily manage password protection for your WordPress content.', 'shop-toolkit'),
                'category' => 'Security',
                'required' => false,
                'featured' => true,
                'is_local' => false
            ),
            'easy-share-solution' => array(
                'name' => __('Easy Share Solution', 'shop-toolkit'),
                'slug' => 'easy-share-solution',
                'file' => 'easy-share-solution/easy-share-solution.php',
                'description' => __('Easily add social sharing buttons to your content.', 'shop-toolkit'),
                'category' => 'Utility',
                'required' => false,
                'featured' => true,
                'is_local' => false
            ),
            'guest-checkout-account-creator' => array(
                'name' => __('Gust Account', 'shop-toolkit'),
                'slug' => 'guest-checkout-account-creator',
                'file' => 'guest-checkout-account-creator/guest-checkout-account-creator.php',
                'description' => __('Create Account for Gust client.', 'shop-toolkit'),
                'category' => 'Utility',
                'required' => false,
                'featured' => false,
                'is_local' => false
            ),
        );
    }
    
    /**
     * Check plugin status including version checking for updates
     */
    public function get_plugin_status($plugin) {
        $this->check_plugin_functions();
        
        $plugin_file = $plugin['file'];
        
        if (is_plugin_active($plugin_file)) {
            // Check if plugin needs update (for plugins with version specified)
            if (isset($plugin['version']) && !empty($plugin['version'])) {
                $current_version = $this->get_plugin_version($plugin_file);
                if ($current_version && version_compare($current_version, $plugin['version'], '<')) {
                    return 'needs-update';
                }
            }
            return 'active';
        } elseif (file_exists(WP_PLUGIN_DIR . '/' . $plugin_file)) {
            // Check if inactive plugin needs update
            if (isset($plugin['version']) && !empty($plugin['version'])) {
                $current_version = $this->get_plugin_version($plugin_file);
                if ($current_version && version_compare($current_version, $plugin['version'], '<')) {
                    return 'inactive-needs-update';
                }
            }
            return 'inactive';
        } else {
            return 'not-installed';
        }
    }
    
    /**
     * Get plugin version from plugin header
     */
    private function get_plugin_version($plugin_file) {
        $plugin_path = WP_PLUGIN_DIR . '/' . $plugin_file;
        
        if (!file_exists($plugin_path)) {
            return false;
        }
        
        // Get plugin data
        if (!function_exists('get_plugin_data')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        
        $plugin_data = get_plugin_data($plugin_path);
        
        return isset($plugin_data['Version']) ? $plugin_data['Version'] : false;
    }
    
    /**
     * Check if plugin is a local plugin
     */
    private function is_local_plugin($plugin) {
        return isset($plugin['is_local']) && $plugin['is_local'] === true;
    }
    
    /**
     * Render admin page
     */
    public function render_admin_page() {
        $plugins = $this->get_recommended_plugins();
        ?>
        <div class="wrap blog-build-plugins">
            <h1><?php esc_html_e('Recommended Plugins for Shop Toolkit Pro', 'shop-toolkit'); ?></h1>
            <p class="description">
                <?php esc_html_e('These plugins are recommended to enhance your Shop Toolkit Pro theme experience. They work perfectly with the theme\'s features and animations.', 'shop-toolkit'); ?>
            </p>
            
            <?php
            // Check if there are missing required plugins
            $missing_required = array();
            $required_plugins = $this->get_required_plugins();
            
            foreach ($required_plugins as $slug => $plugin) {
                if ($this->get_plugin_status($plugin) !== 'active') {
                    $missing_required[$slug] = $plugin;
                }
            }
            
            if (!empty($missing_required)) :
            ?>
            <div class="notice notice-warning">
                <p>
                    <strong><?php esc_html_e('Missing Required Plugins:', 'shop-toolkit'); ?></strong>
                    <?php printf(esc_html__('%d required plugins are missing or inactive.', 'shop-toolkit'), count($missing_required)); ?>
                    <button id="install-required-plugins" class="button button-primary" style="margin-left: 10px;">
                        <?php esc_html_e('Install Required Plugins', 'shop-toolkit'); ?>
                    </button>
                </p>
            </div>
            <?php endif; ?>
            
            <?php
            // Count plugins in each category
            $plugin_counts = array(
                'all' => count($plugins),
                'featured' => 0,
                'required' => 0,
                'active' => 0,
                'inactive' => 0,
                'not-installed' => 0
            );
            
            foreach ($plugins as $slug => $plugin) {
                $status = $this->get_plugin_status($plugin);
                
                if ($plugin['featured']) {
                    $plugin_counts['featured']++;
                }
                
                if ($plugin['required']) {
                    $plugin_counts['required']++;
                }
                
                switch ($status) {
                    case 'active':
                        $plugin_counts['active']++;
                        break;
                    case 'inactive':
                    case 'inactive-needs-update':
                        $plugin_counts['inactive']++;
                        break;
                    case 'not-installed':
                        $plugin_counts['not-installed']++;
                        break;
                }
            }
            
            // Determine which tab should be active (first available tab)
            $available_tabs = array();
            $first_active_tab = '';
            
            if ($plugin_counts['all'] > 0) {
                $available_tabs[] = 'all';
                if (empty($first_active_tab)) $first_active_tab = 'all';
            }
            if ($plugin_counts['featured'] > 0) {
                $available_tabs[] = 'featured';
                if (empty($first_active_tab)) $first_active_tab = 'featured';
            }
            if ($plugin_counts['required'] > 0) {
                $available_tabs[] = 'required';
                if (empty($first_active_tab)) $first_active_tab = 'required';
            }
            if ($plugin_counts['active'] > 0) {
                $available_tabs[] = 'active';
                if (empty($first_active_tab)) $first_active_tab = 'active';
            }
            if ($plugin_counts['inactive'] > 0) {
                $available_tabs[] = 'inactive';
                if (empty($first_active_tab)) $first_active_tab = 'inactive';
            }
            if ($plugin_counts['not-installed'] > 0) {
                $available_tabs[] = 'not-installed';
                if (empty($first_active_tab)) $first_active_tab = 'not-installed';
            }
            ?>
            
            <div class="plugin-filter-tabs">
                <?php if ($plugin_counts['all'] > 0) : ?>
                    <button class="filter-tab <?php echo ($first_active_tab === 'all') ? 'active' : ''; ?>" data-filter="all"><?php printf(esc_html__('All Plugins (%d)', 'shop-toolkit'), $plugin_counts['all']); ?></button>
                <?php endif; ?>
                
                <?php if ($plugin_counts['featured'] > 0) : ?>
                    <button class="filter-tab <?php echo ($first_active_tab === 'featured') ? 'active' : ''; ?>" data-filter="featured"><?php printf(esc_html__('Featured (%d)', 'shop-toolkit'), $plugin_counts['featured']); ?></button>
                <?php endif; ?>
                
                <?php if ($plugin_counts['required'] > 0) : ?>
                    <button class="filter-tab <?php echo ($first_active_tab === 'required') ? 'active' : ''; ?>" data-filter="required"><?php printf(esc_html__('Required (%d)', 'shop-toolkit'), $plugin_counts['required']); ?></button>
                <?php endif; ?>
                
                <?php if ($plugin_counts['active'] > 0) : ?>
                    <button class="filter-tab <?php echo ($first_active_tab === 'active') ? 'active' : ''; ?>" data-filter="active"><?php printf(esc_html__('Active (%d)', 'shop-toolkit'), $plugin_counts['active']); ?></button>
                <?php endif; ?>
                
                <?php if ($plugin_counts['inactive'] > 0) : ?>
                    <button class="filter-tab <?php echo ($first_active_tab === 'inactive') ? 'active' : ''; ?>" data-filter="inactive"><?php printf(esc_html__('Inactive (%d)', 'shop-toolkit'), $plugin_counts['inactive']); ?></button>
                <?php endif; ?>
                
                <?php if ($plugin_counts['not-installed'] > 0) : ?>
                    <button class="filter-tab <?php echo ($first_active_tab === 'not-installed') ? 'active' : ''; ?>" data-filter="not-installed"><?php printf(esc_html__('Not Installed (%d)', 'shop-toolkit'), $plugin_counts['not-installed']); ?></button>
                <?php endif; ?>
            </div>
            
            <div class="plugins-grid">
                <?php foreach ($plugins as $slug => $plugin) : 
                    $status = $this->get_plugin_status($plugin);
                    $featured_class = $plugin['featured'] ? 'featured' : '';
                    $is_local = $this->is_local_plugin($plugin);
                ?>
                    <div class="plugin-card <?php echo esc_attr($featured_class); ?>" data-status="<?php echo esc_attr($status); ?>" data-featured="<?php echo $plugin['featured'] ? '1' : '0'; ?>" data-required="<?php echo $plugin['required'] ? '1' : '0'; ?>" data-local="<?php echo $is_local ? '1' : '0'; ?>" data-slug="<?php echo esc_attr($slug); ?>">
                        <?php if ($plugin['featured']) : ?>
                            <div class="featured-badge"><?php esc_html_e('Featured', 'shop-toolkit'); ?></div>
                        <?php endif; ?>
                        
                        <?php if ($plugin['required']) : ?>
                            <div class="required-badge"><?php esc_html_e('Required', 'shop-toolkit'); ?></div>
                        <?php endif; ?>
                        
                        <?php if ($is_local) : ?>
                            <div class="local-plugin-badge"><?php esc_html_e('Local', 'shop-toolkit'); ?></div>
                        <?php endif; ?>
                        
                        <div class="plugin-header">
                            <h3><?php echo esc_html($plugin['name']); ?></h3>
                            <span class="plugin-category"><?php echo esc_html($plugin['category']); ?></span>
                        </div>
                        
                        <div class="plugin-description">
                            <p><?php echo esc_html($plugin['description']); ?></p>
                        </div>
                        
                        <div class="plugin-actions">
                            <?php $this->render_plugin_button($slug, $plugin, $status); ?>
                            <span class="plugin-status status-<?php echo esc_attr($status); ?>">
                                <?php echo esc_html($this->get_status_text($status)); ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
    
    /**
     * Render plugin action button
     */
    private function render_plugin_button($slug, $plugin, $status) {
        $is_local = $this->is_local_plugin($plugin);
        $current_version = '';
        $required_version = isset($plugin['version']) ? $plugin['version'] : '';
        
        if ($status === 'active' || $status === 'inactive' || $status === 'needs-update' || $status === 'inactive-needs-update') {
            $current_version = $this->get_plugin_version($plugin['file']);
        }
        
        switch ($status) {
            case 'active':
                echo '<span class="button disabled">' . esc_html__('Active', 'shop-toolkit') . '</span>';
                break;
            case 'needs-update':
                echo '<button class="button button-secondary update-plugin" data-slug="' . esc_attr($slug) . '" data-file="' . esc_attr($plugin['file']) . '" data-is-local="' . ($is_local ? '1' : '0') . '">' . esc_html__('Update', 'shop-toolkit') . '</button>';
                break;
            case 'inactive':
                echo '<button class="button button-primary activate-plugin" data-slug="' . esc_attr($slug) . '" data-file="' . esc_attr($plugin['file']) . '">' . esc_html__('Activate', 'shop-toolkit') . '</button>';
                break;
            case 'inactive-needs-update':
                echo '<button class="button button-secondary update-plugin" data-slug="' . esc_attr($slug) . '" data-file="' . esc_attr($plugin['file']) . '" data-is-local="' . ($is_local ? '1' : '0') . '">' . esc_html__('Update', 'shop-toolkit') . '</button>';
                break;
            case 'not-installed':
                if ($is_local) {
                    echo '<button class="button button-primary install-plugin" data-slug="' . esc_attr($slug) . '" data-is-local="1">' . esc_html__('Install', 'shop-toolkit') . '</button>';
                } else {
                    echo '<button class="button button-primary install-plugin" data-slug="' . esc_attr($plugin['slug']) . '" data-is-local="0">' . esc_html__('Install', 'shop-toolkit') . '</button>';
                }
                break;
        }
        
        // Show version info if available
        if ($current_version && $required_version) {
            echo '<small class="version-info">';
            printf(esc_html__('Current: %s | Required: %s', 'shop-toolkit'), $current_version, $required_version);
            echo '</small>';
        } elseif ($current_version) {
            echo '<small class="version-info">';
            printf(esc_html__('Version: %s', 'shop-toolkit'), $current_version);
            echo '</small>';
        } elseif ($required_version) {
            echo '<small class="version-info">';
            printf(esc_html__('Required Version: %s', 'shop-toolkit'), $required_version);
            echo '</small>';
        }
    }
    
    /**
     * Get status text
     */
    private function get_status_text($status) {
        switch ($status) {
            case 'active':
                return __('Active', 'shop-toolkit');
            case 'needs-update':
                return __('Update Available', 'shop-toolkit');
            case 'inactive':
                return __('Installed but not active', 'shop-toolkit');
            case 'inactive-needs-update':
                return __('Update Available (Inactive)', 'shop-toolkit');
            case 'not-installed':
                return __('Not installed', 'shop-toolkit');
            default:
                return __('Unknown', 'shop-toolkit');
        }
    }
    
    /**
     * Show update notice for plugins that need updates
     */
    public function show_update_notice() {
        $screen = get_current_screen();
        
        // Only show on dashboard, themes, and plugins pages
        if (!in_array($screen->id, array('dashboard', 'themes', 'plugins', 'appearance_page_blog-build-plugins'))) {
            return;
        }
        
        // Check if user dismissed the update notice
        $dismissed_time = get_user_meta(get_current_user_id(), 'blog_build_hide_update_notice_time', true);
        $show_update_notice = !$dismissed_time || (time() - $dismissed_time) >= (7 * 24 * 60 * 60); // 7 days
        
        if (!$show_update_notice) {
            return;
        }
        
        // Get plugins that need updates
        $plugins_need_update = $this->get_plugins_needing_updates();
        
        if (empty($plugins_need_update)) {
            return;
        }
        
        ?>
        <div class="notice notice-warning is-dismissible blog-build-pro-update-notice">
            <div class="plugin-update-content">
                <div style="flex: 1;">
                    <h3><?php esc_html_e('Plugin Updates Available', 'shop-toolkit'); ?></h3>
                    <p><?php printf(esc_html__('%d plugins have updates available. Keep your plugins up to date for better security and performance.', 'shop-toolkit'), count($plugins_need_update)); ?></p>
                    <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap; margin-top: 15px;">
                        <button id="update-all-plugins" class="button button-primary"><?php esc_html_e('Update All Plugins', 'shop-toolkit'); ?></button>
                        <a href="<?php echo esc_url(admin_url('themes.php?page=blog-build-plugins')); ?>" class="button button-secondary"><?php esc_html_e('Manage Plugins', 'shop-toolkit'); ?></a>
                    </div>
                </div>
                <div class="plugin-icon-recomend">🔄</div>
            </div>
        </div>
        <?php
    }
    
    /**
     * Get plugins that need updates
     */
    private function get_plugins_needing_updates() {
        $all_plugins = $this->get_recommended_plugins();
        $plugins_need_update = array();
        
        foreach ($all_plugins as $slug => $plugin) {
            $status = $this->get_plugin_status($plugin);
            if (in_array($status, array('needs-update', 'inactive-needs-update'))) {
                $plugins_need_update[$slug] = $plugin;
            }
        }
        
        return $plugins_need_update;
    }
    
    /**
     * AJAX handler for dismissing update notice
     */
    public function ajax_dismiss_update_notice() {
        check_ajax_referer('blog_build_plugins_nonce', 'nonce');
        
        // Save the current timestamp when update notice is dismissed
        update_user_meta(get_current_user_id(), 'blog_build_hide_update_notice_time', time());
        wp_send_json_success();
    }
    
    /**
     * AJAX handler for dismissing plugin notice
     */
    public function ajax_dismiss_plugin_notice() {
        check_ajax_referer('blog_build_plugins_nonce', 'nonce');
        
        $notice_type = sanitize_text_field($_POST['notice_type']);
        
        if ($notice_type === 'recommended') {
            // Save the current timestamp when recommended notice is dismissed
            update_user_meta(get_current_user_id(), 'blog_build_hide_recommended_notice_time', time());
        }
        
        wp_send_json_success();
    }
    
    /**
     * AJAX handler for updating all plugins
     */
    public function ajax_update_all_plugins() {
        check_ajax_referer('blog_build_plugins_nonce', 'nonce');
        
        if (!current_user_can('update_plugins')) {
            wp_die(__('You do not have permission to update plugins.', 'shop-toolkit'));
        }
        
        $plugins_need_update = $this->get_plugins_needing_updates();
        $results = array();
        $success_count = 0;
        $total_count = count($plugins_need_update);
        
        foreach ($plugins_need_update as $slug => $plugin) {
            $is_local = $this->is_local_plugin($plugin);
            
            if ($is_local) {
                $result = $this->update_local_plugin($plugin);
            } else {
                $result = $this->update_wordpress_org_plugin($plugin['file']);
            }
            
            if ($result) {
                $results[$slug] = 'updated';
                $success_count++;
            } else {
                $results[$slug] = 'failed';
            }
        }
        
        if ($success_count === $total_count) {
            wp_send_json_success(array(
                'message' => sprintf(__('%d plugins updated successfully.', 'shop-toolkit'), $success_count),
                'results' => $results
            ));
        } else {
            wp_send_json_error(array(
                'message' => sprintf(__('%d of %d plugins updated successfully.', 'shop-toolkit'), $success_count, $total_count),
                'results' => $results
            ));
        }
    }
    
    /**
     * Enqueue admin scripts and styles
     */
    public function enqueue_admin_scripts($hook) {
        // Load scripts on plugin page, dashboard, themes page, and plugins page
        if (!in_array($hook, array('appearance_page_blog-build-plugins', 'index.php', 'themes.php', 'plugins.php'))) {
            return;
        }
        
        wp_enqueue_script(
            'blog-build-plugins-admin',
            $this->plugin_url . '/assets/js/admin-plugins.js',
            array('jquery'),
            SHOP_TOOLKIT_VERSION,
            true
        );
        
        wp_localize_script('blog-build-plugins-admin', 'blogBuildProPlugins', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('blog_build_plugins_nonce'),
            'strings' => array(
                'installing' => __('Installing...', 'shop-toolkit'),
                'activating' => __('Activating...', 'shop-toolkit'),
                'updating' => __('Updating...', 'shop-toolkit'),
                'installed' => __('Installed', 'shop-toolkit'),
                'activated' => __('Activated', 'shop-toolkit'),
                'updated' => __('Updated', 'shop-toolkit'),
                'active' => __('Active', 'shop-toolkit'),
                'inactive' => __('Inactive', 'shop-toolkit'),
                'notInstalled' => __('Not Installed', 'shop-toolkit'),
                'needsUpdate' => __('Update Available', 'shop-toolkit'),
                'inactiveNeedsUpdate' => __('Update Available (Inactive)', 'shop-toolkit'),
                'install' => __('Install', 'shop-toolkit'),
                'activate' => __('Activate', 'shop-toolkit'),
                'update' => __('Update', 'shop-toolkit'),
                'error' => __('Error occurred', 'shop-toolkit'),
            )
        ));
        
        wp_enqueue_style(
            'blog-build-plugins-admin',
            $this->plugin_url . '/assets/css/admin-plugins.css',
            array(),
            SHOP_TOOLKIT_VERSION
        );
    }
    
    /**
     * AJAX handler for plugin installation
     */
    public function ajax_install_plugin() {
        check_ajax_referer('blog_build_plugins_nonce', 'nonce');
        
        if (!current_user_can('install_plugins')) {
            wp_die(__('You do not have permission to install plugins.', 'shop-toolkit'));
        }
        
        $slug = sanitize_text_field($_POST['slug']);
        $is_local = isset($_POST['is_local']) && $_POST['is_local'] === '1';
        
        error_log('Shop Toolkit Pro: Installing plugin - Slug: ' . $slug . ', Is Local: ' . ($is_local ? 'Yes' : 'No'));
        
        if ($is_local) {
            // Handle local plugin installation
            $plugins = $this->get_recommended_plugins();
            
            if (!isset($plugins[$slug])) {
                error_log('Shop Toolkit Pro: Plugin not found in recommendations: ' . $slug);
                wp_send_json_error(__('Plugin not found in recommendations.', 'shop-toolkit'));
            }
            
            $plugin = $plugins[$slug];
            error_log('Shop Toolkit Pro: Plugin config: ' . print_r($plugin, true));
            
            // Check if source file exists
            if (!isset($plugin['source']) || !file_exists($plugin['source'])) {
                error_log('Shop Toolkit Pro: Source file check failed - Source: ' . (isset($plugin['source']) ? $plugin['source'] : 'not set') . ', Exists: ' . (isset($plugin['source']) && file_exists($plugin['source']) ? 'Yes' : 'No'));
                wp_send_json_error(__('Local plugin zip file not found. Please ensure the plugin zip file exists in the theme directory.', 'shop-toolkit'));
            }
            
            // Check if ZipArchive is available
            if (!class_exists('ZipArchive')) {
                error_log('Shop Toolkit Pro: ZipArchive class not available');
                wp_send_json_error(__('ZipArchive PHP extension is required for local plugin installation but not available on this server.', 'shop-toolkit'));
            }
            
            // Check if plugins directory is writable
            if (!is_writable(WP_PLUGIN_DIR)) {
                error_log('Shop Toolkit Pro: Plugin directory not writable: ' . WP_PLUGIN_DIR);
                wp_send_json_error(__('Plugins directory is not writable. Please check directory permissions.', 'shop-toolkit'));
            }
            
            error_log('Shop Toolkit Pro: Attempting to install local plugin...');
            $result = $this->install_local_plugin($plugin);
            
            if ($result) {
                error_log('Shop Toolkit Pro: Local plugin installation successful');
                wp_send_json_success(__('Local plugin installed successfully.', 'shop-toolkit'));
            } else {
                error_log('Shop Toolkit Pro: Local plugin installation failed');
                wp_send_json_error(__('Local plugin installation failed. Please check error logs for details.', 'shop-toolkit'));
            }
        } else {
            // Handle WordPress.org plugin installation
            include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
            include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
            
            $api = plugins_api('plugin_information', array('slug' => $slug));
            
            if (is_wp_error($api)) {
                wp_send_json_error(__('Plugin information could not be retrieved.', 'shop-toolkit'));
            }
            
            $upgrader = new Plugin_Upgrader(new WP_Ajax_Upgrader_Skin());
            $install = $upgrader->install($api->download_link);
            
            if ($install) {
                wp_send_json_success(__('Plugin installed successfully.', 'shop-toolkit'));
            } else {
                wp_send_json_error(__('Plugin installation failed.', 'shop-toolkit'));
            }
        }
    }
    
    /**
     * AJAX handler for plugin activation
     */
    public function ajax_activate_plugin() {
        check_ajax_referer('blog_build_plugins_nonce', 'nonce');
        
        if (!current_user_can('activate_plugins')) {
            wp_die(__('You do not have permission to activate plugins.', 'shop-toolkit'));
        }
        
        $plugin_file = sanitize_text_field($_POST['file']);
        
        $result = activate_plugin($plugin_file);
        
        if (is_wp_error($result)) {
            wp_send_json_error($result->get_error_message());
        } else {
            wp_send_json_success(__('Plugin activated successfully.', 'shop-toolkit'));
        }
    }
    
    /**
     * AJAX handler for plugin updates
     */
    public function ajax_update_plugin() {
        check_ajax_referer('blog_build_plugins_nonce', 'nonce');
        
        if (!current_user_can('update_plugins')) {
            wp_die(__('You do not have permission to update plugins.', 'shop-toolkit'));
        }
        
        $slug = sanitize_text_field($_POST['slug']);
        $plugin_file = sanitize_text_field($_POST['file']);
        $is_local = isset($_POST['is_local']) && $_POST['is_local'] === '1';
        
        $plugins = $this->get_recommended_plugins();
        
        if (!isset($plugins[$slug])) {
            wp_send_json_error(__('Plugin not found.', 'shop-toolkit'));
        }
        
        $plugin = $plugins[$slug];
        
        // Handle local plugin update
        if ($is_local) {
            $result = $this->update_local_plugin($plugin);
            
            if ($result) {
                wp_send_json_success(__('Local plugin updated successfully.', 'shop-toolkit'));
            } else {
                wp_send_json_error(__('Failed to update local plugin.', 'shop-toolkit'));
            }
        } else {
            // Handle WordPress.org plugin update
            $result = $this->update_wordpress_org_plugin($plugin_file);
            
            if ($result) {
                wp_send_json_success(__('Plugin updated successfully.', 'shop-toolkit'));
            } else {
                wp_send_json_error(__('Failed to update plugin.', 'shop-toolkit'));
            }
        }
    }
    
    /**
     * AJAX handler for bulk installing required plugins
     */
    public function ajax_install_required_plugins() {
        check_ajax_referer('blog_build_plugins_nonce', 'nonce');
        
        if (!current_user_can('install_plugins')) {
            wp_die(__('You do not have permission to install plugins.', 'shop-toolkit'));
        }
        
        $required_plugins = $this->get_required_plugins();
        $results = array();
        $success_count = 0;
        $total_count = count($required_plugins);
        
        foreach ($required_plugins as $slug => $plugin) {
            $status = $this->get_plugin_status($plugin);
            
            if ($status === 'active') {
                $results[$slug] = 'already-active';
                $success_count++;
            } else {
                $installed = $this->install_and_activate_plugin($plugin);
                
                if ($installed) {
                    $results[$slug] = 'installed-and-activated';
                    $success_count++;
                } else {
                    $results[$slug] = 'failed';
                }
            }
        }
        
        if ($success_count === $total_count) {
            wp_send_json_success(array(
                'message' => sprintf(__('%d required plugins installed and activated successfully.', 'shop-toolkit'), $success_count),
                'results' => $results
            ));
        } else {
            wp_send_json_error(array(
                'message' => sprintf(__('%d of %d required plugins installed successfully.', 'shop-toolkit'), $success_count, $total_count),
                'results' => $results
            ));
        }
    }
    
    /**
     * AJAX handler for bulk installing recommended plugins
     */
    public function ajax_install_recommended_plugins() {
        check_ajax_referer('blog_build_plugins_nonce', 'nonce');
        
        if (!current_user_can('install_plugins')) {
            wp_die(__('You do not have permission to install plugins.', 'shop-toolkit'));
        }
        
        $recommended_plugins = $this->get_recommended_plugins();
        $results = array();
        $success_count = 0;
        $total_count = count($recommended_plugins);
        
        foreach ($recommended_plugins as $slug => $plugin) {
            $status = $this->get_plugin_status($plugin);
            
            if ($status === 'active') {
                $results[$slug] = 'already-active';
                $success_count++;
            } else {
                $installed = $this->install_and_activate_plugin($plugin);
                
                if ($installed) {
                    $results[$slug] = 'installed-and-activated';
                    $success_count++;
                } else {
                    $results[$slug] = 'failed';
                }
            }
        }
        
        if ($success_count === $total_count) {
            wp_send_json_success(array(
                'message' => sprintf(__('%d recommended plugins installed and activated successfully.', 'shop-toolkit'), $success_count),
                'results' => $results
            ));
        } else {
            wp_send_json_error(array(
                'message' => sprintf(__('%d of %d recommended plugins installed successfully.', 'shop-toolkit'), $success_count, $total_count),
                'results' => $results
            ));
        }
    }
    
    /**
     * AJAX handler to check if all recommended plugins are active
     */
    public function ajax_check_recommended_plugins_status() {
        check_ajax_referer('blog_build_plugins_nonce', 'nonce');
        
        $all_active = $this->are_all_recommended_plugins_active();
        
        wp_send_json_success(array(
            'all_active' => $all_active,
            'message' => $all_active ? __('All recommended plugins are active!', 'shop-toolkit') : __('Some recommended plugins are not active.', 'shop-toolkit')
        ));
    }
    
    /**
     * Show recommendation notice in admin
     */
    public function show_recommendation_notice() {
        $screen = get_current_screen();
        
        // Only show on dashboard, themes, and plugins pages
        if (!in_array($screen->id, array('dashboard', 'themes', 'plugins', 'appearance_page_blog-build-plugins'))) {
            return;
        }
        
        // Check if there are any missing required plugins
        $missing_required = array();
        $required_plugins = $this->get_required_plugins();
        
        foreach ($required_plugins as $slug => $plugin) {
            if ($this->get_plugin_status($plugin) !== 'active') {
                $missing_required[$slug] = $plugin;
            }
        }
        
        // Show REQUIRED plugins notice (non-dismissible) only if there are missing plugins
        if (!empty($missing_required)) {
            ?>
            <div class="notice notice-warning blog-build-pro-required-notice">
                <p>
                    <strong><?php esc_html_e('Shop Toolkit Pro Theme', 'shop-toolkit'); ?></strong> - 
                    <?php printf(esc_html__('%d required plugins are missing. Please install them for optimal theme functionality.', 'shop-toolkit'), count($missing_required)); ?>
                    <br><br>
                    <button id="install-required-plugins" class="button button-primary" style="margin-right: 10px;">
                        <?php esc_html_e('Install Required Plugins', 'shop-toolkit'); ?>
                    </button>
                    <a href="<?php echo esc_url(admin_url('themes.php?page=blog-build-plugins')); ?>" class="button button-secondary">
                        <?php esc_html_e('View All Plugins', 'shop-toolkit'); ?>
                    </a>
                </p>
            </div>
            <?php
        }
        
        // Show recommended plugins notice (dismissible) only on dashboard and themes pages
        if (in_array($screen->id, array('dashboard', 'themes', 'plugins'))) {
            $this->show_recommended_plugins_notice();
        }
    }
    
    /**
     * Show recommended plugins notice (dismissible)
     */
    private function show_recommended_plugins_notice() {
        // Check if user dismissed the recommended plugins notice
        $dismissed_time = get_user_meta(get_current_user_id(), 'blog_build_hide_recommended_notice_time', true);
        $show_recommended_notice = !$dismissed_time || (time() - $dismissed_time) >= (30 * 24 * 60 * 60); // 30 days
        
        if (!$show_recommended_notice) {
            return;
        }
        
        // Check if all recommended plugins are active
        if ($this->are_all_recommended_plugins_active()) {
            return;
        }
        
        // Get recommended plugins that are not active
        $recommended_plugins = $this->get_recommended_plugins();
        $inactive_recommended = array();
        
        foreach ($recommended_plugins as $slug => $plugin) {
            if (!$plugin['required'] && $this->get_plugin_status($plugin) !== 'active') {
                $inactive_recommended[$slug] = $plugin;
            }
        }
        
        if (empty($inactive_recommended)) {
            return;
        }
        
        ?>
        <div class="notice notice-info is-dismissible blog-build-pro-recommended-notice">
            <div class="plugin-recommended-content">
                <div style="flex: 1;">
                    <h3><?php esc_html_e('Recommended Plugins for Shop Toolkit Pro', 'shop-toolkit'); ?></h3>
                    <p><?php printf(esc_html__('We recommend %d additional plugins to enhance your Shop Toolkit Pro theme experience.', 'shop-toolkit'), count($inactive_recommended)); ?></p>
                    <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap; margin-top: 15px;">
                        <button id="install-recommended-plugins" class="button button-primary"><?php esc_html_e('Install Recommended Plugins', 'shop-toolkit'); ?></button>
                        <a href="<?php echo esc_url(admin_url('themes.php?page=blog-build-plugins')); ?>" class="button button-secondary"><?php esc_html_e('View All Plugins', 'shop-toolkit'); ?></a>
                    </div>
                </div>
                <div class="plugin-icon-recomend">🔌</div>
            </div>
        </div>
        <?php
    }
    
    /**
     * Auto-install required plugins on theme activation
     */
    public function auto_install_required_plugins() {
        // Check if we have permission to install plugins
        if (!current_user_can('install_plugins')) {
            return;
        }
        
        // Get all required plugins
        $required_plugins = $this->get_required_plugins();
        
        if (empty($required_plugins)) {
            return;
        }
        
        // Set a flag to indicate we've processed theme activation
        set_transient('blog_build_theme_activated', true, 30);
        
        // Install and activate required plugins
        foreach ($required_plugins as $plugin) {
            $this->install_and_activate_plugin($plugin);
        }
        
        // Set a notice that plugins were installed
        set_transient('blog_build_plugins_installed', true, 300);
    }
    
    /**
     * Check for required plugins on admin init
     */
    public function check_required_plugins() {
        // Only check if user can install plugins
        if (!current_user_can('install_plugins')) {
            return;
        }
        
        // Only check once per session to avoid performance issues
        if (get_transient('blog_build_plugins_checked')) {
            return;
        }
        
        // Set transient to avoid repeated checks
        set_transient('blog_build_plugins_checked', true, 3600); // 1 hour
        
        // Get required plugins
        $required_plugins = $this->get_required_plugins();
        
        if (empty($required_plugins)) {
            return;
        }
        
        // Check each required plugin
        foreach ($required_plugins as $plugin) {
            $status = $this->get_plugin_status($plugin);
            
            if ($status === 'not-installed') {
                $this->install_and_activate_plugin($plugin);
            } elseif ($status === 'inactive') {
                $this->activate_plugin_silent($plugin);
            }
        }
    }
    
    /**
     * Get only required plugins
     */
    private function get_required_plugins() {
        $all_plugins = $this->get_recommended_plugins();
        $required_plugins = array();
        
        foreach ($all_plugins as $slug => $plugin) {
            if (isset($plugin['required']) && $plugin['required'] === true) {
                $required_plugins[$slug] = $plugin;
            }
        }
        
        return $required_plugins;
    }
    
    /**
     * Install and activate a plugin silently
     */
    private function install_and_activate_plugin($plugin) {
        // Check if plugin is already active
        if ($this->get_plugin_status($plugin) === 'active') {
            return true;
        }
        
        // Install plugin if not installed
        if ($this->get_plugin_status($plugin) === 'not-installed') {
            $installed = $this->install_plugin_silent($plugin);
            if (!$installed) {
                return false;
            }
        }
        
        // Activate plugin
        return $this->activate_plugin_silent($plugin);
    }
    
    /**
     * Install plugin silently
     */
    private function install_plugin_silent($plugin) {
        try {
            // Load the silent upgrader skin class
            blog_build_load_silent_upgrader_skin();
            
            // Handle local plugin installation
            if ($this->is_local_plugin($plugin)) {
                return $this->install_local_plugin($plugin);
            }
            
            // Handle WordPress.org plugin installation
            return $this->install_wordpress_org_plugin($plugin);
            
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Install local plugin from zip file
     */
    private function install_local_plugin($plugin) {
        error_log('Shop Toolkit Pro: Starting local plugin installation for: ' . $plugin['name']);
        
        // Basic checks
        if (!isset($plugin['source']) || !file_exists($plugin['source'])) {
            error_log('Shop Toolkit Pro: Source file missing: ' . (isset($plugin['source']) ? $plugin['source'] : 'not set'));
            return false;
        }
        
        if (!class_exists('ZipArchive')) {
            error_log('Shop Toolkit Pro: ZipArchive not available');
            return false;
        }
        
        if (!is_writable(WP_PLUGIN_DIR)) {
            error_log('Shop Toolkit Pro: Plugin directory not writable: ' . WP_PLUGIN_DIR);
            return false;
        }
        
        $plugin_file_path = WP_PLUGIN_DIR . '/' . $plugin['file'];
        if (file_exists($plugin_file_path)) {
            error_log('Shop Toolkit Pro: Plugin already exists: ' . $plugin_file_path);
            return true;
        }
        
        error_log('Shop Toolkit Pro: Source file: ' . $plugin['source'] . ' (size: ' . filesize($plugin['source']) . ')');
        
        // Use a simple direct extraction approach
        $zip = new ZipArchive();
        $open_result = $zip->open($plugin['source']);
        
        if ($open_result !== TRUE) {
            error_log('Shop Toolkit Pro: Cannot open zip file. Error: ' . $open_result);
            return false;
        }
        
        error_log('Shop Toolkit Pro: Zip opened. Files: ' . $zip->numFiles);
        
        // Log first few files to debug structure
        for ($i = 0; $i < min(3, $zip->numFiles); $i++) {
            $file_info = $zip->statIndex($i);
            error_log('Shop Toolkit Pro: File[' . $i . ']: ' . $file_info['name']);
        }
        
        // Extract directly to plugins directory
        $extract_result = $zip->extractTo(WP_PLUGIN_DIR);
        $zip->close();
        
        if (!$extract_result) {
            error_log('Shop Toolkit Pro: Extraction failed');
            return false;
        }
        
        error_log('Shop Toolkit Pro: Extraction successful');
        
        // Check if the expected plugin file now exists
        if (file_exists($plugin_file_path)) {
            error_log('Shop Toolkit Pro: Plugin file found: ' . $plugin_file_path);
            return true;
        }
        
        // If not found, try to locate it
        error_log('Shop Toolkit Pro: Expected plugin file not found: ' . $plugin_file_path);
        
        // Look for any aakpro related directories
        $plugin_dirs = glob(WP_PLUGIN_DIR . '/aakpro*', GLOB_ONLYDIR);
        if (!empty($plugin_dirs)) {
            foreach ($plugin_dirs as $dir) {
                error_log('Shop Toolkit Pro: Found directory: ' . basename($dir));
                $files = glob($dir . '/*.php');
                foreach ($files as $file) {
                    error_log('Shop Toolkit Pro: Found PHP file: ' . basename($file));
                }
            }
        }
        
        return false;
    }
    
    /**
     * Install WordPress.org plugin
     */
    private function install_wordpress_org_plugin($plugin) {
        try {
            include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
            
            // Get plugin info from WordPress.org
            $api = plugins_api('plugin_information', array(
                'slug' => $plugin['slug'],
                'fields' => array(
                    'short_description' => false,
                    'sections' => false,
                    'requires' => false,
                    'rating' => false,
                    'ratings' => false,
                    'downloaded' => false,
                    'last_updated' => false,
                    'added' => false,
                    'tags' => false,
                    'compatibility' => false,
                    'homepage' => false,
                    'donate_link' => false,
                )
            ));
            
            if (is_wp_error($api)) {
                return false;
            }
            
            // Use a silent upgrader
            $upgrader = new Plugin_Upgrader(new Blog_Build_Pro_Silent_Upgrader_Skin());
            $install = $upgrader->install($api->download_link);
            
            return !is_wp_error($install) && $install;
            
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Update local plugin from zip file
     */
    private function update_local_plugin($plugin) {
        try {
            // Check if source file exists
            if (!isset($plugin['source']) || !file_exists($plugin['source'])) {
                return false;
            }
            
            // Deactivate plugin before update
            if (is_plugin_active($plugin['file'])) {
                deactivate_plugins($plugin['file'], true);
            }
            
            // Get plugin directory
            $plugin_dir = WP_PLUGIN_DIR . '/' . dirname($plugin['file']);
            
            // Remove existing plugin directory
            if (is_dir($plugin_dir)) {
                $this->delete_directory($plugin_dir);
            }
            
            // Extract new plugin
            $result = $this->extract_plugin_zip($plugin['source'], WP_PLUGIN_DIR);
            
            if ($result) {
                // Reactivate plugin
                activate_plugin($plugin['file'], '', false, true);
                return true;
            }
            
            return false;
            
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Update WordPress.org plugin
     */
    private function update_wordpress_org_plugin($plugin_file) {
        try {
            include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
            
            // Load the silent upgrader skin class
            blog_build_load_silent_upgrader_skin();
            
            $upgrader = new Plugin_Upgrader(new Blog_Build_Pro_Silent_Upgrader_Skin());
            $result = $upgrader->upgrade($plugin_file);
            
            return !is_wp_error($result) && $result;
            
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Activate plugin silently
     */
    private function activate_plugin_silent($plugin) {
        try {
            $result = activate_plugin($plugin['file'], '', false, true);
            return !is_wp_error($result);
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Extract plugin zip file
     */
    private function extract_plugin_zip($zip_file, $destination) {
        if (!class_exists('ZipArchive')) {
            error_log('Shop Toolkit Pro: ZipArchive class not available');
            return false;
        }
        
        if (!file_exists($zip_file)) {
            error_log('Shop Toolkit Pro: Zip file does not exist: ' . $zip_file);
            return false;
        }
        
        if (!is_readable($zip_file)) {
            error_log('Shop Toolkit Pro: Zip file is not readable: ' . $zip_file);
            return false;
        }
        
        $zip = new ZipArchive();
        $result = $zip->open($zip_file);
        
        if ($result !== TRUE) {
            $error_messages = array(
                ZipArchive::ER_OK => 'No error',
                ZipArchive::ER_MULTIDISK => 'Multi-disk zip archives not supported',
                ZipArchive::ER_RENAME => 'Renaming temporary file failed',
                ZipArchive::ER_CLOSE => 'Closing zip archive failed',
                ZipArchive::ER_SEEK => 'Seek error',
                ZipArchive::ER_READ => 'Read error',
                ZipArchive::ER_WRITE => 'Write error',
                ZipArchive::ER_CRC => 'CRC error',
                ZipArchive::ER_ZIPCLOSED => 'Containing zip archive was closed',
                ZipArchive::ER_NOENT => 'No such file',
                ZipArchive::ER_EXISTS => 'File already exists',
                ZipArchive::ER_OPEN => 'Can\'t open file',
                ZipArchive::ER_TMPOPEN => 'Failure to create temporary file',
                ZipArchive::ER_ZLIB => 'Zlib error',
                ZipArchive::ER_MEMORY => 'Memory allocation failure',
                ZipArchive::ER_CHANGED => 'Entry has been changed',
                ZipArchive::ER_COMPNOTSUPP => 'Compression method not supported',
                ZipArchive::ER_EOF => 'Premature EOF',
                ZipArchive::ER_INVAL => 'Invalid argument',
                ZipArchive::ER_NOZIP => 'Not a zip archive',
                ZipArchive::ER_INTERNAL => 'Internal error',
                ZipArchive::ER_INCONS => 'Zip archive inconsistent',
                ZipArchive::ER_REMOVE => 'Can\'t remove file',
                ZipArchive::ER_DELETED => 'Entry has been deleted',
            );
            
            $error_message = isset($error_messages[$result]) ? $error_messages[$result] : 'Unknown error';
            error_log('Shop Toolkit Pro: Failed to open zip file: ' . $zip_file . ' (Error code: ' . $result . ' - ' . $error_message . ')');
            return false;
        }
        
        // Log what's in the zip file for debugging
        error_log('Shop Toolkit Pro: Zip file contains ' . $zip->numFiles . ' files');
        for ($i = 0; $i < min($zip->numFiles, 10); $i++) {
            $file_info = $zip->statIndex($i);
            error_log('Shop Toolkit Pro: Zip file [' . $i . ']: ' . $file_info['name'] . ' (size: ' . $file_info['size'] . ')');
        }
        
        // Check if destination directory exists and is writable
        if (!is_dir($destination)) {
            error_log('Shop Toolkit Pro: Destination directory does not exist: ' . $destination);
            $zip->close();
            return false;
        }
        
        if (!is_writable($destination)) {
            error_log('Shop Toolkit Pro: Destination directory is not writable: ' . $destination);
            $zip->close();
            return false;
        }
        
        // Extract to destination
        $extract_result = $zip->extractTo($destination);
        $extract_error = $extract_result ? 'Success' : 'Failed';
        error_log('Shop Toolkit Pro: Extract result: ' . $extract_error . ' to ' . $destination);
        
        if (!$extract_result) {
            error_log('Shop Toolkit Pro: Extraction failed. Last error: ' . $zip->getStatusString());
        }
        
        $zip->close();
        
        if (!$extract_result) {
            error_log('Shop Toolkit Pro: Failed to extract zip file to: ' . $destination);
            return false;
        }
        
        // Verify that files were actually extracted
        $extracted_files = glob($destination . '/*');
        if (empty($extracted_files)) {
            error_log('Shop Toolkit Pro: No files found after extraction in: ' . $destination);
            return false;
        }
        
        error_log('Shop Toolkit Pro: Successfully extracted ' . count($extracted_files) . ' items to: ' . $destination);
        return true;
    }
    
    /**
     * Delete directory recursively
     */
    private function delete_directory($dir) {
        if (!is_dir($dir)) {
            return false;
        }
        
        $files = array_diff(scandir($dir), array('.', '..'));
        
        foreach ($files as $file) {
            $path = $dir . '/' . $file;
            if (is_dir($path)) {
                $this->delete_directory($path);
            } else {
                unlink($path);
            }
        }
        
        return rmdir($dir);
    }
    
    /**
     * Check if plugin installation/activation functions are available
     */
    private function check_plugin_functions() {
        if (!function_exists('is_plugin_active')) {
            include_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
    }
    
    /**
     * Migrate old notice dismissal to new system
     */
    private function migrate_notice_dismissal() {
        // Check if migration has already been done
        if (get_option('blog_build_notice_migration_done')) {
            return;
        }
        
        // Reset old dismissals for migration
        delete_user_meta(get_current_user_id(), 'blog_build_hide_required_plugins_notice');
        delete_user_meta(get_current_user_id(), 'blog_build_hide_recommended_plugins_notice');
        delete_user_meta(get_current_user_id(), 'blog_build_hide_update_notice_time');
        
        // Mark migration as done
        update_option('blog_build_notice_migration_done', true);
    }
    
    /**
     * Check if all recommended plugins are active
     */
    private function are_all_recommended_plugins_active() {
        $all_plugins = $this->get_recommended_plugins();
        
        foreach ($all_plugins as $plugin) {
            if ($this->get_plugin_status($plugin) !== 'active') {
                return false;
            }
        }
        
        return true;
    }
    
}

// Initialize the plugin recommendations
new Blog_Build_Pro_Plugin_Recommendations();

