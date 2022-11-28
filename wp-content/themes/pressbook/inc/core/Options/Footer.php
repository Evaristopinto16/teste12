<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer footer options service.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use PressBook\Options;
use PressBook\CSSRules;

/**
 * Footer options service class.
 */
class Footer extends Options {
	/**
	 * Add footer options for theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_footer( $wp_customize );

		$this->set_copyright_text( $wp_customize );
		$this->set_hide_go_to_top( $wp_customize );

		$this->set_footer_bg_color( $wp_customize );
		$this->set_footer_credit_link_color( $wp_customize );
	}

	/**
	 * Section: Footer Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_footer( $wp_customize ) {
		$wp_customize->add_section(
			'sec_footer',
			array(
				'title'       => esc_html__( 'Footer Options', 'pressbook' ),
				'description' => esc_html__( 'You can customize the footer options in here.', 'pressbook' ),
				'priority'    => 160,
			)
		);
	}

	/**
	 * Add setting: Copyright Text.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_copyright_text( $wp_customize ) {
		$wp_customize->add_setting(
			'set_copyright_text',
			array(
				'default'           => self::get_copyright_text( true ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_copyright_text' ),
			)
		);

		$wp_customize->add_control(
			'set_copyright_text',
			array(
				'section'     => 'sec_footer',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Copyright Text', 'pressbook' ),
				'description' => esc_html__( 'You can change the copyright text in the footer. You may use the following tags: em, strong, span, a, br.', 'pressbook' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_copyright_text',
			array(
				'selector'            => '.copyright-text',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_copyright_text' ),
			)
		);
	}

	/**
	 * Get setting: Copyright Text.
	 *
	 * @param bool $get_default Get default.
	 * @return string
	 */
	public static function get_copyright_text( $get_default = false ) {
		$default = apply_filters(
			'pressbook_default_copyright_text',
			sprintf(
				/* translators: 1: current year, 2: blog name */
				esc_html__( 'Copyright &copy; %1$s %2$s.', 'pressbook' ),
				esc_html( date_i18n( _x( 'Y', 'copyright date format', 'pressbook' ) ) ),
				get_bloginfo( 'name', 'display' ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			)
		);

		if ( $get_default ) {
			return $default;
		}

		return get_theme_mod( 'set_copyright_text', $default );
	}

	/**
	 * Render copyright text for selective refresh.
	 *
	 * @return void
	 */
	public function render_copyright_text() {
		get_template_part( 'template-parts/footer/copyright-text' );
	}

	/**
	 * Add setting: Hide Go To Top Button.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_hide_go_to_top( $wp_customize ) {
		$wp_customize->add_setting(
			'set_hide_go_to_top',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_hide_go_to_top( true ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_hide_go_to_top',
			array(
				'section' => 'sec_footer',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Hide Go To Top Button', 'pressbook' ),
			)
		);
	}

	/**
	 * Get setting: Hide Go To Top Button.
	 *
	 * @param bool $get_default Get default.
	 * @return bool
	 */
	public static function get_hide_go_to_top( $get_default = false ) {
		$default = apply_filters( 'pressbook_default_hide_go_to_top', false );
		if ( $get_default ) {
			return $default;
		}

		return get_theme_mod( 'set_hide_go_to_top', $default );
	}


	/**
	 * Add setting: Footer Background Color.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_footer_bg_color( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[footer_bg_color]',
			array(
				'default'           => CSSRules::default_styles( 'footer_bg_color' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_alpha_color' ),
			)
		);

		$wp_customize->add_control(
			new AlphaColorControl(
				$wp_customize,
				'set_styles[footer_bg_color]',
				array(
					'section'      => 'sec_footer',
					'label'        => esc_html__( 'Footer Background Color', 'pressbook' ),
					'settings'     => 'set_styles[footer_bg_color]',
					'palette'      => Colors::default_alpha_palette(),
					'show_opacity' => true,
				)
			)
		);
	}

	/**
	 * Add setting: Footer Credit Link Color.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_footer_credit_link_color( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[footer_credit_link_color]',
			array(
				'default'           => CSSRules::default_styles( 'footer_credit_link_color' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'set_styles[footer_credit_link_color]',
				array(
					'section' => 'sec_footer',
					'label'   => esc_html__( 'Footer Credit Link Color', 'pressbook' ),
				)
			)
		);
	}

	/**
	 * Get allowed tags for copyright text.
	 *
	 * @return array
	 */
	public static function copyright_text_allowed_tags() {
		return apply_filters(
			'pressbook_copyright_text_allowed_tags',
			array(
				'span'   => array( 'class' => array() ),
				'em'     => array(),
				'strong' => array(),
				'br'     => array(),
				'a'      => array(
					'href'  => array(),
					'title' => array(),
					'rel'   => array(),
					'class' => array(),
				),
			)
		);
	}
}
