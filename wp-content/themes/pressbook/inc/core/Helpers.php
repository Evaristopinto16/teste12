<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Helpers.
 *
 * @package PressBook
 */

namespace PressBook;

use PressBook\Options\Blog;

/**
 * Theme helpers.
 */
class Helpers {
	/**
	 * Find out if we should show the excerpt or the content.
	 *
	 * @return bool Whether to show the excerpt.
	 */
	public static function show_excerpt() {
		global $post;

		// Check if the more tag is being used.
		$more_tag = apply_filters( 'pressbook_more_tag', strpos( $post->post_content, '<!--more-->' ) );

		$format = ( false !== get_post_format() ) ? get_post_format() : 'standard';

		$show_excerpt = ( 'excerpt' === Blog::get_archive_content() );

		$show_excerpt = ( 'standard' !== $format ) ? false : $show_excerpt;

		$show_excerpt = ( $more_tag ) ? false : $show_excerpt;

		$show_excerpt = ( is_search() ) ? true : $show_excerpt;

		return apply_filters( 'pressbook_show_excerpt', $show_excerpt );
	}

	/**
	 * Get theme name.
	 *
	 * @return string
	 */
	public static function get_theme_name() {
		return wp_get_theme()->get( 'Name' );
	}

	/**
	 * Get theme URL.
	 * Used in footer credit link.
	 *
	 * @return string
	 */
	public static function get_theme_url() {
		return wp_get_theme()->get( 'ThemeURI' );
	}

	/**
	 * Get theme author URL.
	 *
	 * @return string
	 */
	public static function get_theme_author_url() {
		return wp_get_theme()->get( 'AuthorURI' );
	}

	/**
	 * Get upsell detail URL.
	 *
	 * @return string
	 */
	public static function get_upsell_detail_url() {
		return 'https://scriptstown.com/wordpress-themes/pressbook-premium/';
	}

	/**
	 * Get upsell buy URL.
	 * Used one time in the theme page and customizer.
	 *
	 * @return string
	 */
	public static function get_upsell_buy_url() {
		return 'https://scriptstown.com/account/signup/pressbook-premium-wordpress-theme';
	}

	/**
	 * Get FAQ page URL.
	 *
	 * @return string
	 */
	public static function get_faq_url() {
		return 'https://scriptstown.com/wordpress-themes/pressbook/#faq';
	}
}
