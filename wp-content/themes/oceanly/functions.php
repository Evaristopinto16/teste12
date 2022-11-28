<?php
/**
 * Oceanly functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Oceanly
 */

defined( 'ABSPATH' ) || die();

define( 'OCEANLY_VERSION', '1.5.4' );

require get_template_directory() . '/inc/libs/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/libs/class-oceanly-upsell-section.php';
require get_template_directory() . '/inc/libs/class-oceanly-upsell-control.php';
require get_template_directory() . '/inc/vendor/autoload.php';
require get_template_directory() . '/inc/helpers.php';

Oceanly\Theme::init();
