<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * CSS Rules.
 *
 * @package PressBook
 */

namespace PressBook;

use PressBook\Options\Sanitizer;

/**
 * Generate dynamic CSS rules for theme.
 */
class CSSRules {
	/**
	 * CSS rules for the final output.
	 *
	 * @return string.
	 */
	public static function output() {
		$saved_styles = self::saved_styles();

		$styles_keys = array_keys( $saved_styles );

		$output = '';

		foreach ( $styles_keys as $styles_key ) {
			if ( method_exists( static::class, $styles_key ) ) {
				$rules = static::$styles_key( $saved_styles[ $styles_key ] );

				foreach ( $rules as $selector => $props ) {
					$output_selector = ( $selector . '{' );
					$append_selector = false;

					foreach ( $props as $prop => $value ) {
						if ( ! array_key_exists( 'skip', $value ) ) {
							$output_selector .= ( $prop . ':' . $value['value'] . ';' );
							$append_selector  = true;
						}
					}

					$output_selector .= '}';

					if ( $append_selector ) {
						$output .= $output_selector;
					}
				}
			}
		}

		return $output;
	}

	/**
	 * CSS rules for the final output in array format.
	 *
	 * @return array.
	 */
	public static function output_array() {
		$saved_styles = self::saved_styles();

		$styles_keys = array_keys( $saved_styles );

		$output = array();

		foreach ( $styles_keys as $styles_key ) {

			$output[ $styles_key ] = array();

			if ( method_exists( static::class, $styles_key ) ) {
				$rules = static::$styles_key( $saved_styles[ $styles_key ] );

				foreach ( $rules as $selector => $props ) {
					$output[ $styles_key ][ $selector ] = $props;
				}
			}
		}

		return $output;
	}

	/**
	 * CSS rules for the final output in the editor.
	 */
	public static function output_editor() {
		$saved_styles = self::saved_styles();

		$styles_keys = Editor::styles_keys();

		$output = '';

		foreach ( $styles_keys as $styles_key ) {
			if ( method_exists( Editor::class, $styles_key ) ) {
				$rules = Editor::$styles_key( $saved_styles[ $styles_key ] );

				foreach ( $rules as $selector => $props ) {
					$output_selector = ( '.block-editor-page ' . str_replace( ',', ',.block-editor-page ', $selector ) . '{' );
					$append_selector = false;

					foreach ( $props as $prop => $value ) {
						if ( ! array_key_exists( 'skip', $value ) ) {
							$output_selector .= ( $prop . ':' . $value['value'] . ';' );
							$append_selector  = true;
						}
					}

					$output_selector .= '}';

					if ( $append_selector ) {
						$output .= $output_selector;
					}
				}
			}
		}

		return $output;
	}

	/**
	 * CSS rules for the final output in the widgets editor legacy.
	 */
	public static function output_widgets_editor_legacy() {
		$saved_styles = self::saved_styles();

		$styles_keys = Widget::legacy_styles_keys();

		$output = '';

		foreach ( $styles_keys as $styles_key ) {
			if ( method_exists( static::class, $styles_key ) ) {
				$rules = static::$styles_key( $saved_styles[ $styles_key ] );

				foreach ( $rules as $selector => $props ) {
					$output_selector = ( $selector . '{' );
					$append_selector = false;

					foreach ( $props as $prop => $value ) {
						if ( ! array_key_exists( 'skip', $value ) ) {
							$output_selector .= ( $prop . ':' . $value['value'] . ';' );
							$append_selector  = true;
						}
					}

					$output_selector .= '}';

					if ( $append_selector ) {
						$output .= $output_selector;
					}
				}
			}
		}

		return $output;
	}

	/**
	 * Get saved styles.
	 *
	 * @return array.
	 */
	public static function saved_styles() {
		return wp_parse_args(
			get_theme_mod( 'set_styles', array() ),
			self::default_styles()
		);
	}

