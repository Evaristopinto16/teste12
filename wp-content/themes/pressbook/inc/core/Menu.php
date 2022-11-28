<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Menu service.
 *
 * @package PressBook
 */

namespace PressBook;

use PressBook\Options\PrimaryNavbar;

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
				'pressbook_register_nav_menus_args',
				array(
					'menu-1' => esc_html__( 'Primary', 'pressbook' ),
					'menu-2' => esc_html__( 'Top Menu', 'pressbook' ),
					'social' => esc_html__( 'Social Links Menu', 'pressbook' ),
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
				$item_output .= '<button class="main-navigation-arrow-btn" aria-expanded="false"><span class="screen-reader-text">' . esc_html__( 'Toggle sub-menu', 'pressbook' ) . '</span>' . IconsHelper::get_theme_svg( 'chevron_down' ) . '</button>';
			}
		}

		return $item_output;
	}

	/**
	 * Output HTML for the primary menu.
	 */
	public static function primary_menu() {
		if ( PrimaryNavbar::get_primary_navbar_search() ) {
			$search = ( '<li class="primary-menu-search">' .
							'<a href="#" class="primary-menu-search-toggle" aria-expanded="false"><span class="screen-reader-text">' . esc_html__( 'Toggle search form', 'pressbook' ) . '</span>' . IconsHelper::get_theme_svg( 'search' ) . IconsHelper::get_theme_svg( 'close' ) . '</a>' .
							'<div class="search-form-wrap">' . get_search_form( array( 'echo' => false ) ) . '</div>' .
						'</li>' );
		} else {
			$search = '';
		}

		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s' . $search . '</ul>',
			)
		);
	}

	/**
	 * Get top menus class.
	 *
	 * @return string
	 */
	public static function top_menus_class() {
		$left_menu_active  = has_nav_menu( 'social' );
		$right_menu_active = has_nav_menu( 'menu-2' );

		$top_menus_class = 'top-menus';

		if ( $left_menu_active && $right_menu_active ) {
			$top_menus_class .= ' top-menus-left-right';
		} elseif ( $left_menu_active ) {
			$top_menus_class .= ' top-menus-left';
		} elseif ( $right_menu_active ) {
			$top_menus_class .= ' top-menus-right';
		}

		return apply_filters( 'pressbook_top_menus_class', $top_menus_class );
	}
}
