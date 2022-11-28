<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer colors options service.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use PressBook\Options;
use PressBook\CSSRules;

/**
 * Colors options service class.
 */
class Colors extends Options {
	/**
	 * Add colors options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->set_header_bg_color( $wp_customize );
		$this->set_site_title_color( $wp_customize );
		$this->set_tagline_color( $wp_customize );

		$this->set_button_bg_color_1( $wp_customize );
		$this->set_button_bg_color_2( $wp_customize );
	}

	/**
	 * Add setting: Header Background Color.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_header_bg_color( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[header_bg_color]',
			array(
				'default'           => CSSRules::default_styles( 'header_bg_color' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_alpha_color' ),
			)
		);

		$wp_customize->add_control(
			new AlphaColorControl(
				$wp_customize,
				'set_styles[header_bg_color]',
				array(
					'section'      => 'colors',
					'label'        => esc_html__( 'Header Background Color', 'pressbook' ),
					'settings'     => 'set_styles[header_bg_color]',
					'palette'      => self::default_alpha_palette(),
					'show_opacity' => true,
				)
			)
		);
	}

	/**
	 * Add setting: Site Title Color.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_site_title_color( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[site_title_color]',
			array(
				'default'           => CSSRules::default_styles( 'site_title_color' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'set_styles[site_title_color]',
				array(
					'section' => 'colors',
					'label'   => esc_html__( 'Site Title Color', 'pressbook' ),
				)
			)
		);
	}

	/**
	 * Add setting: Tagline Color.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_tagline_color( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[tagline_color]',
			array(
				'default'           => CSSRules::default_styles( 'tagline_color' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'set_styles[tagline_color]',
				array(
					'section' => 'colors',
					'label'   => esc_html__( 'Tagline Color', 'pressbook' ),
				)
			)
		);
	}

	/**
	 * Add setting: Button Background Color 1.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_button_bg_color_1( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[button_bg_color_1]',
			array(
				'default'           => CSSRules::default_styles( 'button_bg_color_1' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_alpha_color' ),
			)
		);

		$wp_customize->add_control(
			new AlphaColorControl(
				$wp_customize,
				'set_styles[button_bg_color_1]',
				array(
					'section'      => 'colors',
					'label'        => esc_html__( 'Button Gradient Background 1', 'pressbook' ),
					'settings'     => 'set_styles[button_bg_color_1]',
					'palette'      => true,
					'show_opacity' => true,
				)
			)
		);
	}

	/**
	 * Add setting: Button Background Color 2.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_button_bg_color_2( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[button_bg_color_2]',
			array(
				'default'           => CSSRules::default_styles( 'button_bg_color_2' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_alpha_color' ),
			)
		);

		$wp_customize->add_control(
			new AlphaColorControl(
				$wp_customize,
				'set_styles[button_bg_color_2]',
				array(
					'section'      => 'colors',
					'label'        => esc_html__( 'Button Gradient Background 2', 'pressbook' ),
					'settings'     => 'set_styles[button_bg_color_2]',
					'palette'      => true,
					'show_opacity' => true,
				)
			)
		);
	}

	/**
	 * Get default alpha color palette.
	 *
	 * @return array
	 */
	public static function default_alpha_palette() {
		return apply_filters(
			'pressbook_default_alpha_color_palette',
			array(
				'#ffffff',
				'#000000',
				'rgba(28,28,28,0.95)',
				'rgba(7,18,66,0.95)',
				'rgba(0,33,21,0.95)',
				'rgba(0,0,0,0.8)',
				'rgba(22,0,0,0.95)',
			)
		);
	}
}
