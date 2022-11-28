<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer primary navbar options service.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use PressBook\Options;
use PressBook\CSSRules;

/**
 * Primary navbar options service class.
 */
class PrimaryNavbar extends Options {
	/**
	 * Add primary navbar options for theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_primary_navbar( $wp_customize );

		$this->set_primary_navbar_bg_color( $wp_customize );
		$this->set_primary_navbar_search( $wp_customize );
	}

	/**
	 * Section: Primary Navbar Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_primary_navbar( $wp_customize ) {
		$wp_customize->add_section(
			'sec_primary_navbar',
			array(
				'title'       => esc_html__( 'Primary Navbar', 'pressbook' ),
				'description' => esc_html__( 'You can customize the primary navbar options in here.', 'pressbook' ),
				'priority'    => 153,
			)
		);
	}

	/**
	 * Add setting: Primary Navbar Background Color.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_primary_navbar_bg_color( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[primary_navbar_bg_color]',
			array(
				'default'           => CSSRules::default_styles( 'primary_navbar_bg_color' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_alpha_color' ),
			)
		);

		$wp_customize->add_control(
			new AlphaColorControl(
				$wp_customize,
				'set_styles[primary_navbar_bg_color]',
				array(
					'section'      => 'sec_primary_navbar',
					'label'        => esc_html__( 'Primary Navbar Background Color', 'pressbook' ),
					'settings'     => 'set_styles[primary_navbar_bg_color]',
					'palette'      => true,
					'show_opacity' => true,
				)
			)
		);
	}

	/**
	 * Add setting: Enable Primary Navbar Search Form.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_primary_navbar_search( $wp_customize ) {
		$wp_customize->add_setting(
			'set_primary_navbar_search',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_primary_navbar_search( true ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_primary_navbar_search',
			array(
				'section' => 'sec_primary_navbar',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Enable Primary Navbar Search Form', 'pressbook' ),
			)
		);
	}

	/**
	 * Get setting: Enable Primary Navbar Search Form.
	 *
	 * @param bool $get_default Get default.
	 * @return bool
	 */
	public static function get_primary_navbar_search( $get_default = false ) {
		$default = apply_filters( 'pressbook_default_primary_navbar_search', true );
		if ( $get_default ) {
			return $default;
		}

		return get_theme_mod( 'set_primary_navbar_search', $default );
	}
}
