<?php
/**
 * Theme Page
 *
 * @package Jewellery Boutique
 */

if ( ! defined( 'JEWELLERY_BOUTIQUE_FREE_THEME_URL' ) ) {
	define( 'JEWELLERY_BOUTIQUE_FREE_THEME_URL', 'https://www.seothemesexpert.com/products/jewellery-boutique-theme' );
}
if ( ! defined( 'JEWELLERY_BOUTIQUE_PRO_THEME_URL' ) ) {
	define( 'JEWELLERY_BOUTIQUE_PRO_THEME_URL', 'https://www.seothemesexpert.com/products/jewellery-website-template' );
}
if ( ! defined( 'JEWELLERY_BOUTIQUE_FREE_DOCS_THEME_URL' ) ) {
    define( 'JEWELLERY_BOUTIQUE_FREE_DOCS_THEME_URL', 'https://demo.seothemesexpert.com/documentation/jewellery-boutique/' );
}
if ( ! defined( 'JEWELLERY_BOUTIQUE_DEMO_THEME_URL' ) ) {
	define( 'JEWELLERY_BOUTIQUE_DEMO_THEME_URL', 'https://demo.seothemesexpert.com/jewellery-boutique/' );
}
if ( ! defined( 'JEWELLERY_BOUTIQUE_RATE_THEME_URL' ) ) {
    define( 'JEWELLERY_BOUTIQUE_RATE_THEME_URL', 'https://wordpress.org/support/theme/jewellery-boutique/reviews/#new-post' );
}
if ( ! defined( 'JEWELLERY_BOUTIQUE_SUPPORT_THEME_URL' ) ) {
    define( 'JEWELLERY_BOUTIQUE_SUPPORT_THEME_URL', 'https://wordpress.org/support/theme/jewellery-boutique/' );
}
if ( ! defined( 'JEWELLERY_BOUTIQUE_THEME_BUNDLE_URL' ) ) {
    define( 'JEWELLERY_BOUTIQUE_THEME_BUNDLE_URL', 'https://www.seothemesexpert.com/products/wordpress-theme-bundle' );
}

/**
 * Add theme page
 */
function jewellery_boutique_menu() {
	add_theme_page( esc_html__( 'About Theme', 'jewellery-boutique' ), esc_html__( 'About Theme', 'jewellery-boutique' ), 'edit_theme_options', 'jewellery-boutique-about', 'jewellery_boutique_about_display' );
}
add_action( 'admin_menu', 'jewellery_boutique_menu' );

/**
 * Display About page
 */
function jewellery_boutique_about_display() { ?>
	<div class="wrap about-wrap full-width-layout">	
		<h1 class="d-none"></h1>
		<nav class="nav-tab-wrapper wp-clearfix" aria-label="<?php esc_attr_e( 'Secondary menu', 'jewellery-boutique' ); ?>">
			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'jewellery-boutique-about' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['page'] ) && 'jewellery-boutique-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'About', 'jewellery-boutique' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'jewellery-boutique-about', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Compare free Vs Pro', 'jewellery-boutique' ); ?></a>
		</nav>

		<?php
			jewellery_boutique_main_screen();

			jewellery_boutique_free_vs_pro();
		?>

		<div class="return-to-dashboard">
			<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
				<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
					<?php is_multisite() ? esc_html_e( 'Return to Updates', 'jewellery-boutique' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'jewellery-boutique' ); ?>
				</a> |
			<?php endif; ?>
			<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'jewellery-boutique' ) : esc_html_e( 'Go to Dashboard', 'jewellery-boutique' ); ?></a>
		</div>
	</div>
	<?php
}

/**
 * Output the main about screen.
 */