	/**
	 * Get default styles.
	 *
	 * @param string $key Color setting key.
	 * @return string|array.
	 */
	public static function default_styles( $key = '' ) {
		$styles = apply_filters(
			'pressbook_default_styles',
			array(
				'header_bg_position'       => 'center-center',
				'header_bg_repeat'         => 'repeat',
				'header_bg_size'           => 'contain',
				'top_banner_max_height'    => '150',
				'top_navbar_bg_color_1'    => '#166dd6',
				'top_navbar_bg_color_2'    => '#1257ab',
				'primary_navbar_bg_color'  => '#166dd6',
				'header_bg_color'          => '#ffffff',
				'site_title_color'         => '#404040',
				'tagline_color'            => '#979797',
				'button_bg_color_1'        => '#f3c841',
				'button_bg_color_2'        => '#f69275',
				'button_font_wgt'          => '600',
				'heading_font_wgt'         => '700',
				'site_title_font_wgt'      => '700',
				'side_widget_border_color' => '#fafafa',
				'footer_bg_color'          => '#232323',
				'footer_credit_link_color' => '#f69275',
			)
		);

		if ( array_key_exists( $key, $styles ) ) {
			return $styles[ $key ];
		}

		return $styles;
	}

	/**
	 * Header Background Position.
	 *
	 * @param string $value Position value.
	 * @return array
	 */
	public static function header_bg_position( $value ) {
		return array(
			'.site-branding' => array(
				'background-position' => array(
					'value' => esc_attr( str_replace( '-', ' ', $value ) ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Header Background Repeat.
	 *
	 * @param string $value Repeat value.
	 * @return array
	 */
	public static function header_bg_repeat( $value ) {
		return array(
			'.site-branding' => array(
				'background-repeat' => array(
					'value' => esc_attr( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Header Background Size.
	 *
	 * @param string $value Size value.
	 * @return array
	 */
	public static function header_bg_size( $value ) {
		return array(
			'.site-branding' => array(
				'background-size' => array(
					'value' => esc_attr( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Top Banner Max Height.
	 *
	 * @param string $value Max Height value.
	 * @return array
	 */
	public static function top_banner_max_height( $value ) {
		return array(
			'.top-banner-image' => array(
				'max-height' => array(
					'value' => ( absint( $value ) . 'px' ),
					'place' => '_PLACEpx',
				),
			),
		);
	}

	/**
	 * Top Navbar Background Color 1.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function top_navbar_bg_color_1( $value ) {
		$color_2 = self::saved_styles()['top_navbar_bg_color_2'];

		return array(
			'.top-navbar' => array(
				'background' => array(
					'value'  => ( 'linear-gradient(0deg, ' . Sanitizer::sanitize_alpha_color( $value ) . ' 0%, ' . Sanitizer::sanitize_alpha_color( $color_2 ) . ' 100%)' ),
					'place'  => 'linear-gradient(0deg, _PLACE 0%, _EXTRA_COLOR_2 100%)',
					'extra'  => array(
						'top_navbar_bg_color_2' => '_EXTRA_COLOR_2',
					),
					'remove' => array(
						'top_navbar_bg_color_2',
					),
				),
			),
			'.social-navigation a:active .svg-icon,.social-navigation a:focus .svg-icon,.social-navigation a:hover .svg-icon' => array(
				'color' => array(
					'value' => Sanitizer::sanitize_alpha_color( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Top Navbar Background Color 2.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function top_navbar_bg_color_2( $value ) {
		$color_1 = self::saved_styles()['top_navbar_bg_color_1'];

		$rules = array(
			'.top-navbar' => array(
				'background' => array(
					'skip'   => true,
					'value'  => ( 'linear-gradient(0deg, ' . Sanitizer::sanitize_alpha_color( $color_1 ) . ' 0%, ' . Sanitizer::sanitize_alpha_color( $value ) . ' 100%)' ),
					'place'  => 'linear-gradient(0deg, _EXTRA_COLOR_1 0%, _PLACE 100%)',
					'extra'  => array(
						'top_navbar_bg_color_1' => '_EXTRA_COLOR_1',
					),
					'remove' => array(
						'top_navbar_bg_color_1',
					),
				),
			),
		);

		if ( is_customize_preview() ) {
			$rules['.social-navigation a:active .svg-icon,.social-navigation a:focus .svg-icon,.social-navigation a:hover .svg-icon'] = array(
				'color' => array(
					'value'  => Sanitizer::sanitize_alpha_color( $color_1 ),
					'place'  => '_EXTRA_COLOR_1',
					'extra'  => array(
						'top_navbar_bg_color_1' => '_EXTRA_COLOR_1',
					),
					'remove' => array(
						'top_navbar_bg_color_1',
					),
				),
			);
		}

		return $rules;
	}

	/**
	 * Primary Navbar Background Color.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function primary_navbar_bg_color( $value ) {
		return array(
			'.primary-navbar,.main-navigation ul ul' => array(
				'background' => array(
					'value' => Sanitizer::sanitize_alpha_color( $value ),
					'place' => '_PLACE',
				),
			),
			'.main-navigation .main-navigation-arrow-btn:active,.main-navigation .main-navigation-arrow-btn:hover,.main-navigation li.focus>.main-navigation-arrow-btn,.main-navigation:not(.toggled) li:hover>.main-navigation-arrow-btn,.main-navigation a:active,.main-navigation a:focus,.main-navigation a:hover' => array(
				'color' => array(
					'value' => Sanitizer::sanitize_alpha_color( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Header Background Color.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function header_bg_color( $value ) {
		return array(
			'.site-branding' => array(
				'background-color' => array(
					'value' => Sanitizer::sanitize_alpha_color( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Site Title Color.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function site_title_color( $value ) {
		return array(
			'.site-title,.site-title a,.site-title a:active,.site-title a:focus,.site-title a:hover' => array(
				'color' => array(
					'value' => sanitize_hex_color( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Tagline Color.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function tagline_color( $value ) {
		return array(
			'.site-tagline' => array(
				'color' => array(
					'value' => sanitize_hex_color( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Button Background Color 1.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function button_bg_color_1( $value ) {
		$color_2 = self::saved_styles()['button_bg_color_2'];

		return array(
			'.more-link,.wp-block-search .wp-block-search__button,button,input[type=button],input[type=reset],input[type=submit]' => array(
				'background-image' => array(
					'value'  => ( 'linear-gradient(to right, ' . Sanitizer::sanitize_alpha_color( $value ) . ' 0%, ' . Sanitizer::sanitize_alpha_color( $color_2 ) . ' 51%, ' . Sanitizer::sanitize_alpha_color( $value ) . ' 100%)' ),
					'place'  => 'linear-gradient(to right, _PLACE 0%, _EXTRA_COLOR_2 51%, _PLACE 100%)',
					'extra'  => array(
						'button_bg_color_2' => '_EXTRA_COLOR_2',
					),
					'remove' => array(
						'button_bg_color_2',
					),
				),
			),
		);
	}

	/**
	 * Button Background Color 2.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function button_bg_color_2( $value ) {
		$color_1 = self::saved_styles()['button_bg_color_1'];

		return array(
			'.more-link,.wp-block-search .wp-block-search__button,button,input[type=button],input[type=reset],input[type=submit]' => array(
				'background-image' => array(
					'skip'   => true,
					'value'  => ( 'linear-gradient(to right, ' . Sanitizer::sanitize_alpha_color( $color_1 ) . ' 0%, ' . Sanitizer::sanitize_alpha_color( $value ) . ' 51%, ' . Sanitizer::sanitize_alpha_color( $color_1 ) . ' 100%)' ),
					'place'  => 'linear-gradient(to right, _EXTRA_COLOR_1 0%, _PLACE 51%, _EXTRA_COLOR_1 100%)',
					'extra'  => array(
						'button_bg_color_1' => '_EXTRA_COLOR_1',
					),
					'remove' => array(
						'button_bg_color_1',
					),
				),
			),
		);
	}

	/**
	 * Button Font Weight.
	 *
	 * @param string $value Font weight value.
	 * @return array
	 */
	public static function button_font_wgt( $value ) {
		return array(
			'.more-link,.wp-block-search .wp-block-search__button,button,input[type=button],input[type=reset],input[type=submit]' => array(
				'font-weight' => array(
					'value' => absint( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Heading Font Weight.
	 *
	 * @param string $value Font weight value.
	 * @return array
	 */
	public static function heading_font_wgt( $value ) {
		return array(
			'h1,h2,h3,h4,h5,h6' => array(
				'font-weight' => array(
					'value' => absint( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Site Title Font Weight.
	 *
	 * @param string $value Font weight value.
	 * @return array
	 */
	public static function site_title_font_wgt( $value ) {
		return array(
			'.site-title' => array(
				'font-weight' => array(
					'value' => absint( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Side Widget Border Color.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function side_widget_border_color( $value ) {
		return array(
			'.c-sidebar .widget' => array(
				'border-color' => array(
					'value' => Sanitizer::sanitize_alpha_color( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Footer Background Color.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function footer_bg_color( $value ) {
		return array(
			'.footer-widgets,.copyright-text' => array(
				'background' => array(
					'value' => Sanitizer::sanitize_alpha_color( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Footer Credit Link Color.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function footer_credit_link_color( $value ) {
		return array(
			'.copyright-text a' => array(
				'color' => array(
					'value' => sanitize_hex_color( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}
}
