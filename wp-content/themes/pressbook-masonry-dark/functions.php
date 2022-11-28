<?php
/**
 * This is the child theme for PressBook theme.
 *
 * (See https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 *
 * @package PressBook_Masonry_Dark
 */

defined( 'ABSPATH' ) || die();

define( 'PRESSBOOK_MASONRY_DARK_VERSION', '1.0.3' );

/**
 * Load child theme text domain.
 */
function pressbook_masonry_dark_setup() {
	load_child_theme_textdomain( 'pressbook-masonry-dark', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'pressbook_masonry_dark_setup', 11 );

/**
 * Load child theme services.
 *
 * @param  array $services Parent theme services.
 * @return array
 */
function pressbook_masonry_dark_services( $services ) {
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-masonry-dark-cssrules.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-masonry-dark-scripts.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-masonry-dark-editor.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-masonry-dark-siteidentity.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-masonry-dark-primarynavbar.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-masonry-dark-related-posts.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-masonry-dark-options.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-masonry-dark-jetpack.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-masonry-dark-block-patterns.php';

	foreach ( $services as $key => $service ) {
		if ( 'PressBook\Editor' === $service ) {
			$services[ $key ] = PressBook_Masonry_Dark_Editor::class;
		} elseif ( 'PressBook\Scripts' === $service ) {
			$services[ $key ] = PressBook_Masonry_Dark_Scripts::class;
		} elseif ( 'PressBook\Options\SiteIdentity' === $service ) {
			$services[ $key ] = PressBook_Masonry_Dark_SiteIdentity::class;
		} elseif ( 'PressBook\Jetpack' === $service ) {
			$services[ $key ] = PressBook_Masonry_Dark_Jetpack::class;
		}
	}

	array_push( $services, PressBook_Masonry_Dark_PrimaryNavbar::class );
	array_push( $services, PressBook_Masonry_Dark_Related_Posts::class );
	array_push( $services, PressBook_Masonry_Dark_Options::class );
	array_push( $services, PressBook_Masonry_Dark_Block_Patterns::class );

	return $services;
}
add_filter( 'pressbook_services', 'pressbook_masonry_dark_services' );

/**
 * Change default background args.
 *
 * @param  array $args Custom background args.
 * @return array
 */
function pressbook_masonry_dark_custom_background_args( $args ) {
	return array(
		'default-color' => '1a1a1a',
		'default-image' => '',
	);
}
add_filter( 'pressbook_custom_background_args', 'pressbook_masonry_dark_custom_background_args' );

/**
 * Change default styles.
 *
 * @param  array $styles Default sttyles.
 * @return array
 */
function pressbook_masonry_dark_default_styles( $styles ) {
	$styles['top_navbar_bg_color_1']         = '#6709b4';
	$styles['top_navbar_bg_color_2']         = '#390564';
	$styles['primary_navbar_bg_color']       = 'rgba(0,0,0,0.9)';
	$styles['primary_navbar_hover_bg_color'] = 'rgba(103,9,180,0.95)';
	$styles['header_bg_color']               = 'rgba(20,26,26,0.96)';
	$styles['site_title_color']              = '#ffffff';
	$styles['tagline_color']                 = '#999fa3';
	$styles['button_bg_color_1']             = '#5b08a0';
	$styles['button_bg_color_2']             = '#8023ce';
	$styles['side_widget_border_color']      = '#101010';
	$styles['footer_bg_color']               = 'rgba(0,0,0,0.94)';
	$styles['footer_credit_link_color']      = '#b57de3';

	return $styles;
}
add_filter( 'pressbook_default_styles', 'pressbook_masonry_dark_default_styles' );

/**
 * Change welcome page title.
 *
 * @param  string $page_title Welcome page title.
 * @return string
 */
function pressbook_masonry_dark_welcome_page_title( $page_title ) {
	return esc_html_x( 'PressBook Masonry Dark', 'page title', 'pressbook-masonry-dark' );
}
add_filter( 'pressbook_welcome_page_title', 'pressbook_masonry_dark_welcome_page_title' );

/**
 * Change welcome menu title.
 *
 * @param  string $menu_title Welcome menu title.
 * @return string
 */
function pressbook_masonry_dark_welcome_menu_title( $menu_title ) {
	return esc_html_x( 'PressBook Masonry', 'menu title', 'pressbook-masonry-dark' );
}
add_filter( 'pressbook_welcome_menu_title', 'pressbook_masonry_dark_welcome_menu_title' );

/**
 * Recommended plugins.
 */
require get_stylesheet_directory() . '/inc/recommended-plugins.php';
