<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Jetpack compatibility.
 *
 * @link https://jetpack.com/
 *
 * @package PressBook
 */

namespace PressBook;

/**
 * Setup Jetpack for the theme.
 */
class Jetpack implements Serviceable {
	/**
	 * Register service features.
	 */
	public function register() {
		if ( class_exists( '\Jetpack' ) ) {
			add_action( 'after_setup_theme', array( $this, 'jetpack_setup' ) );
		}
	}

	/**
	 * Jetpack setup function.
	 *
	 * See: https://jetpack.com/support/infinite-scroll/
	 * See: https://jetpack.com/support/responsive-videos/
	 * See: https://jetpack.com/support/content-options/
	 */
	public function jetpack_setup() {
		// Add theme support for Infinite Scroll.
		add_theme_support(
			'infinite-scroll',
			array(
				'container' => 'primary',
				'render'    => array( $this, 'infinite_scroll_render' ),
				'footer'    => 'page',
			)
		);

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );

		// Add theme support for Content Options.
		add_theme_support(
			'jetpack-content-options',
			array(
				'post-details'    => array(
					'stylesheet' => 'pressbook-style',
					'date'       => '.posted-on',
					'categories' => '.cat-links',
					'tags'       => '.tag-links',
					'author'     => '.byline',
					'comment'    => '.comments-link',
				),
				'featured-images' => array(
					'archive' => true,
					'post'    => true,
					'page'    => true,
				),
			)
		);
	}

	/**
	 * Custom render function for Infinite Scroll.
	 */
	public function infinite_scroll_render() {
		while ( have_posts() ) {
			the_post();
			if ( is_search() ) {
				get_template_part( 'template-parts/content', 'search' );
			} else {
				get_template_part( 'template-parts/content' );
			}
		}
	}
}