function jewellery_boutique_main_screen() {
	if ( isset( $_GET['page'] ) && 'jewellery-boutique-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) {
	?>
		<div class="main-col-box">
			<div class="feature-section two-col">
				<div class="card">
					<h2 class="title"><?php esc_html_e( 'Upgrade To Pro', 'jewellery-boutique' ); ?></h2>
					<p><?php esc_html_e( 'Take a step towards excellence, try our premium theme. Use Code', 'jewellery-boutique' ) ?><span class="usecode"><?php esc_html_e( '" STEPRO10 "', 'jewellery-boutique' ); ?></span></p>
					<p><a target="_blank" href="<?php echo esc_url( JEWELLERY_BOUTIQUE_PRO_THEME_URL ); ?>" class="button button-primary"><?php esc_html_e( 'Upgrade Pro', 'jewellery-boutique' ); ?></a></p>
				</div>

				<div class="card">
					<h2 class="title"><?php esc_html_e( 'Lite Documentation', 'jewellery-boutique' ); ?></h2>
					<p><?php esc_html_e( 'The free theme documentation can help you set up the theme.', 'jewellery-boutique' ) ?></p>
					<p><a target="_blank" href="<?php echo esc_url( JEWELLERY_BOUTIQUE_FREE_DOCS_THEME_URL ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Lite Documentation', 'jewellery-boutique' ); ?></a></p>
				</div>

				<div class="card">
					<h2 class="title"><?php esc_html_e( 'Theme Info', 'jewellery-boutique' ); ?></h2>
					<p><?php esc_html_e( 'Know more about Jewellery Boutique.', 'jewellery-boutique' ) ?></p>
					<p><a target="_blank" href="<?php echo esc_url( JEWELLERY_BOUTIQUE_FREE_THEME_URL ); ?>" class="button button-primary"><?php esc_html_e( 'Theme Info', 'jewellery-boutique' ); ?></a></p>
				</div>

				<div class="card">
					<h2 class="title"><?php esc_html_e( 'Theme Customizer', 'jewellery-boutique' ); ?></h2>
					<p><?php esc_html_e( 'You can get all theme options in customizer.', 'jewellery-boutique' ) ?></p>
					<p><a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Customize', 'jewellery-boutique' ); ?></a></p>
				</div>

				<div class="card">
					<h2 class="title"><?php esc_html_e( 'Need Support?', 'jewellery-boutique' ); ?></h2>
					<p><?php esc_html_e( 'If you are having some issues with the theme or you want to tweak some thing, you can contact us our expert team will help you.', 'jewellery-boutique' ) ?></p>
					<p><a target="_blank" href="<?php echo esc_url( JEWELLERY_BOUTIQUE_SUPPORT_THEME_URL ); ?>" class="button button-primary"><?php esc_html_e( 'Support Forum', 'jewellery-boutique' ); ?></a></p>
				</div>

				<div class="card">
					<h2 class="title"><?php esc_html_e( 'Review', 'jewellery-boutique' ); ?></h2>
					<p><?php esc_html_e( 'If you have loved our theme please show your support with the review.', 'jewellery-boutique' ) ?></p>
					<p><a target="_blank" href="<?php echo esc_url( JEWELLERY_BOUTIQUE_RATE_THEME_URL ); ?>" class="button button-primary"><?php esc_html_e( 'Rate Us', 'jewellery-boutique' ); ?></a></p>
				</div>		
			</div>
			<div class="about-theme">
				<?php $jewellery_boutique_theme = wp_get_theme(); ?>

				<h1><?php echo esc_html( $jewellery_boutique_theme ); ?></h1>
				<p class="version"><?php esc_html_e( 'Version', 'jewellery-boutique' ); ?>: <?php echo esc_html($jewellery_boutique_theme['Version']);?></p>
				<div class="theme-description">
					<p class="actions">
						<a target="_blank" href="<?php echo esc_url( JEWELLERY_BOUTIQUE_PRO_THEME_URL ); ?>" class="protheme button button-secondary" target="_blank"><?php esc_html_e( 'Upgrade to pro', 'jewellery-boutique' ); ?></a>

						<a target="_blank" href="<?php echo esc_url( JEWELLERY_BOUTIQUE_DEMO_THEME_URL ); ?>" class="demo button button-secondary" target="_blank"><?php esc_html_e( 'View Demo', 'jewellery-boutique' ); ?></a>

						<a target="_blank" href="<?php echo esc_url( JEWELLERY_BOUTIQUE_THEME_BUNDLE_URL ); ?>" class="bundle button button-secondary" target="_blank"><?php esc_html_e( 'Buy All Themes', 'jewellery-boutique' ); ?></a>

						<a target="_blank" href="<?php echo esc_url( JEWELLERY_BOUTIQUE_FREE_DOCS_THEME_URL ); ?>" class="docs button button-secondary" target="_blank"><?php esc_html_e( 'Theme Instructions', 'jewellery-boutique' ); ?></a>
					</p>
				</div>
				<div class="theme-screenshot">
					<img src="<?php echo esc_url( $jewellery_boutique_theme->get_screenshot() ); ?>" />
				</div>
			</div>
		</div>
	<?php
	}
}

