<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Options Sanitizer.
 *
 * @package PressBook
 */

namespace PressBook\Options;

/**
 * Sanitizer for theme options.
 */
class Sanitizer {
	/**
	 * Checkbox sanitization.
	 *
	 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
	 * as a boolean value, either TRUE or FALSE.
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	public static function sanitize_checkbox( $checked ) {
		return ( isset( $checked ) && true === $checked ) ? true : false;
	}

	/**
	 * Sanitize select.
	 *
	 * @param string $input The input from the setting.
	 * @param object $setting The selected setting.
	 *
	 * @return string $input|$setting->default The input from the setting or the default setting.
	 */
	public static function sanitize_select( $input, $setting ) {
		$input   = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	/**
	 * Sanitize block post.
	 *
	 * @param int $input post id.
	 * @return int
	 */
	public static function sanitize_block_post( $input ) {
		$post_id = absint( $input );
		if ( $post_id && 'wp_block' === get_post_type( $post_id ) ) {
			return $post_id;
		}
		return 0;
	}

	/**
	 * Function to sanitize alpha color.
	 *
	 * @param string $value Hex or RGBA color.
	 *
	 * @return string
	 */
	public static function sanitize_alpha_color( $value ) {
		// This pattern will check and match 3/6/8-character hex, rgb, rgba, hsl, & hsla colors.
		$pattern = '/^(\#[\da-f]{3}|\#[\da-f]{6}|\#[\da-f]{8}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))$/';
		\preg_match( $pattern, $value, $matches );
		// Return the 1st match found.
		if ( isset( $matches[0] ) ) {
			if ( is_string( $matches[0] ) ) {
				return $matches[0];
			}
			if ( is_array( $matches[0] ) && isset( $matches[0][0] ) ) {
				return $matches[0][0];
			}
		}
		// If no match was found, return an empty string.
		return '';
	}

	/**
	 * Sanitize copyright text.
	 *
	 * @param string $input Input text.
	 * @return string
	 */
	public static function sanitize_copyright_text( $input ) {
		$allowed = Footer::copyright_text_allowed_tags();
		return wp_kses( $input, $allowed );
	}
}
