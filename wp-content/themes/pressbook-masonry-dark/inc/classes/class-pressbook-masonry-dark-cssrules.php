<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * CSS Rules.
 *
 * @package PressBook_Masonry_Dark
 */

/**
 * Generate dynamic CSS rules for theme.
 */
class PressBook_Masonry_Dark_CSSRules extends PressBook\CSSRules {
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
					'value' => PressBook\Options\Sanitizer::sanitize_alpha_color( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}

	/**
	 * Primary Navbar Hover Background Color.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function primary_navbar_hover_bg_color( $value ) {
		return array(
			'.main-navigation .menu .current-menu-ancestor>a,.main-navigation .menu .current-menu-item>a,.main-navigation .menu .current-menu-parent>a,.main-navigation .main-navigation-arrow-btn:active,.main-navigation .main-navigation-arrow-btn:hover,.main-navigation a:active,.main-navigation a:focus,.main-navigation a:hover,.main-navigation li.focus>.main-navigation-arrow-btn,.main-navigation:not(.toggled) li:hover>.main-navigation-arrow-btn' => array(
				'background' => array(
					'value' => PressBook\Options\Sanitizer::sanitize_alpha_color( $value ),
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
			'.copyright-text a,.footer-widgets .widget li::before' => array(
				'color' => array(
					'value' => sanitize_hex_color( $value ),
					'place' => '_PLACE',
				),
			),
			'.footer-widgets .widget .widget-title::after,.footer-widgets .widget_block h1:first-child::after,.footer-widgets .widget_block h2:first-child::after,.footer-widgets .widget_block h3:first-child::after' => array(
				'background' => array(
					'value' => sanitize_hex_color( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}
}
