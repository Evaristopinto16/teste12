<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * CSS Rules.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * CSS rules for theme styles.
 */
class CSSRules {
	/**
	 * CSS rules for the final output.
	 *
	 * @return string.
	 */
	public static function output() {
		$styles = Helpers::styles();

		$styles_keys = array_keys( $styles );

		$output = '';

		foreach ( $styles_keys as $styles_key ) {
			if ( method_exists( __CLASS__, $styles_key ) ) {
				$rules = self::$styles_key( $styles[ $styles_key ] );

				foreach ( $rules as $selector => $props ) {
					$output .= ( $selector . '{' );

					foreach ( $props as $prop => $value ) {
						$output .= ( $prop . ':' . $value['value'] . ';' );
					}

					$output .= '}';
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
		$styles = Helpers::styles();

		$styles_keys = array_keys( $styles );

		$output = array();

		foreach ( $styles_keys as $styles_key ) {

			$output[ $styles_key ] = array();

			if ( method_exists( __CLASS__, $styles_key ) ) {
				$rules = self::$styles_key( $styles[ $styles_key ] );

				foreach ( $rules as $selector => $props ) {
					$output[ $styles_key ][ $selector ] = $props;
				}
			}
		}

		return $output;
	}

	/**
	 * Header Background Color.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function header_bg_color( $value ) {
		return array(
			'.site-hero-header' => array(
				'background-color' => array(
					'value' => sanitize_hex_color( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}
}
