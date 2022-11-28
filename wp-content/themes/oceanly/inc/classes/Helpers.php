<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Helpers.
 *
 * @package Oceanly
 */

namespace Oceanly;

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
		$more_tag = apply_filters( 'oceanly_more_tag', strpos( $post->post_content, '<!--more-->' ) );

		$format = ( false !== get_post_format() ) ? get_post_format() : 'standard';

		$blog_content_default = Defaults::blog_content();

		$show_excerpt = ( 'summary' === get_theme_mod( 'set_blog_content', $blog_content_default ) );

		$show_excerpt = ( 'standard' !== $format ) ? false : $show_excerpt;

		$show_excerpt = ( $more_tag ) ? false : $show_excerpt;

		$show_excerpt = ( is_search() ) ? true : $show_excerpt;

		return apply_filters( 'oceanly_show_excerpt', $show_excerpt );
	}

	/**
	 * Blog sidebar.
	 *
	 * @return string.
	 */
	public static function blog_sidebar() {
		return get_theme_mod( 'set_blog_sidebar', Defaults::blog_sidebar() );
	}

	/**
	 * Sticky sidebar.
	 *
	 * @return bool.
	 */
	public static function sticky_sidebar() {
		return get_theme_mod( 'set_sticky_sidebar', Defaults::sticky_sidebar() );
	}

	/**
	 * Blog width no sidebar.
	 *
	 * @return string.
	 */
	public static function blog_width_no_sidebar() {
		return get_theme_mod( 'set_blog_width_no_sidebar', Defaults::blog_width_no_sidebar() );
	}

	/**
	 * Enable hero header.
	 *
	 * @return bool.
	 */
	public static function hero_header_enable() {
		return get_theme_mod( 'set_hero_header_enable', Defaults::hero_header_enable() );
	}

	/**
	 * Site header bottom margin.
	 *
	 * @return bool.
	 */
	public static function site_header_b_margin() {
		return get_theme_mod( 'set_site_header_b_margin', Defaults::site_header_b_margin() );
	}

	/**
	 * Post thumbnail hover effect.
	 *
	 * @return bool.
	 */
	public static function post_thumbnail_hover_effect() {
		return get_theme_mod( 'set_post_thumbnail_hover_effect', Defaults::post_thumbnail_hover_effect() );
	}

	/**
	 * Whether to hide back to top.
	 *
	 * @return bool.
	 */
	public static function hide_back_to_top() {
		return get_theme_mod( 'set_hide_back_to_top', Defaults::hide_back_to_top() );
	}

	/**
	 * Whether to show site title or tagline.
	 *
	 * @return bool.
	 */
	public static function show_site_title_or_tagline() {
		return ( get_theme_mod( 'set_show_site_title', Defaults::show_site_title() ) || get_theme_mod( 'set_show_site_tagline', Defaults::show_site_tagline() ) );
	}

	/**
	 * Whether to show site title.
	 *
	 * @return bool.
	 */
	public static function show_site_title() {
		return get_theme_mod( 'set_show_site_title', Defaults::show_site_title() );
	}

	/**
	 * Whether to show site tagline.
	 *
	 * @return bool.
	 */
	public static function show_site_tagline() {
		return get_theme_mod( 'set_show_site_tagline', Defaults::show_site_tagline() );
	}

	/**
	 * Styles settings.
	 *
	 * @return array.
	 */
	public static function styles() {
		return wp_parse_args(
			get_theme_mod( 'set_styles', array() ),
			Defaults::styles( '', true )
		);
	}

	/**
	 * Branding alignment (medium / large devices).
	 *
	 * @return string.
	 */
	public static function branding_alignment_md() {
		return get_theme_mod( 'set_branding_alignment_md', Defaults::branding_alignment_md() );
	}

	/**
	 * Branding alignment (small devices).
	 *
	 * @return string.
	 */
	public static function branding_alignment_sm() {
		return get_theme_mod( 'set_branding_alignment_sm', Defaults::branding_alignment_sm() );
	}

	/**
	 * Logo alignment (medium / large devices).
	 *
	 * @return string.
	 */
	public static function logo_alignment_md() {
		return get_theme_mod( 'set_logo_alignment_md', Defaults::logo_alignment_md() );
	}

	/**
	 * Logo alignment (small devices).
	 *
	 * @return string.
	 */
	public static function logo_alignment_sm() {
		return get_theme_mod( 'set_logo_alignment_sm', Defaults::logo_alignment_sm() );
	}

	/**
	 * Logo size (large devices).
	 *
	 * @return string.
	 */
	public static function logo_size_lg() {
		return get_theme_mod( 'set_logo_size_lg', Defaults::logo_size_lg() );
	}

	/**
	 * Logo size (medium devices).
	 *
	 * @return string.
	 */
	public static function logo_size_md() {
		return get_theme_mod( 'set_logo_size_md', Defaults::logo_size_md() );
	}

	/**
	 * Logo size (small devices).
	 *
	 * @return string.
	 */
	public static function logo_size_sm() {
		return get_theme_mod( 'set_logo_size_sm', Defaults::logo_size_sm() );
	}

	/**
	 * Site title size (medium / large devices).
	 *
	 * @return string.
	 */
	public static function site_title_size_md() {
		return get_theme_mod( 'set_site_title_size_md', Defaults::site_title_size_md() );
	}

	/**
	 * Site title size (small devices).
	 *
	 * @return string.
	 */
	public static function site_title_size_sm() {
		return get_theme_mod( 'set_site_title_size_sm', Defaults::site_title_size_sm() );
	}

	/**
	 * Site tagline size (medium / large devices).
	 *
	 * @return string.
	 */
	public static function site_tagline_size_md() {
		return get_theme_mod( 'set_site_tagline_size_md', Defaults::site_tagline_size_md() );
	}

	/**
	 * Site tagline size (small devices).
	 *
	 * @return string.
	 */
	public static function site_tagline_size_sm() {
		return get_theme_mod( 'set_site_tagline_size_sm', Defaults::site_tagline_size_sm() );
	}

	/**
	 * Header image parallax effect.
	 *
	 * @return bool.
	 */
	public static function hero_header_bg_fixed() {
		return get_theme_mod( 'set_hero_header_bg_fixed', Defaults::hero_header_bg_fixed() );
	}

	/**
	 * Header image background position.
	 *
	 * @return string.
	 */
	public static function hero_header_bg_position() {
		return get_theme_mod( 'set_hero_header_bg_position', Defaults::hero_header_bg_position() );
	}

	/**
	 * Header image background size.
	 *
	 * @return string.
	 */
	public static function hero_header_bg_size() {
		return get_theme_mod( 'set_hero_header_bg_size', Defaults::hero_header_bg_size() );
	}

	/**
	 * Menu alignment (medium / large devices).
	 *
	 * @return string.
	 */
	public static function menu_alignment_md() {
		return get_theme_mod( 'set_menu_alignment_md', Defaults::menu_alignment_md() );
	}

	/**
	 * Menu alignment (small devices).
	 *
	 * @return string.
	 */
	public static function menu_alignment_sm() {
		return get_theme_mod( 'set_menu_alignment_sm', Defaults::menu_alignment_sm() );
	}

	/**
	 * Sub-menu direction (large devices).
	 *
	 * @return string.
	 */
	public static function submenu_direction_lg() {
		return get_theme_mod( 'set_submenu_direction_lg', Defaults::submenu_direction_lg() );
	}

	/**
	 * Sub-menu direction (medium devices).
	 *
	 * @return string.
	 */
	public static function submenu_direction_md() {
		return get_theme_mod( 'set_submenu_direction_md', Defaults::submenu_direction_md() );
	}

	/**
	 * Whether to show header search form.
	 *
	 * @return bool.
	 */
	public static function show_header_search() {
		return get_theme_mod( 'set_show_header_search', Defaults::show_header_search() );
	}

	/**
	 * Whether to show header breadcrumbs.
	 *
	 * @return bool.
	 */
	public static function show_header_breadcrumbs() {
		return get_theme_mod( 'set_show_header_breadcrumbs', Defaults::show_header_breadcrumbs() );
	}

	/**
	 * Read more text.
	 *
	 * @return string.
	 */
	public static function read_more_text() {
		return get_theme_mod( 'set_read_more_text', Defaults::read_more_text() );
	}

	/**
	 * Header block area.
	 *
	 * @param int $number Block area number.
	 * @return array.
	 */
	public static function header_block_area( $number = 1 ) {
		$set_header_block_area = get_theme_mod( 'set_header_block_area', array() );

		if ( array_key_exists( $number, $set_header_block_area ) ) {
			return wp_parse_args(
				$set_header_block_area[ $number ],
				Defaults::header_block_area()
			);
		}

		return Defaults::header_block_area();
	}

	/**
	 * Footer widgets area per row (large devices).
	 *
	 * @return int
	 */
	public static function footer_widgets_per_row_lg() {
		return get_theme_mod( 'set_footer_widgets_per_row_lg', Defaults::footer_widgets_per_row_lg() );
	}

	/**
	 * Footer widgets area per row (medium devices).
	 *
	 * @return int
	 */
	public static function footer_widgets_per_row_md() {
		return get_theme_mod( 'set_footer_widgets_per_row_md', Defaults::footer_widgets_per_row_md() );
	}

	/**
	 * Footer widgets area per row (small devices).
	 *
	 * @return int
	 */
	public static function footer_widgets_per_row_sm() {
		return get_theme_mod( 'set_footer_widgets_per_row_sm', Defaults::footer_widgets_per_row_sm() );
	}

	/**
	 * Get allowed tags for copyright text.
	 *
	 * @return array
	 */
	public static function copyright_allowed_tags() {
		return apply_filters(
			'oceanly_copyright_allowed_tags',
			array(
				'span'   => array( 'class' => array() ),
				'em'     => array(),
				'strong' => array(),
				'br'     => array(),
				'a'      => array(
					'href'  => array(),
					'title' => array(),
					'rel'   => array(),
					'class' => array(),
				),
			)
		);
	}

	/**
	 * Get copyright text.
	 *
	 * @return string.
	 */
	public static function copyright() {
		return get_theme_mod( 'set_copyright', Defaults::copyright() );
	}

	/**
	 * Shows a breadcrumb for all types of pages.  This is a wrapper function for the BreadcrumbTrail class,
	 * which should be used in theme templates.
	 *
	 * @access public
	 *
	 * @param  array $args Arguments to pass to Breadcrumb_Trail.
	 *
	 * @return string html output.
	 */
	public static function breadcrumb_trail( $args = array() ) {
		$breadcrumb = apply_filters( 'breadcrumb_trail_object', null, $args );

		if ( ! is_object( $breadcrumb ) ) {
			$breadcrumb = new BreadcrumbTrail( $args );
		}

		return $breadcrumb->trail();
	}

	/**
	 * Get theme author URL.
	 * Used in footer credit link.
	 *
	 * @return string
	 */
	public static function get_author_url() {
		return 'https://scriptstown.com/';
	}

	/**
	 * Get upsell detail URL.
	 *
	 * @return string
	 */
	public static function get_upsell_detail_url() {
		return 'https://scriptstown.com/wordpress-themes/oceanly-premium/';
	}

	/**
	 * Get upsell buy URL.
	 * Used one time in the theme page and customizer.
	 *
	 * @return string
	 */
	public static function get_upsell_buy_url() {
		return 'https://scriptstown.com/account/signup/oceanly-premium-wordpress-theme';
	}

	/**
	 * Get FAQ page URL.
	 *
	 * @return string
	 */
	public static function get_faq_url() {
		return 'https://scriptstown.com/wordpress-themes/oceanly/#faq';
	}
}
