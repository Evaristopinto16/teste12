<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer base class.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Base class for theme options service classes.
 */
abstract class Customizer implements Serviceable {
	/**
	 * Add action hook: customize_register.
	 */
	public function register() {
		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	/**
	 * Add theme options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	abstract public function customize_register( $wp_customize );
}
