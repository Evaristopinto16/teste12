<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Theme hooks.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Register functions hooked into the theme hooks.
 */
class Hooks implements Serviceable {
	/**
	 * Register service features.
	 */
	public function register() {
		/**
		 * Header breadcrumbs.
		 */
		add_action( 'oceanly_action_breadcrumbs', array( TemplateTags::class, 'breadcrumbs' ), 10 );
	}
}
