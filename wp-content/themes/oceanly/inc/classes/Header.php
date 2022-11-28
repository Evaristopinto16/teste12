<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Header service.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Add support for the custom header.
 */
class Header implements Serviceable {
	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'after_setup_theme', array( $this, 'custom_header_setup' ) );
	}

	/**
	 * Set up the WordPress core custom header feature.
	 *
	 * @uses oceanly_header_style()
	 */
	public function custom_header_setup() {
		add_theme_support(
			'custom-header',
			apply_filters(
				'oceanly_custom_header_args',
				array(
					'default-image' => '',
					'width'         => 1600,
					'height'        => 700,
					'flex-width'    => true,
					'flex-height'   => true,
					'header-text'   => false,
				)
			)
		);
	}
}
