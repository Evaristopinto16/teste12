<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Enqueue service.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Enqueue theme styles and scripts.
 */
class Enqueue implements Serviceable {
	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue styles and scripts.
	 */
	public function enqueue_scripts() {
		// Enqueue Google fonts.
		wp_enqueue_style( 'oceanly-fonts', $this->fonts_url(), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

		// Theme stylesheet.
		wp_enqueue_style( 'oceanly-style', get_template_directory_uri() . '/style.min.css', array(), OCEANLY_VERSION );
		wp_style_add_data( 'oceanly-style', 'rtl', 'replace' );

		// Add output of customizer settings as inline style.
		wp_add_inline_style( 'oceanly-style', CSSRules::output() );

		// Theme script.
		wp_enqueue_script( 'oceanly-script', get_template_directory_uri() . '/js/script.min.js', array(), OCEANLY_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( Helpers::sticky_sidebar() ) {
			// Resize observer polyfill.
			wp_enqueue_script( 'resize-observer-polyfill', get_template_directory_uri() . '/js/ResizeObserver.min.js', array(), true, true );

			// Sticky sidebar.
			wp_enqueue_script( 'sticky-sidebar', get_template_directory_uri() . '/js/sticky-sidebar.min.js', array(), true, true );

			wp_add_inline_script(
				'sticky-sidebar',
				'try{new StickySidebar(".site-content > .content-sidebar-wrap > .c-sidebar",{topSpacing:100,bottomSpacing:0,containerSelector:".site-content > .content-sidebar-wrap",minWidth:1023});}catch(e){}'
			);
		}
	}

	/**
	 * Register Google fonts.
	 */
	public function fonts_url() {
		$fonts_url = apply_filters( 'oceanly_fonts_url', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;1,400;1,600&family=Source+Sans+Pro:ital,wght@0,600;1,600&display=swap' );

		$fonts_url = esc_url_raw( $fonts_url );

		require_once get_template_directory() . '/inc/libs/class-wptt-webfont-loader.php';
		return wptt_get_webfont_url( $fonts_url );
	}
}
