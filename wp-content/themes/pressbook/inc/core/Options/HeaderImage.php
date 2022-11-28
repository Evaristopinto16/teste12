<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer header image options service.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use PressBook\Options;
use PressBook\CSSRules;

/**
 * Header image options service class.
 */
class HeaderImage extends Options {
	/**
	 * Add header image options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->set_header_bg_position( $wp_customize );
		$this->set_header_bg_repeat( $wp_customize );
		$this->set_header_bg_size( $wp_customize );
	}

	/**
	 * Add setting: Header Background Position.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_header_bg_position( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[header_bg_position]',
			array(
				'default'           => CSSRules::default_styles( 'header_bg_position' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_styles[header_bg_position]',
			array(
				'section'     => 'header_image',
				'type'        => 'select',
				'choices'     => $this->background_positions(),
				'label'       => esc_html__( 'Header Background Position', 'pressbook' ),
				'description' => esc_html__( 'Default: Center Center', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Header Background Repeat.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_header_bg_repeat( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[header_bg_repeat]',
			array(
				'default'           => CSSRules::default_styles( 'header_bg_repeat' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_styles[header_bg_repeat]',
			array(
				'section'     => 'header_image',
				'type'        => 'radio',
				'choices'     => $this->background_repeat(),
				'label'       => esc_html__( 'Header Background Repeat', 'pressbook' ),
				'description' => esc_html__( 'Default: Repeat', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Header Background Size.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_header_bg_size( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[header_bg_size]',
			array(
				'default'           => CSSRules::default_styles( 'header_bg_size' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_styles[header_bg_size]',
			array(
				'section'     => 'header_image',
				'type'        => 'radio',
				'choices'     => $this->background_sizes(),
				'label'       => esc_html__( 'Header Background Size', 'pressbook' ),
				'description' => esc_html__( 'Default: Contain', 'pressbook' ),
			)
		);
	}

	/**
	 * Background Positions.
	 *
	 * @return array
	 */
	public function background_positions() {
		return array(
			'left-top'      => esc_html__( 'Left Top', 'pressbook' ),
			'left-center'   => esc_html__( 'Left Center', 'pressbook' ),
			'left-bottom'   => esc_html__( 'Left Bottom', 'pressbook' ),
			'right-top'     => esc_html__( 'Right Top', 'pressbook' ),
			'right-center'  => esc_html__( 'Right Center', 'pressbook' ),
			'right-bottom'  => esc_html__( 'Right Bottom', 'pressbook' ),
			'center-top'    => esc_html__( 'Center Top', 'pressbook' ),
			'center-center' => esc_html__( 'Center Center', 'pressbook' ),
			'center-bottom' => esc_html__( 'Center Bottom', 'pressbook' ),
		);
	}

	/**
	 * Background Repeat.
	 *
	 * @return array
	 */
	public function background_repeat() {
		return array(
			'repeat'    => esc_html__( 'Repeat', 'pressbook' ),
			'repeat-x'  => esc_html__( 'Repeat X', 'pressbook' ),
			'repeat-y'  => esc_html__( 'Repeat Y', 'pressbook' ),
			'no-repeat' => esc_html__( 'No Repeat', 'pressbook' ),
		);
	}

	/**
	 * Background Sizes.
	 *
	 * @return array
	 */
	public function background_sizes() {
		return array(
			'auto'    => esc_html__( 'Auto', 'pressbook' ),
			'cover'   => esc_html__( 'Cover', 'pressbook' ),
			'contain' => esc_html__( 'Contain', 'pressbook' ),
		);
	}
}
