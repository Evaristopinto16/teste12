<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer top navbar options service.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use PressBook\Options;
use PressBook\CSSRules;

/**
 * Top navbar options service class.
 */
class TopNavbar extends Options {
	/**
	 * Add top navbar options for theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_top_navbar( $wp_customize );

		$this->set_top_navbar_bg_color_1( $wp_customize );
		$this->set_top_navbar_bg_color_2( $wp_customize );
	}

	/**
	 * Section: Top Navbar Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_top_navbar( $wp_customize ) {
		$wp_customize->add_section(
			'sec_top_navbar',
			array(
				'title'       => esc_html__( 'Top Navbar', 'pressbook' ),
				'description' => esc_html__( 'You can customize the top navbar options in here.', 'pressbook' ),
				'priority'    => 151,
			)
		);
	}

	/**
	 * Add setting: Top Navbar Background Color 1.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_top_navbar_bg_color_1( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[top_navbar_bg_color_1]',
			array(
				'default'           => CSSRules::default_styles( 'top_navbar_bg_color_1' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_alpha_color' ),
			)
		);

		$wp_customize->add_control(
			new AlphaColorControl(
				$wp_customize,
				'set_styles[top_navbar_bg_color_1]',
				array(
					'section'      => 'sec_top_navbar',
					'label'        => esc_html__( 'Top Navbar Gradient Background 1', 'pressbook' ),
					'settings'     => 'set_styles[top_navbar_bg_color_1]',
					'palette'      => true,
					'show_opacity' => true,
				)
			)
		);
	}

	/**
	 * Add setting: Top Navbar Background Color 1.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_top_navbar_bg_color_2( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[top_navbar_bg_color_2]',
			array(
				'default'           => CSSRules::default_styles( 'top_navbar_bg_color_2' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_alpha_color' ),
			)
		);

		$wp_customize->add_control(
			new AlphaColorControl(
				$wp_customize,
				'set_styles[top_navbar_bg_color_2]',
				array(
					'section'      => 'sec_top_navbar',
					'label'        => esc_html__( 'Top Navbar Gradient Background 2', 'pressbook' ),
					'settings'     => 'set_styles[top_navbar_bg_color_2]',
					'palette'      => true,
					'show_opacity' => true,
				)
			)
		);
	}
}
