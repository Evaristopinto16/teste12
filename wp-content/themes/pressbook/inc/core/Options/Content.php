<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer content layout options service.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use PressBook\Options;

/**
 * Content layout options service class.
 */
class Content extends Options {
	/**
	 * Add content layout options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_content( $wp_customize );

		$this->set_content_layout_no_t_padding( $wp_customize );
		$this->set_content_layout_no_b_padding( $wp_customize );
		$this->set_content_layout_no_x_padding( $wp_customize );
	}

	/**
	 * Section: Content Layout Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_content( $wp_customize ) {
		$wp_customize->add_section(
			'sec_content',
			array(
				'title'       => esc_html__( 'Content Layout', 'pressbook' ),
				'description' => esc_html__( 'You can customize the content layout options in here.', 'pressbook' ),
				'priority'    => 154,
			)
		);
	}

	/**
	 * Add setting: Remove Top Padding.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_content_layout_no_t_padding( $wp_customize ) {
		$wp_customize->add_setting(
			'set_content_layout[no_t_padding]',
			array(
				'default'           => self::get_content_layout_default( 'no_t_padding' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_content_layout[no_t_padding]',
			array(
				'section' => 'sec_content',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Remove Top Padding', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Remove Bottom Padding.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_content_layout_no_b_padding( $wp_customize ) {
		$wp_customize->add_setting(
			'set_content_layout[no_b_padding]',
			array(
				'default'           => self::get_content_layout_default( 'no_b_padding' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_content_layout[no_b_padding]',
			array(
				'section' => 'sec_content',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Remove Bottom Padding', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Remove Horizontal Padding.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_content_layout_no_x_padding( $wp_customize ) {
		$wp_customize->add_setting(
			'set_content_layout[no_x_padding]',
			array(
				'default'           => self::get_content_layout_default( 'no_x_padding' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_content_layout[no_x_padding]',
			array(
				'section' => 'sec_content',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Remove Horizontal Padding', 'pressbook' ),
			)
		);
	}

	/**
	 * Get setting: Content Layout.
	 *
	 * @return array
	 */
	public static function get_content_layout() {
		return wp_parse_args(
			get_theme_mod( 'set_content_layout', array() ),
			self::get_content_layout_default()
		);
	}

	/**
	 * Get default setting: Content Layout.
	 *
	 * @param string $key Setting key.
	 * @return mixed|array
	 */
	public static function get_content_layout_default( $key = '' ) {
		$default = apply_filters(
			'pressbook_default_content_layout',
			array(
				'no_t_padding' => false,
				'no_b_padding' => false,
				'no_x_padding' => false,
			)
		);

		if ( array_key_exists( $key, $default ) ) {
			return $default[ $key ];
		}

		return $default;
	}

	/**
	 * Get body classes for content layout.
	 *
	 * @return string
	 */
	public static function get_content_layout_body_class() {
		$content_layout = self::get_content_layout();

		$body_class = '';
		if ( $content_layout['no_t_padding'] ) {
			$body_class .= ' content-no-t-padding';
		}
		if ( $content_layout['no_b_padding'] ) {
			$body_class .= ' content-no-b-padding';
		}
		if ( $content_layout['no_x_padding'] ) {
			$body_class .= ' content-no-x-padding';
		}

		return ltrim( $body_class );
	}
}
