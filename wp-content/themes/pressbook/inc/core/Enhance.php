<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Enhance service.
 *
 * @package PressBook
 */

namespace PressBook;

use PressBook\Options\Blog;
use PressBook\Options\Content;
use PressBook\Options\General;
use PressBook\Options\Sidebar;

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

		add_filter( 'get_search_form', array( $this, 'search_form' ) );
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

		if ( is_active_sidebar( 'sidebar-1' ) ) {
			if ( is_active_sidebar( 'sidebar-2' ) ) {
				$classes[] = 'double-sidebar left-right-sidebar';
			} else {
				$classes[] = 'single-sidebar right-sidebar';
			}
		} elseif ( is_active_sidebar( 'sidebar-2' ) ) {
			$classes[] = 'single-sidebar left-sidebar';
		} else {
			$classes[] = 'no-sidebar';
		}

		// Adds a class of pb-content-columns where there is a layout set for the blog archive post.
		$archive_post_layout_lg = Blog::get_archive_post_layout_lg();
		if ( 'cover' === $archive_post_layout_lg ) {
			$classes[] = 'pb-content-columns pb-content-cover';
		} elseif ( 'columns' === $archive_post_layout_lg ) {
			$classes[] = 'pb-content-columns';
		}

		$content_layout_class = Content::get_content_layout_body_class();
		if ( '' !== $content_layout_class ) {
			$classes[] = $content_layout_class;
		}

		$side_widget_class = Sidebar::get_side_widget_body_class();
		if ( '' !== $side_widget_class ) {
			$classes[] = $side_widget_class;
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

		$more_text = General::get_read_more_text();

		if ( '' === $more_text ) {
			$more_text = esc_html__( 'Read More', 'pressbook' );
		}

		$more = ( '...<p class="more-link-wrap"><a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf(
			wp_kses(
				/* translators: 1: "Read More" text, 2: Name of current post. Only visible to screen readers */
				_x( '%1$s<span class="screen-reader-text"> &ldquo;%2$s&rdquo;</span> &raquo;', 'excerpt more', 'pressbook' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			esc_html( $more_text ),
			wp_kses_post( get_the_title() )
		) . '</a></p>' );

		return apply_filters( 'pressbook_excerpt_more', $more );
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

		$more_text = General::get_read_more_text();

		if ( '' === $more_text ) {
			$more_text = esc_html__( 'Read More', 'pressbook' );
		}

		$more = ( '<p class="more-link-wrap"><a href="' . esc_url( get_permalink() . apply_filters( 'pressbook_more_jump', '#more-' . get_the_ID() ) ) . '" class="more-link">' . sprintf(
			wp_kses(
				/* translators: 1: "Read More" text, 2: Name of current post. Only visible to screen readers */
				_x( '%1$s<span class="screen-reader-text"> &ldquo;%2$s&rdquo;</span> &raquo;', 'content more', 'pressbook' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			esc_html( $more_text ),
			wp_kses_post( get_the_title() )
		) . '</a></p>' );

		return apply_filters( 'pressbook_content_more', $more );
	}

	/**
	 * Change the search form button text.
	 *
	 * @param string $form The search form HTML output.
	 * @return string
	 */
	public function search_form( $form ) {
		if ( is_admin() ) {
			return $form;
		}

		$button_text = General::get_search_form_button_text();

		if ( '' !== $button_text ) {
			$form = str_replace( 'value="Search"', ( 'value="' . esc_attr( $button_text ) . '"' ), $form );
		}

		return $form;
	}
}
