<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Enqueue service.
 *
 * @package Oceanly_News_Dark
 */

/**
 * Enqueue theme styles and scripts.
 */
class Oceanly_News_Dark_Enqueue implements Oceanly\Serviceable {
	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'oceanly_fonts_url', array( $this, 'fonts_url' ) );
	}

	/**
	 * Enqueue styles and scripts.
	 */
	public function enqueue_scripts() {
		// Child theme stylesheet.
		wp_enqueue_style( 'oceanly-news-dark-style', get_stylesheet_directory_uri() . '/style.min.css', array(), OCEANLY_NEWS_DARK_VERSION );
		wp_style_add_data( 'oceanly-news-dark-style', 'rtl', 'replace' );
	}

	/**
	 * Register Google fonts.
	 */
	public function fonts_url() {
		$fonts_url = apply_filters( 'oceanly_news_dark_fonts_url', 'https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,400;0,600;1,400;1,600&family=Recursive:wght@400;500;600&display=swap' );

		return esc_url_raw( $fonts_url );
	}
}
