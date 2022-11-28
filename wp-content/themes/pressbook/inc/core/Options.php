<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Options base class.
 *
 * @package PressBook
 */

namespace PressBook;

/**
 * Base class for theme options service classes.
 */
abstract class Options implements Serviceable {
	/**
	 * Allows to define customizer sections, settings, and controls.
	 */
	public function register() {
		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	/**
	 * Define customizer sections, settings, and controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	abstract public function customize_register( $wp_customize );
}
