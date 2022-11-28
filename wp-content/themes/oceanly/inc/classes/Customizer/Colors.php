<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Colors options service.
 *
 * @package Oceanly
 */

namespace Oceanly\Customizer;

use Oceanly\Customizer;
use Oceanly\Defaults;
use \WP_Customize_Color_Control;

/**
 * Colors options service class.
 */
class Colors extends Customizer {
	/**
	 * Add colors options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->set_header_bg_color( $wp_customize );
	}

	/**
	 * Setting: Header Background Color.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_header_bg_color( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[header_bg_color]',
			array(
				'default'           => Defaults::styles( 'header_bg_color' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'set_styles[header_bg_color]',
				array(
					'section' => 'colors',
					'label'   => esc_html__( 'Header Background Color', 'oceanly' ),
				)
			)
		);
	}
}
