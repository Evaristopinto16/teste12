<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Icons helpers.
 *
 * @package PressBook
 */

namespace PressBook;

/**
 * SVG icons related helpers.
 */
class IconsHelper implements Serviceable {
	/**
	 * Register service features.
	 */
	public function register() {
		add_filter( 'walker_nav_menu_start_el', array( $this, 'nav_menu_social_icons' ), 10, 4 );
	}

	/**
	 * Display SVG icons in social links menu.
	 *
	 * @param  string  $item_output The menu item output.
	 * @param  WP_Post $item        Menu item object.
	 * @param  int     $depth       Depth of the menu.
	 * @param  array   $args        wp_nav_menu() arguments.
	 * @return string  $item_output The menu item output with social icon.
	 */
	public function nav_menu_social_icons( $item_output, $item, $depth, $args ) {
		// Change SVG icon inside social links menu if there is supported URL.
		if ( 'social' === $args->theme_location ) {
			$svg = self::get_social_link_svg( $item->url, 26 );
			if ( empty( $svg ) ) {
				$svg = self::get_icon_svg( 'link' );
			}
			$item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
		}

		return $item_output;
	}

	/**
	 * Gets the SVG code for a given icon.
	 *
	 * @param string  $icon Icon key.
	 * @param integer $size Icon size.
	 * @return string
	 */
	public static function get_icon_svg( $icon, $size = 24 ) {
		return Icons::get_svg( 'ui', $icon, $size );
	}

	/**
	 * Gets the SVG code for a given social icon.
	 *
	 * @param string $icon Icon key.
	 * @param int    $size Icon size.
	 * @return string
	 */
	public static function get_social_icon_svg( $icon, $size = 24 ) {
		return Icons::get_svg( 'social', $icon, $size );
	}

	/**
	 * Detects the social network from a URL and returns the SVG code for its icon.
	 *
	 * @param string $uri Social link uri.
	 * @param int    $size Icon size.
	 * @return string
	 */
	public static function get_social_link_svg( $uri, $size = 24 ) {
		return Icons::get_social_link_svg( $uri, $size );
	}

	/**
	 * Output and Get Theme SVG.
	 * Output and get the SVG markup for an icon in the Icons class.
	 *
	 * @param string  $icon Icon key.
	 * @param integer $size Icon size.
	 * @param string  $group The icon group.
	 */
	public static function the_theme_svg( $icon, $size = 24, $group = 'ui' ) {
		echo self::get_theme_svg( $icon, $size, $group ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in IconsHelper::get_theme_svg().
	}

	/**
	 * Get information about the SVG icon.
	 *
	 * @param string  $icon Icon key.
	 * @param integer $size Icon size.
	 * @param string  $group The icon group.
	 */
	public static function get_theme_svg( $icon, $size = 24, $group = 'ui' ) {
		// Make sure that only our allowed tags and attributes are included.
		$svg = wp_kses(
			Icons::get_svg( $group, $icon, $size ),
			array(
				'svg'     => array(
					'class'       => true,
					'xmlns'       => true,
					'width'       => true,
					'height'      => true,
					'viewbox'     => true,
					'aria-hidden' => true,
					'role'        => true,
					'focusable'   => true,
				),
				'path'    => array(
					'fill'      => true,
					'fill-rule' => true,
					'd'         => true,
					'transform' => true,
				),
				'polygon' => array(
					'fill'      => true,
					'fill-rule' => true,
					'points'    => true,
					'transform' => true,
					'focusable' => true,
				),
			)
		);

		if ( ! $svg ) {
			return false;
		}
		return $svg;
	}
}
