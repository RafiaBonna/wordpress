<?php

/**
 * About setup
 *
 * @package Shop Toolkit
 */

require_once trailingslashit(get_template_directory()) . 'inc/about/class.about.php';

if (!function_exists('shop_toolkit_about_setup')) :

	/**
	 * About setup.
	 *
	 * @since 1.0.0
	 */
	function shop_toolkit_about_setup()
	{
		$theme = wp_get_theme();
		$xtheme_name = $theme->get('Name');
		$xtheme_domain = $theme->get('TextDomain');
		if ($xtheme_domain == 'x-magazine') {
			$theme_slug = $xtheme_domain;
		} else {
			$theme_slug = 'shop-toolkit';
		}



		$config = array(
			// Menu name under Appearance.
			'menu_name'               => sprintf(esc_html__('%s Info', 'shop-toolkit'), $xtheme_name),
			// Page title.
			'page_name'               => sprintf(esc_html__('%s Info', 'shop-toolkit'), $xtheme_name),
			/* translators: Main welcome title */
			'welcome_title'         => sprintf(esc_html__('Welcome to %s! - Version ', 'shop-toolkit'), $theme['Name']),
			// Main welcome content
			// Welcome content.
			'welcome_content' => sprintf(esc_html__('%1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we gathered here all the necessary information for you. Thanks for using our theme!', 'shop-toolkit'), $theme['Name']),

			// Tabs.
			'tabs' => array(
				'getting_started' => esc_html__('Getting Started', 'shop-toolkit'),
				'recommended_actions' => esc_html__('Recommended Actions', 'shop-toolkit'),
				'useful_plugins'  => esc_html__('Useful Plugins', 'shop-toolkit'),
				'free_pro'  => esc_html__('Free Vs Pro', 'shop-toolkit'),
			),

			// Quick links.
			'quick_links' => array(
				'xmagazine_url' => array(
					'text'   => esc_html__('UPGRADE SHOP TOOLKIT PRO', 'shop-toolkit'),
					'url'    => 'https://wpthemespace.com/product/shop-toolkit-pro/?add-to-cart=11510',
					'button' => 'danger',
				),
				'update_url' => array(
					'text'   => esc_html__('View demo', 'shop-toolkit'),
					'url'    => 'https://wpthemespace.com/shop-kit-demo/',
					'button' => 'primery',
				),
				/* 'video_url' => array(
					'text'   => esc_html__('Show Video', 'shop-toolkit'),
					'url'    => 'https://www.youtube.com/watch?v=ATu84uap_bc',
					'button' => 'danger',
				), */

			),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__('Demo Content', 'shop-toolkit'),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf(esc_html__('Demo content is pro feature. To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'shop-toolkit'), esc_html__('One Click Demo Import', 'shop-toolkit')),
					'button_text' => esc_html__('UPGRADE For  Demo Content', 'shop-toolkit'),
					'button_url'  => 'https://wpthemespace.com/product/shop-toolkit-pro/?add-to-cart=11510',
					'button_type' => 'primary',
					'is_new_tab'  => true,
				),

				'two' => array(
					'title'       => esc_html__('Theme Options', 'shop-toolkit'),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__('Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'shop-toolkit'),
					'button_text' => esc_html__('Customize', 'shop-toolkit'),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
				),
				'three' => array(
					'title'       => esc_html__('Show Video', 'shop-toolkit'),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf(esc_html__('You may show Shop Toolkit short video for better understanding', 'shop-toolkit'), esc_html__('One Click Demo Import', 'shop-toolkit')),
					'button_text' => esc_html__('Show video', 'shop-toolkit'),
					'button_url'  => 'https://www.youtube.com/watch?v=ATu84uap_bc',
					'button_type' => 'primary',
					'is_new_tab'  => true,
				),
				'five' => array(
					'title'       => esc_html__('Set Widgets', 'shop-toolkit'),
					'icon'        => 'dashicons dashicons-tagcloud',
					'description' => esc_html__('Set widgets in your sidebar, Offcanvas as well as footer.', 'shop-toolkit'),
					'button_text' => esc_html__('Add Widgets', 'shop-toolkit'),
					'button_url'  => admin_url() . '/widgets.php',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'six' => array(
					'title'       => esc_html__('Theme Preview', 'shop-toolkit'),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__('You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized. Theme demo only work in pro theme', 'shop-toolkit'),
					'button_text' => esc_html__('View Demo', 'shop-toolkit'),
					'button_url'  => 'https://wpthemespace.com/shop-kit-demo/',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'seven' => array(
					'title'       => esc_html__('Contact Support', 'shop-toolkit'),
					'icon'        => 'dashicons dashicons-sos',
					'description' => esc_html__('Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'shop-toolkit'),
					'button_text' => esc_html__('Contact Support', 'shop-toolkit'),
					'button_url'  => 'https://wpthemespace.com/support/',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
			),

			'useful_plugins'        => array(
				'description' => esc_html__('Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'shop-toolkit'),
				'already_activated_message' => esc_html__('Already activated', 'shop-toolkit'),
				'version_label' => esc_html__('Version: ', 'shop-toolkit'),
				'install_label' => esc_html__('Install and Activate', 'shop-toolkit'),
				'activate_label' => esc_html__('Activate', 'shop-toolkit'),
				'deactivate_label' => esc_html__('Deactivate', 'shop-toolkit'),
				'content'                   => array(
					array(
						'slug' => 'magical-addons-for-elementor',
						'icon' => 'svg',
					),
					array(
						'slug' => 'magical-products-display'
					),
					array(
						'slug' => 'magical-posts-display'
					),
					array(
						'slug' => 'click-to-top'
					),
					array(
						'slug' => 'gallery-box',
						'icon' => 'svg',
					),
					array(
						'slug' => 'magical-blocks'
					),
					array(
						'slug' => 'easy-share-solution',
						'icon' => 'svg',
					),
					array(
						'slug' => 'wp-edit-password-protected',
						'icon' => 'svg',
					),
				),
			),
			// Required actions array.
			'recommended_actions'        => array(
				'install_label' => esc_html__('Install and Activate', 'shop-toolkit'),
				'activate_label' => esc_html__('Activate', 'shop-toolkit'),
				'deactivate_label' => esc_html__('Deactivate', 'shop-toolkit'),
				'content'            => array(
					'magical-blocks' => array(
						'title'       => __('Magical Posts Display', 'shop-toolkit'),
						'description' => __('Now you can add or update your site elements very easily by Magical Products Display. Supercharge your Elementor block with highly customizable Magical Blocks For WooCommerce.', 'shop-toolkit'),
						'plugin_slug' => 'magical-products-display',
						'id' => 'magical-posts-display'
					),
					'go-pro' => array(
						'title'       => '<a target="_blank" class="activate-now button button-danger" href="https://wpthemespace.com/product/shop-toolkit-pro/?add-to-cart=11510">' . __('UPGRADE SHOP TOOLKIT PRO', 'shop-toolkit') . '</a>',
						'description' => __('You will get more frequent updates and quicker support with the Pro version.', 'shop-toolkit'),
						//'plugin_slug' => 'x-instafeed',
						'id' => 'go-pro'
					),

				),
			),
			// Free vs pro array.
			'free_pro'                => array(
				'free_theme_name'     => $xtheme_name,
				'pro_theme_name'      => $xtheme_name . __(' Pro', 'shop-toolkit'),
				'pro_theme_link'      => 'https://wpthemespace.com/product/shop-toolkit-pro/',
				/* translators: View link */
				'get_pro_theme_label' => sprintf(__('Get %s', 'shop-toolkit'), 'Shop Toolkit Pro'),
				'features'            => array(
					array(
						'title'       => esc_html__('Daring Design for Devoted Readers', 'shop-toolkit'),
						'description' => esc_html__('Shop Toolkit \'s design helps you stand out from the crowd and create an experience that your readers will love and talk about. With a flexible home page you have the chance to easily showcase appealing content with ease.', 'shop-toolkit'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Mobile-Ready For All Devices', 'shop-toolkit'),
						'description' => esc_html__('Shop Toolkit makes room for your readers to enjoy your articles on the go, no matter the device their using. We shaped everything to look amazing to your audience.', 'shop-toolkit'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Home slider', 'shop-toolkit'),
						'description' => esc_html__('Shop Toolkit gives you extra slider feature. You can create awesome home slider in this theme.', 'shop-toolkit'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Widgetized Sidebars To Keep Attention', 'shop-toolkit'),
						'description' => esc_html__('Shop Toolkit comes with a widget-based flexible system which allows you to add your favorite widgets over the Sidebar as well as on offcanvas too.', 'shop-toolkit'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Auto Set-up Feature', 'shop-toolkit'),
						'description' => esc_html__('You can import demo site only one click so you can setup your site like demo very easily.', 'shop-toolkit'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Multiple Header Layout', 'shop-toolkit'),
						'description' => esc_html__('Shop Toolkit gives you extra ways to showcase your header with miltiple layout option you can change it on the basis of your requirement', 'shop-toolkit'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('One Click Demo install', 'shop-toolkit'),
						'description' => esc_html__('You can import demo site only one click so you can setup your site like demo very easily.', 'shop-toolkit'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Extra Drag and drop support', 'shop-toolkit'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advanced Portfolio Filter', 'shop-toolkit'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Testimonial Carousel', 'shop-toolkit'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Diffrent Style Blog', 'shop-toolkit'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Flexible Home Page Design', 'shop-toolkit'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Pro Service Section', 'shop-toolkit'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Animation Home Text', 'shop-toolkit'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advance Customizer Options', 'shop-toolkit'),
						'description' => esc_html__('Advance control for each element gives you different way of customization and maintained you site as you like and makes you feel different.', 'shop-toolkit'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advance Pagination', 'shop-toolkit'),
						'description' => esc_html__('Multiple Option of pagination via customizer can be obtained on your site like Infinite scroll, Ajax Button On Click, Number as well as classical option are available.', 'shop-toolkit'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),

					array(
						'title'       => esc_html__('Premium Support and Assistance', 'shop-toolkit'),
						'description' => esc_html__('We offer ongoing customer support to help you get things done in due time. This way, you save energy and time, and focus on what brings you happiness. We know our products inside-out and we can lend a hand to help you save resources of all kinds.', 'shop-toolkit'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('No Credit Footer Link', 'shop-toolkit'),
						'description' => esc_html__('You can easily remove the Theme: Shop Toolkit by Shop Toolkit copyright from the footer area and make the theme yours from start to finish.', 'shop-toolkit'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
				),
			),

		);

		shop_toolkit_About::init($config);
	}

endif;

add_action('after_setup_theme', 'shop_toolkit_about_setup');

/**
 * Pro notice text
 *
 */
function shop_toolkit_pnotice_output()
{
?>
	<div class="mgadin-hero">
		<div class="mge-info-content">
			<div class="mge-info-hello">
				<?php
				$current_theme = wp_get_theme();
				$current_theme_name = $current_theme->get('Name');
				$current_user = wp_get_current_user();

				if ($current_theme_name == 'Furniture Shop Toolkit') {
					$demo_link = esc_url('https://wpthemespace.com/product/furniture-shop-toolkit-pro/');
					$pro_furniture_link = esc_url('https://wpthemespace.com/product/furniture-shop-toolkit-pro/?add-to-cart=12027');
				} else {
					$demo_link = esc_url('https://wpthemespace.com/product/shop-toolkit-pro/');
				}
				$pro_link = esc_url('https://wpthemespace.com/product/shop-toolkit-pro/?add-to-cart=11720');

				esc_html_e('Hello, ', 'shop-toolkit');
				echo esc_html($current_user->display_name);
				?>

				<?php esc_html_e('👋🏻', 'shop-toolkit'); ?>
			</div>
			<div class="mge-info-desc">
				<div><strong><?php esc_html_e('🚀 Ready to 10x Your Online Store?', 'shop-toolkit'); ?></strong></div>
				<div><?php
						printf(
							esc_html__('You\'re using %s Free - that\'s awesome! But imagine having  premium templates, lightning-fast one-click demos, advanced WooCommerce features, and priority support. Our Pro customers see 3x faster setup times and higher conversion rates. Limited time: Get 30%% OFF + Premium Support for Life!', 'shop-toolkit'),
							esc_html($current_theme_name)
						);
						?></div>
				<div class="mge-offer"><strong><?php esc_html_e('⏰ Special Offer: Save 30% Today Only - Your Competitors Are Already Using Pro!', 'shop-toolkit'); ?></strong></div>
				<div class="mge-features">
					<span class="feature-item">✅ <?php esc_html_e(' Premium Templates', 'shop-toolkit'); ?></span>
					<span class="feature-item">✅ <?php esc_html_e('One-Click Demo Import', 'shop-toolkit'); ?></span>
					<span class="feature-item">✅ <?php esc_html_e('Advanced WooCommerce Features', 'shop-toolkit'); ?></span>
					<span class="feature-item">✅ <?php esc_html_e('Priority Support', 'shop-toolkit'); ?></span>
				</div>
			</div>
			<div class="mge-info-actions">
				<?php
				if ($current_theme_name == 'Furniture Shop Toolkit'):
				?>
					<a href="<?php echo esc_url($pro_furniture_link); ?>" target="_blank" class="button button-primary upgrade-btn upgrade-primary">
						🚀 <?php esc_html_e('Get 30% OFF - Upgrade Furniture Pro Now!', 'shop-toolkit'); ?>
					</a>
				<?php endif; ?>
				<a href="<?php echo esc_url($pro_link); ?>" target="_blank" class="button button-primary upgrade-btn upgrade-primary">
					🚀 <?php esc_html_e('Get 30% OFF - Upgrade Shop Toolkit Pro Now!', 'shop-toolkit'); ?>
				</a>
				<a href="<?php echo esc_url($demo_link); ?>" target="_blank" class="button button-secondary demo-btn">
					👀 <?php esc_html_e('See Live Demo', 'shop-toolkit'); ?>
				</a>
				<button class="button button-link btnend"><?php esc_html_e('Maybe Later', 'shop-toolkit') ?></button>
			</div>

		</div>

	</div>
<?php
}
//Admin notice 
function shop_toolkit_new_optins_texts()
{
	// Check if user has permission to see admin notices
	if (!current_user_can('manage_options')) {
		return;
	}
	
	$hide_date = get_option(' shop_toolkit_proinfo_text');
	if (!empty($hide_date)) {
		$clickhide = round((time() - strtotime($hide_date)) / 24 / 60 / 60);
		if ($clickhide < 25) {
			return;
		}
	}
?>
	<div class="mgad-notice notice notice-info mgadin-theme-dashboard mgadin-theme-dashboard-notice mge is-dismissible meis-dismissible">
		<?php shop_toolkit_pnotice_output(); ?>
	</div>
<?php

}
add_action('admin_notices', 'shop_toolkit_new_optins_texts');

function shop_toolkit_new_optins_texts_init()
{
	$shop_toolkit_install_date = get_option('shop_toolkit_install_date');
	if (empty($shop_toolkit_install_date)) {
		update_option('shop_toolkit_install_date', current_time('mysql'));
	}
	
	// Handle notice dismissal with proper nonce verification
	if (isset($_GET['xbnotice']) && $_GET['xbnotice'] == '1') {
		// Check if nonce exists and verify it
		if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'dismiss_notice')) {
			// Valid nonce - dismiss the notice
			update_option(' shop_toolkit_proinfo_text', current_time('mysql'));
			// Redirect to clean URL after dismissal
			wp_redirect(remove_query_arg(array('xbnotice', '_wpnonce')));
			exit;
		} elseif (isset($_GET['_wpnonce'])) {
			// Nonce exists but is invalid - don't dismiss, just redirect
			wp_redirect(remove_query_arg(array('xbnotice', '_wpnonce')));
			exit;
		} else {
			// No nonce provided - for backward compatibility, still dismiss
			update_option(' shop_toolkit_proinfo_text', current_time('mysql'));
			wp_redirect(remove_query_arg('xbnotice'));
			exit;
		}
	}
}
add_action('init', 'shop_toolkit_new_optins_texts_init');

/**
 * Add upgrade link to admin topbar
 */
function shop_toolkit_admin_bar_upgrade_link($wp_admin_bar)
{
	// Only show to users who can manage options
	if (!current_user_can('manage_options')) {
		return;
	}

	// Get current theme info
	$current_theme = wp_get_theme();
	$current_theme_name = $current_theme->get('Name');
	
	// Check if this is Shop Toolkit theme (more flexible check)
	if (strpos(strtolower($current_theme_name), 'shop') === false && 
	    strpos(strtolower($current_theme_name), 'toolkit') === false) {
		return;
	}

	// Ensure install date is set
	$install_date = get_option('shop_toolkit_install_date');
	if (empty($install_date)) {
		update_option('shop_toolkit_install_date', current_time('mysql'));
	}

	// Check dismiss status (show after 7 days if dismissed)
	$hide_date = get_option(' shop_toolkit_proinfo_text');
	if (!empty($hide_date)) {
		$days_since_dismiss = round((time() - strtotime($hide_date)) / 24 / 60 / 60);
		if ($days_since_dismiss < 7) {
			return;
		}
	}

	// Set pro link based on theme
	$pro_link = 'https://wpthemespace.com/product/shop-toolkit-pro/?add-to-cart=11720';
	if ($current_theme_name == 'Furniture Shop Toolkit') {
		$pro_link = 'https://wpthemespace.com/product/furniture-shop-toolkit-pro/?add-to-cart=12027';
	}

	// Add the menu item
	$wp_admin_bar->add_menu(array(
		'id'    => 'shop-toolkit-upgrade',
		'title' => '<span style="color: #00d084; font-weight: bold;">🚀 ' . esc_html__('Upgrade to Pro (30% OFF)', 'shop-toolkit') . '</span>',
		'href'  => esc_url($pro_link),
		'meta'  => array(
			'target' => '_blank',
			'title'  => esc_attr__('Upgrade to Shop Toolkit Pro - Limited Time 30% OFF!', 'shop-toolkit'),
		),
	));
}
add_action('admin_bar_menu', 'shop_toolkit_admin_bar_upgrade_link', 999);
