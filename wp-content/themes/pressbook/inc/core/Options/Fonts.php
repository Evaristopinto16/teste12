<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer fonts options service.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use PressBook\Options;
use PressBook\CSSRules;

/**
 * Fonts options service class.
 */
class Fonts extends Options {
	/**
	 * Fonts choices.
	 *
	 * @var array
	 */
	protected $choices = array();

	/**
	 * Add fonts options for theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_fonts( $wp_customize );

		$this->set_button_font_wgt( $wp_customize );
		$this->set_heading_font_wgt( $wp_customize );
		$this->set_site_title_font_wgt( $wp_customize );
	}

	/**
	 * Section: Fonts Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_fonts( $wp_customize ) {
		$wp_customize->add_section(
			'sec_fonts',
			array(
				'title'       => esc_html__( 'Fonts', 'pressbook' ),
				'description' => esc_html__( 'You can customize the fonts options in here.', 'pressbook' ),
				'priority'    => 42,
			)
		);
	}

	/**
	 * Add setting: Button Font Weight.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_button_font_wgt( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[button_font_wgt]',
			array(
				'default'           => CSSRules::default_styles( 'button_font_wgt' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_styles[button_font_wgt]',
			array(
				'section'     => 'sec_fonts',
				'type'        => 'select',
				'choices'     => $this->font_weights(),
				'label'       => esc_html__( 'Button Font Weight', 'pressbook' ),
				'description' => esc_html__( 'Default: 600', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Heading Font Weight.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_heading_font_wgt( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[heading_font_wgt]',
			array(
				'default'           => CSSRules::default_styles( 'heading_font_wgt' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_styles[heading_font_wgt]',
			array(
				'section'     => 'sec_fonts',
				'type'        => 'select',
				'choices'     => $this->font_weights(),
				'label'       => esc_html__( 'Heading Font Weight', 'pressbook' ),
				'description' => esc_html__( 'Default: 700', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Site Title Font Weight.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_site_title_font_wgt( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[site_title_font_wgt]',
			array(
				'default'           => CSSRules::default_styles( 'site_title_font_wgt' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_styles[site_title_font_wgt]',
			array(
				'section'     => 'sec_fonts',
				'type'        => 'select',
				'choices'     => $this->font_weights(),
				'label'       => esc_html__( 'Site Title Font Weight', 'pressbook' ),
				'description' => esc_html__( 'Default: 700', 'pressbook' ),
			)
		);
	}

	/**
	 * Font Weights.
	 *
	 * @return array
	 */
	public function font_weights() {
		return array(
			'400' => esc_html_x( '400', 'Font Weight', 'pressbook' ),
			'500' => esc_html_x( '500', 'Font Weight', 'pressbook' ),
			'600' => esc_html_x( '600', 'Font Weight', 'pressbook' ),
			'700' => esc_html_x( '700', 'Font Weight', 'pressbook' ),
		);
	}
}
