<?php
/**
 * This is the child theme for Oceanly theme.
 *
 * (See https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 *
 * @package Oceanly_News_Dark
 */

defined( 'ABSPATH' ) || die();

define( 'OCEANLY_NEWS_DARK_VERSION', '1.0.7' );

/**
 * Set child theme services.
 *
 * @param  array $services Parent theme services.
 * @return array
 */
function oceanly_news_dark_services( $services ) {
	require get_stylesheet_directory() . '/inc/classes/class-oceanly-news-dark-enqueue.php';
	require get_stylesheet_directory() . '/inc/classes/class-oceanly-news-dark-select-multiple.php';
	require get_stylesheet_directory() . '/inc/classes/class-oceanly-news-dark-featured-posts.php';
	require get_stylesheet_directory() . '/inc/classes/class-oceanly-news-dark-related-posts.php';
	require get_stylesheet_directory() . '/inc/classes/class-oceanly-news-dark-upsell.php';

	array_push( $services, Oceanly_News_Dark_Enqueue::class );
	array_push( $services, Oceanly_News_Dark_Featured_Posts::class );
	array_push( $services, Oceanly_News_Dark_Related_Posts::class );
	array_push( $services, Oceanly_News_Dark_Upsell::class );

	return $services;
}
add_filter( 'oceanly_services', 'oceanly_news_dark_services' );

/**
 * Load child theme text domain and remove welcome hooks of parent theme.
 */
function oceanly_news_dark_setup() {
	load_child_theme_textdomain( 'oceanly-news-dark', get_stylesheet_directory() . '/languages' );

	remove_action( 'admin_menu', 'oceanly_create_menu' );
	remove_action( 'admin_notices', 'oceanly_welcome_notice' );
}
add_action( 'after_setup_theme', 'oceanly_news_dark_setup', 11 );

/**
 * Change default background args.
 *
 * @param  array $args Custom background args.
 * @return array
 */
function oceanly_news_dark_custom_background_args( $args ) {
	return array(
		'default-color' => '1a1a1a',
		'default-image' => '',
	);
}
add_filter( 'oceanly_custom_background_args', 'oceanly_news_dark_custom_background_args' );

/**
 * Change default styles.
 *
 * @param  array $styles Default sttyles.
 * @return array
 */
function oceanly_news_dark_default_styles( $styles ) {
	$styles['header_bg_color'] = '#313131';

	return $styles;
}
add_filter( 'oceanly_default_styles', 'oceanly_news_dark_default_styles' );

/**
 * Welcome page.
 */
require get_stylesheet_directory() . '/inc/welcome-page.php';

/**
 * Recommended plugins.
 */
require get_stylesheet_directory() . '/inc/recommended-plugins.php';
