<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Scripts service.
 *
 * @package PressBook
 */

namespace PressBook;

use PressBook\CSSRules;
use PressBook\Options\Sidebar;

/**
 * Enqueue theme styles and scripts.
 */
class Scripts implements Serviceable {
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
		// Enqueue fonts.
		wp_enqueue_style( 'pressbook-fonts', static::fonts_url(), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

		// Theme stylesheet.
		wp_enqueue_style( 'pressbook-style', get_template_directory_uri() . '/style.min.css', array(), PRESSBOOK_VERSION );
		wp_style_add_data( 'pressbook-style', 'rtl', 'replace' );

		// Add output of customizer settings as inline style.
		wp_add_inline_style( 'pressbook-style', CSSRules::output() );

		// Theme script.
		wp_enqueue_script( 'pressbook-script', get_template_directory_uri() . '/js/script.min.js', array(), PRESSBOOK_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( Sidebar::get_sticky_sidebar() ) {
			// Resize observer polyfill.
			wp_enqueue_script( 'resize-observer-polyfill', get_template_directory_uri() . '/js/ResizeObserver.min.js', array(), true, true );

			// Sticky sidebar.
			wp_enqueue_script( 'sticky-sidebar', get_template_directory_uri() . '/js/sticky-sidebar.min.js', array(), true, true );

			$pressbook_sticky_bp = Sidebar::get_sticky_breakpoint();

			wp_add_inline_script(
				'sticky-sidebar',
				'try{new StickySidebar(".site-content > .pb-content-sidebar > .c-sidebar",{topSpacing:100,bottomSpacing:0,containerSelector:".site-content > .pb-content-sidebar",minWidth:' . esc_attr( $pressbook_sticky_bp ) . '});new StickySidebar(".site-content > .pb-content-sidebar > .c-sidebar-right",{topSpacing:100,bottomSpacing:0,containerSelector:".site-content > .pb-content-sidebar",minWidth:' . esc_attr( $pressbook_sticky_bp ) . '});}catch(e){}'
			);
		}
	}

	/**
	 * Get fonts URL.
	 */
	public static function fonts_url() {
		$fonts_url = '';

		$font_families = array();

		$query_params = array();

		/* translators: If there are characters in your language that are not supported by Inter, translate this to 'off'. Do not translate into your own language. */
		$inter = _x( 'on', 'Inter font: on or off', 'pressbook' );
		if ( 'off' !== $inter ) {
			array_push( $font_families, 'Inter:wght@400;600' );
		}

		/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
		$lato = _x( 'on', 'Lato font: on or off', 'pressbook' );
		if ( 'off' !== $lato ) {
			array_push( $font_families, 'Lato:ital,wght@0,400;0,700;1,400;1,700' );
		}

		if ( count( $font_families ) > 0 ) {
			foreach ( $font_families as $font_family ) {
				array_push( $query_params, ( 'family=' . $font_family ) );
			}

			array_push( $query_params, 'display=swap' );

			$fonts_url = ( 'https://fonts.googleapis.com/css2?' . implode( '&', $query_params ) );
		}

		$fonts_url = apply_filters( 'pressbook_fonts_url', $fonts_url );

		$fonts_url = esc_url_raw( $fonts_url );

		if ( function_exists( 'wptt_get_webfont_url' ) ) {
			return wptt_get_webfont_url( $fonts_url );
		}

		return $fonts_url;
	}
}
