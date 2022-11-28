<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Defaults.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Set theme default options.
 */
class Defaults {
	/**
	 * Blog content default.
	 *
	 * @return string.
	 */
	public static function blog_content() {
		return apply_filters( 'oceanly_default_blog_content', 'summary' );
	}

	/**
	 * Blog sidebar default.
	 *
	 * @return string.
	 */
	public static function blog_sidebar() {
		return apply_filters( 'oceanly_default_blog_sidebar', 'right' );
	}

	/**
	 * Sticky sidebar default.
	 *
	 * @return bool.
	 */
	public static function sticky_sidebar() {
		return apply_filters( 'oceanly_default_sticky_sidebar', true );
	}

	/**
	 * Blog width no sidebar default.
	 *
	 * @return string.
	 */
	public static function blog_width_no_sidebar() {
		return apply_filters( 'oceanly_default_blog_width_no_sidebar', 'compact' );
	}

	/**
	 * Post thumbnail hover effect default.
	 *
	 * @return bool.
	 */
	public static function post_thumbnail_hover_effect() {
		return apply_filters( 'oceanly_default_post_thumbnail_hover_effect', true );
	}

	/**
	 * Hide back to top.
	 *
	 * @return bool.
	 */
	public static function hide_back_to_top() {
		return apply_filters( 'oceanly_default_hide_back_to_top', false );
	}

	/**
	 * Show site title default.
	 *
	 * @return bool.
	 */
	public static function show_site_title() {
		return apply_filters( 'oceanly_default_show_site_title', true );
	}

	/**
	 * Show site tagline default.
	 *
	 * @return bool.
	 */
	public static function show_site_tagline() {
		return apply_filters( 'oceanly_default_show_site_tagline', true );
	}

	/**
	 * Styles default.
	 *
	 * @param string $key Color setting key.
	 * @param bool   $get_all Get all default styles.
	 * @return array|string.
	 */
	public static function styles( $key = '', $get_all = false ) {
		$styles = apply_filters(
			'oceanly_default_styles',
			array(
				'header_bg_color' => '#808080',
			)
		);

		if ( $get_all ) {
			return $styles;
		}

		if ( array_key_exists( $key, $styles ) ) {
			return $styles[ $key ];
		}

		return '';
	}

	/**
	 * Branding alignment (medium / large devices) default.
	 *
	 * @return string.
	 */
	public static function branding_alignment_md() {
		return apply_filters( 'oceanly_default_branding_alignment_md', 'left' );
	}

	/**
	 * Branding alignment (small devices) default.
	 *
	 * @return string.
	 */
	public static function branding_alignment_sm() {
		return apply_filters( 'oceanly_default_branding_alignment_sm', 'center' );
	}

	/**
	 * Logo alignment (medium / large devices) default.
	 *
	 * @return string.
	 */
	public static function logo_alignment_md() {
		return apply_filters( 'oceanly_default_logo_alignment_md', 'left' );
	}

	/**
	 * Logo alignment (small devices) default.
	 *
	 * @return string.
	 */
	public static function logo_alignment_sm() {
		return apply_filters( 'oceanly_default_logo_alignment_sm', 'top' );
	}

	/**
	 * Logo size (large devices) default.
	 *
	 * @return string.
	 */
	public static function logo_size_lg() {
		return apply_filters( 'oceanly_default_logo_size_lg', 'md' );
	}

	/**
	 * Logo size (medium devices) default.
	 *
	 * @return string.
	 */
	public static function logo_size_md() {
		return apply_filters( 'oceanly_default_logo_size_md', 'xs' );
	}

	/**
	 * Logo size (small devices) default.
	 *
	 * @return string.
	 */
	public static function logo_size_sm() {
		return apply_filters( 'oceanly_default_logo_size_sm', 'xs' );
	}

	/**
	 * Site title size (medium / large devices) default.
	 *
	 * @return string.
	 */
	public static function site_title_size_md() {
		return apply_filters( 'oceanly_default_site_title_size_md', 'lg' );
	}

	/**
	 * Site title size (small devices) default.
	 *
	 * @return string.
	 */
	public static function site_title_size_sm() {
		return apply_filters( 'oceanly_default_site_title_size_sm', 'md' );
	}

	/**
	 * Site tagline size (medium / large devices) default.
	 *
	 * @return string.
	 */
	public static function site_tagline_size_md() {
		return apply_filters( 'oceanly_default_site_tagline_size_md', 'md' );
	}

