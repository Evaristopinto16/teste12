<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Menu service.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Register menu locations, add menu dropdown icons for the theme.
 */
class Menu implements Serviceable {
	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'after_setup_theme', array( $this, 'register_nav_menus' ) );

		add_filter( 'walker_nav_menu_start_el', array( $this, 'add_dropdown_icons' ), 10, 4 );
	}

	/**
	 * Register menu locations.
	 */
	public function register_nav_menus() {
		// This theme uses wp_nav_menu() in three locations.
		register_nav_menus(
			apply_filters(
				'oceanly_register_nav_menus_args',
				array(
					'menu-1' => esc_html__( 'Primary', 'oceanly' ),
					'footer' => esc_html__( 'Footer Menu', 'oceanly' ),
					'social' => esc_html__( 'Social Links Menu', 'oceanly' ),
				)
			)
		);
	}

	/**
	 * Filter the HTML output of a nav menu item to add the dropdown button that reveal the sub-menu.
	 *
	 * @param string $item_output Nav menu item HTML.
	 * @param object $item        Nav menu item.
	 * @param int    $depth       The depth of the menu.
	 * @param array  $args        Array of menu args, such as theme location.
	 * @return string Modified nav menu item HTML.
	 */
	public function add_dropdown_icons( $item_output, $item, $depth, $args ) {
		// Only add the sub-menu button to the main navigation.
		if ( 'menu-1' === $args->theme_location ) {
			// Skip if the item has no sub-menu.
			if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
				$item_output .= '<button class="main-navigation-arrow-btn" aria-expanded="false"><span class="screen-reader-text">' . esc_html__( 'Toggle sub-menu', 'oceanly' ) . '</span>' . IconsHelper::get_theme_svg( 'chevron_down' ) . '</button>';
			}
		}

		return $item_output;
	}
}
