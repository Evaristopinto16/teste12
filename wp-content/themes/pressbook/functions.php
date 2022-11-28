<?php
/**
 * PressBook functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PressBook
 */

defined( 'ABSPATH' ) || die();

define( 'PRESSBOOK_VERSION', '1.7.6' );

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

require get_template_directory() . '/inc/libs/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/libs/class-wptt-webfont-loader.php';
require get_template_directory() . '/inc/libs/class-pressbook-upsell-section.php';
require get_template_directory() . '/inc/libs/class-pressbook-upsell-control.php';
require get_template_directory() . '/inc/vendor/autoload.php';
require get_template_directory() . '/inc/recommended-plugins.php';
require get_template_directory() . '/inc/welcome-page.php';

PressBook\Theme::init();
