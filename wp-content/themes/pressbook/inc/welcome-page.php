<?php
/**
 * Theme page and welcome notice.
 *
 * @package PressBook
 */

/**
 * Adds a theme menu page.
 */
function pressbook_create_menu() {
	$pressbook_page = add_theme_page(
		esc_html( apply_filters( 'pressbook_welcome_page_title', _x( 'PressBook', 'page title', 'pressbook' ) ) ),
		esc_html( apply_filters( 'pressbook_welcome_menu_title', _x( 'PressBook', 'menu title', 'pressbook' ) ) ),
		'edit_theme_options',
		'pressbook-options',
		'pressbook_page'
	);
	add_action( 'admin_print_styles-' . $pressbook_page, 'pressbook_options_styles' );
}
add_action( 'admin_menu', 'pressbook_create_menu' );

if ( ! function_exists( 'pressbook_page' ) ) {
	/**
	 * Builds the content of the theme page.
	 */
	function pressbook_page() {
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="pressbook-panel">
					<div class="pressbook-container pressbook-title-wrap">
						<div class="pressbook-title">
							<?php
							printf(
								wp_kses(
									/* translators: 1: theme name, 2: theme version number */
									_x( '%1$s <span>Version %2$s</span>', 'menu page heading', 'pressbook' ),
									array( 'span' => array() )
								),
								esc_html( PressBook\Helpers::get_theme_name() ),
								esc_html( wp_get_theme()->get( 'Version' ) )
							);
							?>
						</div>
					</div>
				</div>

				<div class="pressbook-container">
					<div class="pressbook-panel">
						<div class="pressbook-panel-content">
							<span class="pressbook-panel-title"><?php esc_html_e( 'Customize Theme', 'pressbook' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can customize the theme using the theme options available in the customizer.', 'pressbook' ); ?>
							</p>
						</div>
						<div class="pressbook-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button"><?php esc_html_e( 'Theme Options', 'pressbook' ); ?></a>
						</div>
					</div>
					<div class="pressbook-panel">
						<div class="pressbook-panel-content">
							<span class="pressbook-panel-title"><?php esc_html_e( 'Top Banner', 'pressbook' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can add the top banner image and link from the Customizer > Top Banner.', 'pressbook' ); ?>
							</p>
						</div>
						<div class="pressbook-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>?autofocus[section]=sec_top_banner" class="button"><?php esc_html_e( 'Top Banner', 'pressbook' ); ?></a>
						</div>
					</div>
					<div class="pressbook-panel">
						<div class="pressbook-panel-content">
							<span class="pressbook-panel-title"><?php esc_html_e( 'Menus & Social Links', 'pressbook' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can create a menu and assign it to a menu location. PressBook comes with three menu locations which include the primary menu, top bar menu, and social links menu. For social links, create a menu item with a custom link, enter the URL of the social page, and assign this menu to the "Social Links Menu" location.', 'pressbook' ); ?>
							</p>
						</div>
						<div class="pressbook-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>" class="button"><?php esc_html_e( 'Menus', 'pressbook' ); ?></a>
						</div>
					</div>
					<div class="pressbook-panel pressbook-panel--highlight">
						<div class="pressbook-panel-content">
							<span class="pressbook-panel-title"><?php esc_html_e( 'Premium Version', 'pressbook' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'PressBook Premium comes with additional features:', 'pressbook' ); ?>
							</p>
							<div class="pressbook-check-list-wrap">
								<ul class="pressbook-check-list">
									<li><?php esc_html_e( 'Dark and Light Color Schemes - Fully Customizable', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Dark and Light Editor Styles - Block Editor', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Alpha Transparency Effect with Background Image', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Sidebar Layout Custom Background Color', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Content Layout Custom Background Color', 'pressbook' ); ?></li>
									<li><?php esc_html_e( '4 Header Block Areas with Multiple Options', 'pressbook' ); ?></li>
									<li><?php esc_html_e( '3 Footer Block Areas with Multiple Options', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Multiple Posts Carousels with Advanced Options', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Footer Text Color, Link Color & Additional Options', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Standard Grid Layout and Masonry Grid Layout', 'pressbook' ); ?></li>
								</ul>
								<ul class="pressbook-check-list">
									<li><?php esc_html_e( 'Header, Footer, Content, Sidebars - Dark and Light Schemes', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Post Meta, Comment Meta Text Color & Link Color', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Custom Gradient Colors for Buttons', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Custom Accent Colors - Links, Text, Heading, Hover Colors', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Custom Google Fonts for Headings and Body Text', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Typography Settings - Global Font-Size, Font-Family, Line-Height', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Unlimited Color Options & Advanced Theme Options', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Header Posts and Related Posts Grid with Advanced Options', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Multiple Design for Site Branding, Top Navbar, Primary Navbar', 'pressbook' ); ?></li>
									<li><?php esc_html_e( 'Multiple Eye-Catching Block Patterns to Quickly Create Sections', 'pressbook' ); ?></li>
								</ul>
							</div>
							<a target="_blank" href="<?php echo esc_url( PressBook\Helpers::get_upsell_buy_url() ); ?>" class="button button-primary"><strong><?php esc_html_e( 'Get Premium', 'pressbook' ); ?></strong></a>
						</div>
					</div>
					<div class="pressbook-panel">
						<div class="pressbook-panel-content">
							<span class="pressbook-panel-title"><?php esc_html_e( 'Top Menu Options & Colors', 'pressbook' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can configure the options and change the colors of the top navbar from the Customizer > Top Navbar.', 'pressbook' ); ?>
							</p>
						</div>
						<div class="pressbook-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>?autofocus[section]=sec_top_navbar" class="button"><?php esc_html_e( 'Top Navbar', 'pressbook' ); ?></a>
						</div>
					</div>
					<div class="pressbook-panel">
						<div class="pressbook-panel-content">
							<span class="pressbook-panel-title"><?php esc_html_e( 'Primary Menu Options & Colors', 'pressbook' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can configure the options and change the colors of the primary navbar from the Customizer > Primary Navbar.', 'pressbook' ); ?>
							</p>
						</div>
						<div class="pressbook-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>?autofocus[section]=sec_primary_navbar" class="button"><?php esc_html_e( 'Primary Navbar', 'pressbook' ); ?></a>
						</div>
					</div>
					<div class="pressbook-panel">
						<div class="pressbook-panel-content">
							<span class="pressbook-panel-title"><?php esc_html_e( 'Header / Background Color & Image', 'pressbook' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can customize the header image from the Customizer > Header Image and body background image from the Customizer > Background Image. Also, you can change the header and body background color from the Customizer > Colors.', 'pressbook' ); ?>
							</p>
						</div>
						<div class="pressbook-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>?autofocus[section]=colors" class="button"><?php esc_html_e( 'Theme Colors', 'pressbook' ); ?></a>
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>?autofocus[section]=header_image" class="button"><?php esc_html_e( 'Header Image', 'pressbook' ); ?></a>
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>?autofocus[section]=background_image" class="button"><?php esc_html_e( 'Background Image', 'pressbook' ); ?></a>
						</div>
					</div>
					<div class="pressbook-panel">
						<div class="pressbook-panel-content">
							<span class="pressbook-panel-title"><?php esc_html_e( 'Header Block Area', 'pressbook' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can enable the header block area by creating a block in the reusable block manager. Then select this block in the Customizer > Header Block. PressBook comes with 1 header block area.', 'pressbook' ); ?>
							</p>
						</div>
						<div class="pressbook-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>?autofocus[section]=sec_header_block" class="button"><?php esc_html_e( 'Header Blocks', 'pressbook' ); ?></a>
							<a target="_blank" href="<?php echo esc_url( admin_url( 'edit.php?post_type=wp_block' ) ); ?>" class="button"><?php esc_html_e( 'Reusable Blocks', 'pressbook' ); ?></a>
						</div>
					</div>
					<div class="pressbook-panel">
						<div class="pressbook-panel-content">
							<span class="pressbook-panel-title"><?php esc_html_e( 'Footer Block Area', 'pressbook' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can enable the footer block area by creating a block in the reusable block manager. Then select this block in the Customizer > Footer Block. PressBook comes with 1 footer block area.', 'pressbook' ); ?>
							</p>
						</div>
						<div class="pressbook-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>?autofocus[section]=sec_footer_block" class="button"><?php esc_html_e( 'Footer Blocks', 'pressbook' ); ?></a>
							<a target="_blank" href="<?php echo esc_url( admin_url( 'edit.php?post_type=wp_block' ) ); ?>" class="button"><?php esc_html_e( 'Reusable Blocks', 'pressbook' ); ?></a>
						</div>
					</div>
					<div class="pressbook-panel">
						<div class="pressbook-panel-content">
							<span class="pressbook-panel-title"><?php esc_html_e( 'Sidebar & Footer Widgets', 'pressbook' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can drag and drop widgets to the widget area. PressBook comes with 6 widgets area locations which include a left sidebar, right sidebar, and 4 locations for footer widgets.', 'pressbook' ); ?>
							</p>
						</div>
						<div class="pressbook-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" class="button"><?php esc_html_e( 'Add / Manage Widgets', 'pressbook' ); ?></a>
						</div>
					</div>
					<div class="pressbook-panel">
						<div class="pressbook-panel-content">
							<span class="pressbook-panel-title"><?php esc_html_e( 'Page Template & Page Settings', 'pressbook' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'When adding or editing a page, there are many page templates to choose from. Also, you can configure the page settings for any specific page. These templates and settings are available on the sidebar area of the page editor screen.', 'pressbook' ); ?>
							</p>
						</div>
					</div>
					<div class="pressbook-panel">
						<div class="pressbook-panel-content">
							<span class="pressbook-panel-title"><?php esc_html_e( 'Page Template with Sidebar', 'pressbook' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'There are many page templates available to choose from. You can simply edit the page and on the right side of the page editor screen, set the template from "Template" to "Page with sidebar".', 'pressbook' ); ?>
							</p>
							<p class="description">
								<?php esc_html_e( 'Similarly, you can set the page template to full width, large width, medium width, small width, or default template without sidebar.', 'pressbook' ); ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'pressbook_options_styles' ) ) {
	/**
	 * Enqueue styles for the theme page.
	 */
	function pressbook_options_styles() {
		wp_enqueue_style( 'pressbook-options', get_template_directory_uri() . '/inc/theme-page.css', array(), PRESSBOOK_VERSION );
	}
}

/**
 * Add a notice after theme activation.
 */
function pressbook_welcome_notice() {
	global $pagenow;
	if ( is_admin() && isset( $_GET['activated'] ) && ( 'themes.php' === $pagenow ) ) { // phpcs:ignore
		?>
		<div class="updated notice notice-success is-dismissible">
			<p>
				<?php
				echo wp_kses(
					sprintf(
						/* translators: 1: theme name, 2: welcome page link. */
						__( 'Welcome! Thank you for choosing %1$s theme. To get started, visit our <a href="%2$s">welcome page</a>.', 'pressbook' ),
						esc_html( PressBook\Helpers::get_theme_name() ),
						esc_url( admin_url( 'themes.php?page=pressbook-options' ) )
					),
					array( 'a' => array( 'href' => array() ) )
				);
				?>
			</p>
			<p>
				<a class="button" href="<?php echo esc_url( admin_url( 'themes.php?page=pressbook-options' ) ); ?>">
					<?php
					printf(
						/* translators: %s: theme name */
						esc_html__( 'Get started with %s', 'pressbook' ),
						esc_html( PressBook\Helpers::get_theme_name() )
					);
					?>
				</a>
			</p>
		</div>
		<?php
	}
}
add_action( 'admin_notices', 'pressbook_welcome_notice' );
