<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer site identity options service.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use PressBook\Options;
use PressBook\CSSRules;

/**
 * Site identity options service class.
 */
class SiteIdentity extends Options {
	const SETTING_NAMES = array( 'logo', 'site_title', 'tagline' );
	const SETTING_SIZES = array( 'lg', 'md', 'sm' );

	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_action( 'customize_preview_init', array( $this, 'customize_preview_scripts' ) );
	}

	/**
	 * Add site identity options for theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		// Selective refresh for site title.
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

		// Selective refresh for site tagline.
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		$this->set_hide_site_title( $wp_customize );
		$this->set_hide_site_tagline( $wp_customize );

		foreach ( self::SETTING_NAMES as $name ) {
			foreach ( self::SETTING_SIZES as $size ) {
				$this->set_size( $wp_customize, $name, $size );
				$this->selective_refresh_size( $wp_customize, $name, $size );
			}
		}
	}

	/**
	 * Add setting: Hide Site Title.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_hide_site_title( $wp_customize ) {
		$wp_customize->add_setting(
			'set_hide_site_title',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_hide_site_title( true ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_hide_site_title',
			array(
				'section' => 'title_tagline',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Hide Site Title', 'pressbook' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_hide_site_title',
			array(
				'selector'            => '.site-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Get setting: Hide Site Title.
	 *
	 * @param bool $get_default Get default.
	 * @return bool
	 */
	public static function get_hide_site_title( $get_default = false ) {
		$default = apply_filters( 'pressbook_default_hide_site_title', false );
		if ( $get_default ) {
			return $default;
		}

		return get_theme_mod( 'set_hide_site_title', $default );
	}

	/**
	 * Add setting: Hide Site Tagline.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_hide_site_tagline( $wp_customize ) {
		$wp_customize->add_setting(
			'set_hide_site_tagline',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_hide_site_tagline( true ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_hide_site_tagline',
			array(
				'section' => 'title_tagline',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Hide Site Tagline', 'pressbook' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_hide_site_tagline',
			array(
				'selector'            => '.site-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Get setting: Hide Site Tagline.
	 *
	 * @param bool $get_default Get default.
	 * @return bool
	 */
	public static function get_hide_site_tagline( $get_default = false ) {
		$default = apply_filters( 'pressbook_default_hide_site_tagline', false );
		if ( $get_default ) {
			return $default;
		}

		return get_theme_mod( 'set_hide_site_tagline', $default );
	}

	/**
	 * Add setting: Size.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param string               $name Setting name.
	 * @param string               $size Screen size.
	 */
	public function set_size( $wp_customize, $name, $size ) {
		$key = ( 'set_' . $name . '_size[' . $size . ']' );

		$wp_customize->add_setting(
			$key,
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_size_default( $name, $size ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$method_label = ( 'get_' . $name . '_size_label' );

		$wp_customize->add_control(
			$key,
			array(
				'section'     => 'title_tagline',
				'type'        => 'select',
				'choices'     => $this->sizes(),
				'label'       => self::$method_label()['label'][ $size ],
				'description' => self::$method_label()['desc'][ $size ],
			)
		);
	}

	/**
	 * Get setting: Size.
	 *
	 * @param string $name Setting name.
	 * @return array
	 */
	public static function get_size( $name ) {
		return wp_parse_args(
			get_theme_mod( ( 'set_' . $name . '_size' ), array() ),
			self::get_size_default( $name )
		);
	}

	/**
	 * Get default setting: Size.
	 *
	 * @param string $name Setting name.
	 * @param string $size Screen size.
	 * @return array|string
	 */
	public static function get_size_default( $name, $size = '' ) {
		$method_default = ( 'get_' . $name . '_size_default' );

		$default = apply_filters(
			( 'pressbook_default_' . $name . '_size' ),
			self::$method_default()
		);

		if ( '' === $size ) {
			return $default;
		}

		if ( array_key_exists( $size, $default ) ) {
			return $default[ $size ];
		}

		return '';
	}

	/**
	 * Get default setting: Logo Size.
	 *
	 * @return array
	 */
	public static function get_logo_size_default() {
		return array(
			'sm' => 1,
			'md' => 1,
			'lg' => 1,
		);
	}

	/**
	 * Get default setting: Size Title Size.
	 *
	 * @return array
	 */
	public static function get_site_title_size_default() {
		return array(
			'sm' => 2,
			'md' => 2,
			'lg' => 2,
		);
	}

	/**
	 * Get default setting: Tagline Size.
	 *
	 * @return array
	 */
	public static function get_tagline_size_default() {
		return array(
			'sm' => 2,
			'md' => 2,
			'lg' => 2,
		);
	}

	/**
	 * Get setting label: Logo Size.
	 *
	 * @return array
	 */
	public static function get_logo_size_label() {
		return array(
			'label' => array(
				'sm' => esc_html__( 'Logo Size (Small-Screen Devices)', 'pressbook' ),
				'md' => esc_html__( 'Logo Size (Medium-Screen Devices)', 'pressbook' ),
				'lg' => esc_html__( 'Logo Size (Large-Screen Devices)', 'pressbook' ),
			),
			'desc'  => array(
				'sm' => esc_html_x( 'Default: Size 1', 'Default: Logo Size (Small-Screen Devices)', 'pressbook' ),
				'md' => esc_html_x( 'Default: Size 1', 'Default: Logo Size (Medium-Screen Devices)', 'pressbook' ),
				'lg' => esc_html_x( 'Default: Size 1', 'Default: Logo Size (Large-Screen Devices)', 'pressbook' ),
			),
		);
	}

	/**
	 * Get setting label: Site Title Size.
	 *
	 * @return array
	 */
	public static function get_site_title_size_label() {
		return array(
			'label' => array(
				'sm' => esc_html__( 'Site Title Size (Small-Screen Devices)', 'pressbook' ),
				'md' => esc_html__( 'Site Title Size (Medium-Screen Devices)', 'pressbook' ),
				'lg' => esc_html__( 'Site Title Size (Large-Screen Devices)', 'pressbook' ),
			),
			'desc'  => array(
				'sm' => esc_html_x( 'Default: Size 2', 'Default: Site Title Size (Small-Screen Devices)', 'pressbook' ),
				'md' => esc_html_x( 'Default: Size 2', 'Default: Site Title Size (Medium-Screen Devices)', 'pressbook' ),
				'lg' => esc_html_x( 'Default: Size 2', 'Default: Site Title Size (Large-Screen Devices)', 'pressbook' ),
			),
		);
	}

	/**
	 * Get setting label: Tagline Size.
	 *
	 * @return array
	 */
	public static function get_tagline_size_label() {
		return array(
			'label' => array(
				'sm' => esc_html__( 'Tagline Size (Small-Screen Devices)', 'pressbook' ),
				'md' => esc_html__( 'Tagline Size (Medium-Screen Devices)', 'pressbook' ),
				'lg' => esc_html__( 'Tagline Size (Large-Screen Devices)', 'pressbook' ),
			),
			'desc'  => array(
				'sm' => esc_html_x( 'Default: Size 2', 'Default: Tagline Size (Small-Screen Devices)', 'pressbook' ),
				'md' => esc_html_x( 'Default: Size 2', 'Default: Tagline Size (Medium-Screen Devices)', 'pressbook' ),
				'lg' => esc_html_x( 'Default: Size 2', 'Default: Tagline Size (Large-Screen Devices)', 'pressbook' ),
			),
		);
	}

	/**
	 * Selective Refresh: Size.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param string               $name Setting name.
	 * @param string               $size Screen size.
	 */
	public function selective_refresh_size( $wp_customize, $name, $size ) {
		$wp_customize->selective_refresh->add_partial(
			( 'set_' . $name . '_size[' . $size . ']' ),
			array(
				'selector'            => '.site-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Render site branding for selective refresh.
	 *
	 * @return void
	 */
	public function render_site_branding() {
		get_template_part( 'template-parts/header/site-branding' );
	}

	/**
	 * Get available sizes.
	 *
	 * @return array.
	 */
	public function sizes() {
		return array(
			'1' => esc_html__( 'Size 1', 'pressbook' ),
			'2' => esc_html__( 'Size 2', 'pressbook' ),
			'3' => esc_html__( 'Size 3', 'pressbook' ),
			'4' => esc_html__( 'Size 4', 'pressbook' ),
			'5' => esc_html__( 'Size 5', 'pressbook' ),
		);
	}

	/**
	 * Binds JS handlers to make theme customizer preview reload changes asynchronously.
	 */
	public function customize_preview_scripts() {
		wp_enqueue_script( 'pressbook-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview', 'jquery' ), PRESSBOOK_VERSION, true );

		wp_localize_script(
			'pressbook-customizer',
			'pressbook',
			array(
				'styles'    => CSSRules::output_array(),
				'handle_id' => apply_filters( 'pressbook_inline_style_handle_id', 'pressbook-style-inline-css' ),
			)
		);
	}

	/**
	 * Get site logo title class.
	 *
	 * @return string
	 */
	public static function logo_title_class() {
		$logo_title_classs = 'site-logo-title';
		if ( self::get_hide_site_title() && self::get_hide_site_tagline() ) {
			$logo_title_classs .= ' site-logo-only';
		}

		$top_banner = TopBanner::get_top_banner();
		if ( '' !== wp_get_attachment_image( $top_banner['image'] ) ) {
			if ( ! $top_banner['hide_sm'] ) {
				$logo_title_classs .= ' has-banner-next-sm';
			}

			if ( ! $top_banner['hide_md'] ) {
				$logo_title_classs .= ' has-banner-next-md';
			}

			$logo_title_classs .= ' has-banner-next-lg';
		}

		$logo = self::get_size( 'logo' );
		foreach ( self::SETTING_SIZES as $size ) {
			$logo_title_classs .= ( ' logo--' . $size . '-size-' . $logo[ $size ] );
		}

		return apply_filters( 'pressbook_site_logo_title_classs', $logo_title_classs );
	}

	/**
	 * Get site title class.
	 *
	 * @return string
	 */
	public static function title_class() {
		$title_class = 'site-title';
		if ( self::get_hide_site_title() ) {
			$title_class .= ' hide-clip';
		}

		$site_title = self::get_size( 'site_title' );
		foreach ( self::SETTING_SIZES as $size ) {
			$title_class .= ( ' site-title--' . $size . '-size-' . $site_title[ $size ] );
		}

		return apply_filters( 'pressbook_site_title_class', $title_class );
	}

	/**
	 * Get site tagline class.
	 *
	 * @return string
	 */
	public static function tagline_class() {
		$tagline_class = 'site-tagline';
		if ( self::get_hide_site_tagline() ) {
			$tagline_class .= ' hide-clip';
		}

		$site_tagline = self::get_size( 'tagline' );
		foreach ( self::SETTING_SIZES as $size ) {
			$tagline_class .= ( ' tagline--' . $size . '-size-' . $site_tagline[ $size ] );
		}

		return apply_filters( 'pressbook_site_tagline_class', $tagline_class );
	}
}
