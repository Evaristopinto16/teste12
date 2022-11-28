<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer sidebar layout options service.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use PressBook\Options;
use PressBook\CSSRules;

/**
 * Sidebar layout options service class.
 */
class Sidebar extends Options {
	/**
	 * Add sidebar layout options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_sidebar( $wp_customize );

		$this->set_side_widget_layout_double_lg( $wp_customize );

		$this->set_side_widget_border_color( $wp_customize );

		$this->set_side_widget_no_t_padding( $wp_customize );
		$this->set_side_widget_no_b_padding( $wp_customize );
		$this->set_side_widget_no_x_padding( $wp_customize );
		$this->set_side_widget_no_shadow( $wp_customize );

		$this->set_sticky_sidebar( $wp_customize );
	}

	/**
	 * Section: Sidebar Layout Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_sidebar( $wp_customize ) {
		$wp_customize->add_section(
			'sec_sidebar',
			array(
				'title'       => esc_html__( 'Sidebar Layout', 'pressbook' ),
				'description' => esc_html__( 'You can customize the sidebar layout options in here.', 'pressbook' ),
				'priority'    => 155,
			)
		);
	}

	/**
	 * Add setting: Double Sidebars Layout (Large-Screen Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_side_widget_layout_double_lg( $wp_customize ) {
		$wp_customize->add_setting(
			'set_side_widget[layout_double_lg]',
			array(
				'default'           => self::get_side_widget_default( 'layout_double_lg' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_side_widget[layout_double_lg]',
			array(
				'section'     => 'sec_sidebar',
				'type'        => 'radio',
				'choices'     => array(
					''      => esc_html__( 'One Left and One Right', 'pressbook' ),
					'left'  => esc_html__( 'Both Sidebars to the Left', 'pressbook' ),
					'right' => esc_html__( 'Both Sidebars to the Right', 'pressbook' ),
				),
				'label'       => esc_html__( 'Double Sidebars Layout (Large-Screen Devices)', 'pressbook' ),
				'description' => esc_html__( 'Set the layout for the double sidebars. This applies only when both the sidebars (left and right) are active. A sidebar is active when there is at least one widget in it.', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Side Widget Border Color.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_side_widget_border_color( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[side_widget_border_color]',
			array(
				'default'           => CSSRules::default_styles( 'side_widget_border_color' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_alpha_color' ),
			)
		);

		$wp_customize->add_control(
			new AlphaColorControl(
				$wp_customize,
				'set_styles[side_widget_border_color]',
				array(
					'section'      => 'sec_sidebar',
					'label'        => esc_html__( 'Side Widget Border Color', 'pressbook' ),
					'settings'     => 'set_styles[side_widget_border_color]',
					'palette'      => Colors::default_alpha_palette(),
					'show_opacity' => true,
				)
			)
		);
	}

	/**
	 * Add setting: Remove Top Padding.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_side_widget_no_t_padding( $wp_customize ) {
		$wp_customize->add_setting(
			'set_side_widget[no_t_padding]',
			array(
				'default'           => self::get_side_widget_default( 'no_t_padding' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_side_widget[no_t_padding]',
			array(
				'section' => 'sec_sidebar',
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
	public function set_side_widget_no_b_padding( $wp_customize ) {
		$wp_customize->add_setting(
			'set_side_widget[no_b_padding]',
			array(
				'default'           => self::get_side_widget_default( 'no_b_padding' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_side_widget[no_b_padding]',
			array(
				'section' => 'sec_sidebar',
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
	public function set_side_widget_no_x_padding( $wp_customize ) {
		$wp_customize->add_setting(
			'set_side_widget[no_x_padding]',
			array(
				'default'           => self::get_side_widget_default( 'no_x_padding' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_side_widget[no_x_padding]',
			array(
				'section' => 'sec_sidebar',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Remove Horizontal Padding', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Remove Box Shadow.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_side_widget_no_shadow( $wp_customize ) {
		$wp_customize->add_setting(
			'set_side_widget[no_shadow]',
			array(
				'default'           => self::get_side_widget_default( 'no_shadow' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_side_widget[no_shadow]',
			array(
				'section' => 'sec_sidebar',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Remove Box Shadow', 'pressbook' ),
			)
		);
	}

	/**
	 * Get setting: Side Widget.
	 *
	 * @return array
	 */
	public static function get_side_widget() {
		return wp_parse_args(
			get_theme_mod( 'set_side_widget', array() ),
			self::get_side_widget_default()
		);
	}

	/**
	 * Get default setting: Side Widget.
	 *
	 * @param string $key Setting key.
	 * @return mixed|array
	 */
	public static function get_side_widget_default( $key = '' ) {
		$default = apply_filters(
			'pressbook_default_side_widget',
			array(
				'layout_double_lg' => '',
				'no_t_padding'     => false,
				'no_b_padding'     => false,
				'no_x_padding'     => false,
				'no_shadow'        => false,
			)
		);

		if ( array_key_exists( $key, $default ) ) {
			return $default[ $key ];
		}

		return $default;
	}

	/**
	 * Add setting: Sticky Sidebar.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_sticky_sidebar( $wp_customize ) {
		$wp_customize->add_setting(
			'set_sticky_sidebar',
			array(
				'default'           => self::get_sticky_sidebar( true ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_sticky_sidebar',
			array(
				'section'     => 'sec_sidebar',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Sticky-Floating Sidebar', 'pressbook' ),
				'description' => esc_html__( 'You can enable or disable sticky sidebar that floats on scrolling.', 'pressbook' ),
			)
		);
	}

	/**
	 * Get setting: Sticky Sidebar.
	 *
	 * @param bool $get_default Get default.
	 * @return bool
	 */
	public static function get_sticky_sidebar( $get_default = false ) {
		$default = apply_filters( 'pressbook_default_sticky_sidebar', true );
		if ( $get_default ) {
			return $default;
		}

		return get_theme_mod( 'set_sticky_sidebar', $default );
	}

	/**
	 * Get body classes for side widget.
	 *
	 * @return string
	 */
	public static function get_side_widget_body_class() {
		$side_widget = self::get_side_widget();

		$body_class = '';
		if ( $side_widget['layout_double_lg'] ) {
			$body_class .= ' side-widget-ld-lg-' . esc_attr( $side_widget['layout_double_lg'] );
		}
		if ( $side_widget['no_t_padding'] ) {
			$body_class .= ' side-widget-no-t-padding';
		}
		if ( $side_widget['no_b_padding'] ) {
			$body_class .= ' side-widget-no-b-padding';
		}
		if ( $side_widget['no_x_padding'] ) {
			$body_class .= ' side-widget-no-x-padding';
		}
		if ( $side_widget['no_shadow'] ) {
			$body_class .= ' side-widget-no-shadow';
		}

		return ltrim( $body_class );
	}

	/**
	 * Get sticky sidebar breakpoint screen width.
	 *
	 * @return int
	 */
	public static function get_sticky_breakpoint() {
		$double_bp = 1279;
		$single_bp = 1023;

		if ( is_active_sidebar( 'sidebar-1' ) ) {
			if ( is_active_sidebar( 'sidebar-2' ) ) {
				return $double_bp;
			} else {
				return $single_bp;
			}
		} elseif ( is_active_sidebar( 'sidebar-2' ) ) {
			return $single_bp;
		} else {
			return $single_bp;
		}
	}
}
