<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer site identity options service.
 *
 * @package PressBook_Masonry_Dark
 */

/**
 * Site identity options service class.
 */
class PressBook_Masonry_Dark_SiteIdentity extends PressBook\Options\SiteIdentity {
	/**
	 * Register service features.
	 */
	public function register() {
		parent::register();

		add_action( 'customize_register', array( $this, 'modify_options' ) );
		add_action( 'customize_preview_init', array( $this, 'localize_script' ), 11 );

		add_filter( 'pressbook_default_logo_size', array( $this, 'get_logo_size_default' ) );
		add_filter( 'pressbook_default_site_title_size', array( $this, 'get_site_title_size_default' ) );
		add_filter( 'pressbook_default_tagline_size', array( $this, 'get_tagline_size_default' ) );
	}

	/**
	 * Modify site identity options for theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function modify_options( $wp_customize ) {
		$wp_customize->get_control( 'set_logo_size[sm]' )->description = esc_html_x( 'Default: Size 2', 'Default: Logo Size (Small-Screen Devices)', 'pressbook-masonry-dark' );
		$wp_customize->get_control( 'set_logo_size[md]' )->description = esc_html_x( 'Default: Size 5', 'Default: Logo Size (Medium-Screen Devices)', 'pressbook-masonry-dark' );
		$wp_customize->get_control( 'set_logo_size[lg]' )->description = esc_html_x( 'Default: Size 6', 'Default: Logo Size (Large-Screen Devices)', 'pressbook-masonry-dark' );

		$wp_customize->get_control( 'set_site_title_size[sm]' )->description = esc_html_x( 'Default: Size 3', 'Default: Site Title Size (Small-Screen Devices)', 'pressbook-masonry-dark' );
		$wp_customize->get_control( 'set_site_title_size[md]' )->description = esc_html_x( 'Default: Size 6', 'Default: Site Title Size (Medium-Screen Devices)', 'pressbook-masonry-dark' );
		$wp_customize->get_control( 'set_site_title_size[lg]' )->description = esc_html_x( 'Default: Size 5', 'Default: Site Title Size (Large-Screen Devices)', 'pressbook-masonry-dark' );

		$wp_customize->get_control( 'set_tagline_size[sm]' )->description = esc_html_x( 'Default: Size 2', 'Default: Tagline (Small-Screen Devices)', 'pressbook-masonry-dark' );
		$wp_customize->get_control( 'set_tagline_size[md]' )->description = esc_html_x( 'Default: Size 4', 'Default: Tagline (Medium-Screen Devices)', 'pressbook-masonry-dark' );
		$wp_customize->get_control( 'set_tagline_size[lg]' )->description = esc_html_x( 'Default: Size 5', 'Default: Tagline (Large-Screen Devices)', 'pressbook-masonry-dark' );
	}

	/**
	 * Binds JS handlers to make theme customizer preview reload changes asynchronously.
	 */
	public function localize_script() {
		wp_localize_script(
			'pressbook-customizer',
			'pressbook',
			array(
				'styles'    => PressBook_Masonry_Dark_CSSRules::output_array(),
				'handle_id' => apply_filters( 'pressbook_masonry_dark_inline_style_handle_id', 'pressbook-masonry-dark-style-inline-css' ),
			)
		);
	}

	/**
	 * Get default setting: Logo Size.
	 *
	 * @return array
	 */
	public static function get_logo_size_default() {
		return array(
			'sm' => 2,
			'md' => 5,
			'lg' => 6,
		);
	}

	/**
	 * Get default setting: Size Title Size.
	 *
	 * @return array
	 */
	public static function get_site_title_size_default() {
		return array(
			'sm' => 3,
			'md' => 6,
			'lg' => 5,
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
			'md' => 4,
			'lg' => 5,
		);
	}

	/**
	 * Get available sizes.
	 *
	 * @return array.
	 */
	public function sizes() {
		return array_replace(
			parent::sizes(),
			array(
				'6' => esc_html__( 'Size 6', 'pressbook-masonry-dark' ),
				'7' => esc_html__( 'Size 7', 'pressbook-masonry-dark' ),
				'8' => esc_html__( 'Size 8', 'pressbook-masonry-dark' ),
			)
		);
	}
}