	/**
	 * Site tagline size (small devices) default.
	 *
	 * @return string.
	 */
	public static function site_tagline_size_sm() {
		return apply_filters( 'oceanly_default_site_tagline_size_sm', 'md' );
	}

	/**
	 * Enable hero header default.
	 *
	 * @return bool.
	 */
	public static function hero_header_enable() {
		return apply_filters( 'oceanly_default_hero_header_enable', true );
	}

	/**
	 * Site header bottom margin default.
	 *
	 * @return bool.
	 */
	public static function site_header_b_margin() {
		return apply_filters( 'oceanly_default_site_header_b_margin', false );
	}

	/**
	 * Header image parallax effect default.
	 *
	 * @return bool.
	 */
	public static function hero_header_bg_fixed() {
		return apply_filters( 'oceanly_default_hero_header_bg_fixed', true );
	}

	/**
	 * Header image background position default.
	 *
	 * @return string.
	 */
	public static function hero_header_bg_position() {
		return apply_filters( 'oceanly_default_hero_header_bg_position', 'center-center' );
	}

	/**
	 * Header image background size default.
	 *
	 * @return string.
	 */
	public static function hero_header_bg_size() {
		return apply_filters( 'oceanly_default_hero_header_bg_size', 'cover' );
	}

	/**
	 * Menu alignment (medium / large devices) default.
	 *
	 * @return string.
	 */
	public static function menu_alignment_md() {
		return apply_filters( 'oceanly_default_menu_alignment_md', 'left' );
	}

	/**
	 * Menu alignment (small devices) default.
	 *
	 * @return string.
	 */
	public static function menu_alignment_sm() {
		return apply_filters( 'oceanly_default_menu_alignment_sm', 'center' );
	}

	/**
	 * Sub-menu direction (large devices) default.
	 *
	 * @return string.
	 */
	public static function submenu_direction_lg() {
		return apply_filters( 'oceanly_default_submenu_direction_lg', 'right' );
	}

	/**
	 * Sub-menu direction (medium devices) default.
	 *
	 * @return string.
	 */
	public static function submenu_direction_md() {
		return apply_filters( 'oceanly_default_submenu_direction_md', 'right' );
	}

	/**
	 * Show header search form.
	 *
	 * @return bool.
	 */
	public static function show_header_search() {
		return apply_filters( 'oceanly_default_show_header_search', true );
	}

	/**
	 * Show header breadcrumbs.
	 *
	 * @return bool.
	 */
	public static function show_header_breadcrumbs() {
		return apply_filters( 'oceanly_default_show_header_breadcrumbs', true );
	}

	/**
	 * Read more text.
	 *
	 * @return string.
	 */
	public static function read_more_text() {
		return apply_filters( 'oceanly_default_read_more_text', '' );
	}

	/**
	 * Header block area default.
	 *
	 * @return array.
	 */
	public static function header_block_area() {
		return apply_filters(
			'oceanly_default_header_block_area',
			array(
				'id'         => '',
				'full_width' => false,
				'b_margin'   => true,
				'in_front'   => true,
				'in_blog'    => true,
				'in_archive' => false,
				'in_post'    => false,
				'in_page'    => false,
			)
		);
	}

	/**
	 * Footer widgets per row (large devices) default.
	 *
	 * @return string.
	 */
	public static function footer_widgets_per_row_lg() {
		return apply_filters( 'oceanly_default_footer_widgets_per_row_lg', 3 );
	}

	/**
	 * Footer widgets per row (medium devices) default.
	 *
	 * @return string.
	 */
	public static function footer_widgets_per_row_md() {
		return apply_filters( 'oceanly_default_footer_widgets_per_row_md', 2 );
	}

	/**
	 * Footer widgets per row (small devices) default.
	 *
	 * @return string.
	 */
	public static function footer_widgets_per_row_sm() {
		return apply_filters( 'oceanly_default_footer_widgets_per_row_sm', 1 );
	}

	/**
	 * Default copyright text.
	 *
	 * @return string.
	 */
	public static function copyright() {
		return apply_filters(
			'oceanly_default_copyright',
			sprintf(
				/* translators: 1: current year, 2: blog name */
				esc_html__( 'Copyright &copy; %1$s %2$s.', 'oceanly' ),
				esc_html( date_i18n( _x( 'Y', 'copyright date format', 'oceanly' ) ) ),
				get_bloginfo( 'name', 'display' ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			)
		);
	}
}