/**
 * Import Demo data for theme using catch themes demo import plugin
 */
function jewellery_boutique_free_vs_pro() {
	if ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) {
	?>
		<div class="wrap about-wrap">

			<div class="theme-description">
				<p class="actions">
					<a target="_blank" href="<?php echo esc_url( JEWELLERY_BOUTIQUE_PRO_THEME_URL ); ?>" class="protheme button button-secondary" target="_blank"><?php esc_html_e( 'Upgrade to pro', 'jewellery-boutique' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( JEWELLERY_BOUTIQUE_DEMO_THEME_URL ); ?>" class="demo button button-secondary" target="_blank"><?php esc_html_e( 'View Demo', 'jewellery-boutique' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( JEWELLERY_BOUTIQUE_THEME_BUNDLE_URL ); ?>" class="bundle button button-secondary" target="_blank"><?php esc_html_e( 'Buy All Themes', 'jewellery-boutique' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( JEWELLERY_BOUTIQUE_FREE_DOCS_THEME_URL ); ?>" class="docs button button-secondary" target="_blank"><?php esc_html_e( 'Theme Instructions', 'jewellery-boutique' ); ?></a>
				</p>
			</div>
			<p class="about-description"><?php esc_html_e( 'View Free vs Pro Table below:', 'jewellery-boutique' ); ?></p>
			<div class="vs-theme-table">
				<table>
					<thead>
						<tr><th scope="col"></th>
							<th class="head" scope="col"><?php esc_html_e( 'Free Theme', 'jewellery-boutique' ); ?></th>
							<th class="head" scope="col"><?php esc_html_e( 'Pro Theme', 'jewellery-boutique' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><span><?php esc_html_e( 'One click demo import', 'jewellery-boutique' ); ?></span></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Color pallete and font options', 'jewellery-boutique' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Demo Content has 8 to 10 sections', 'jewellery-boutique' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Rearrange sections as per your need', 'jewellery-boutique' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Internal Pages', 'jewellery-boutique' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Plugin Integration', 'jewellery-boutique' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Ultimate technical support', 'jewellery-boutique' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Access our Support Forums', 'jewellery-boutique' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Get regular updates', 'jewellery-boutique' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Install theme on unlimited domains', 'jewellery-boutique' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Mobile Responsive', 'jewellery-boutique' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Easy Customization', 'jewellery-boutique' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td class="feature feature--empty"></td>
							<td class="feature feature--empty"></td>
							<td headers="comp-2" class="td-btn-2"><a target="_blank" class="sidebar-button single-btn protheme button button-secondary" href="<?php echo esc_url(JEWELLERY_BOUTIQUE_PRO_THEME_URL);?>"><?php esc_html_e( 'Go for Premium', 'jewellery-boutique' ); ?></a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	<?php
	}
}
