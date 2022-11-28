<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer Sanitizer.
 *
 * @package Oceanly
 */

namespace Oceanly\Customizer;

use Oceanly\Helpers;

/**
 * Sanitizer for customizer.
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
	 * Sanitize copyright text.
	 *
	 * @param string $input Input text.
	 * @return string
	 */
	public static function sanitize_copyright( $input ) {
		$allowed = Helpers::copyright_allowed_tags();
		return wp_kses( $input, $allowed );
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
}
