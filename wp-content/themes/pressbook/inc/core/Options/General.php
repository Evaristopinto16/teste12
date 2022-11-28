<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer general options service.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use PressBook\Options;

/**
 * General options service class.
 */
class General extends Options {
	/**
	 * Add general options for theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_general( $wp_customize );

		$this->set_search_form_button_text( $wp_customize );
		$this->set_read_more_text( $wp_customize );
	}

	/**
	 * Section: General Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_general( $wp_customize ) {
		$wp_customize->add_section(
			'sec_general',
			array(
				'title'       => esc_html__( 'General Options', 'pressbook' ),
				'description' => esc_html__( 'You can customize the general options in here.', 'pressbook' ),
				'priority'    => 156,
			)
		);
	}

	/**
	 * Add setting: Search Form Button Text.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_search_form_button_text( $wp_customize ) {
		$wp_customize->add_setting(
			'set_search_form_button_text',
			array(
				'default'           => self::get_search_form_button_text( true ),
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'set_search_form_button_text',
			array(
				'section'     => 'sec_general',
				'type'        => 'text',
				'label'       => esc_html__( 'Search Form Button Text', 'pressbook' ),
				'description' => esc_html__( 'You can change the search form button text. Leave it empty for default text. This does not change the button text of search form widget block. To change that, you can directly edit the search form widget block in the editor itself.', 'pressbook' ),
			)
		);
	}

	/**
	 * Get setting: Search Form Button Text.
	 *
	 * @param bool $get_default Get default.
	 * @return string
	 */
	public static function get_search_form_button_text( $get_default = false ) {
		$default = apply_filters( 'pressbook_default_search_form_button_text', '' );

		if ( $get_default ) {
			return $default;
		}

		return get_theme_mod( 'set_search_form_button_text', $default );
	}

	/**
	 * Add setting: Read More Text.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_read_more_text( $wp_customize ) {
		$wp_customize->add_setting(
			'set_read_more_text',
			array(
				'default'           => self::get_read_more_text( true ),
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'set_read_more_text',
			array(
				'section'     => 'sec_general',
				'type'        => 'text',
				'label'       => esc_html__( 'Read More Text', 'pressbook' ),
				'description' => esc_html__( 'You can change the "Read More" text. Leave it empty for default text.', 'pressbook' ),
			)
		);
	}

	/**
	 * Get setting: Read More Text.
	 *
	 * @param bool $get_default Get default.
	 * @return string
	 */
	public static function get_read_more_text( $get_default = false ) {
		$default = apply_filters( 'pressbook_default_read_more_text', '' );

		if ( $get_default ) {
			return $default;
		}

		return get_theme_mod( 'set_read_more_text', $default );
	}
}
