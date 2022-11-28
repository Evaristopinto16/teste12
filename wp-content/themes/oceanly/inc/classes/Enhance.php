<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Enhance service.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Enhance the theme by hooking into WordPress.
 */
class Enhance implements Serviceable {
	/**
	 * Register service features.
	 */
	public function register() {
		add_filter( 'body_class', array( $this, 'body_classes' ) );

		add_action( 'wp_head', array( $this, 'pingback_header' ) );

		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );

		add_filter( 'the_content_more_link', array( $this, 'content_more' ) );
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public function body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no sidebar present.
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'no-sidebar';
		}

		if ( ! is_page() && 'left' === Helpers::blog_sidebar() ) {
			$classes[] = 'left-sidebar';
		}

		if ( ! is_page() && 'full' === Helpers::blog_width_no_sidebar() ) {
			$classes[] = 'full-width-no-sidebar';
		}

		// Adds a class of post-thumbnail-hover-effect.
		if ( Helpers::post_thumbnail_hover_effect() ) {
			$classes[] = 'post-thumbnail-hover-effect';
		}

		return $classes;
	}

	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	public function pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

	/**
	 * Change the excerpt more string.
	 *
	 * @param string $more The string shown within the more link.
	 * @return string
	 */
	public function excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_text = Helpers::read_more_text();

		if ( '' === $more_text ) {
			$more_text = esc_html__( 'Read More', 'oceanly' );
		}

		$more = ( ' ... <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf(
			wp_kses(
				/* translators: 1: "Read More" text, 2: Name of current post. Only visible to screen readers */
				_x( '%1$s<span class="screen-reader-text"> "%2$s"</span> &raquo;', 'excerpt more', 'oceanly' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			esc_html( $more_text ),
			wp_kses_post( get_the_title() )
		) . '</a>' );

		return apply_filters( 'oceanly_excerpt_more', $more );
	}

	/**
	 * Change the content more string.
	 *
	 * @param string $more The string shown within the more link.
	 * @return string
	 */
	public function content_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_text = Helpers::read_more_text();

		if ( '' === $more_text ) {
			$more_text = esc_html__( 'Read More', 'oceanly' );
		}

		$more = ( '<p class="more-link-container"><a href="' . esc_url( get_permalink() . apply_filters( 'oceanly_more_jump', '#more-' . get_the_ID() ) ) . '" class="more-link">' . sprintf(
			wp_kses(
				/* translators: 1: "Read More" text, 2: Name of current post. Only visible to screen readers */
				_x( '%1$s<span class="screen-reader-text"> "%2$s"</span> &raquo;', 'content more', 'oceanly' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			esc_html( $more_text ),
			wp_kses_post( get_the_title() )
		) . '</a></p>' );

		return apply_filters( 'oceanly_content_more', $more );
	}
}
