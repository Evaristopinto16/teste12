<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer main navigation options service.
 *
 * @package Oceanly
 */

namespace Oceanly\Customizer;

use Oceanly\Customizer;
use Oceanly\Defaults;

/**
 * Header main navigation options service class.
 */
class MainNavigation extends Customizer {
	/**
	 * Add main navigation options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_main_nav( $wp_customize );

		$this->set_menu_alignment_md( $wp_customize );
		$this->set_menu_alignment_sm( $wp_customize );

		$this->set_submenu_direction_lg( $wp_customize );
		$this->set_submenu_direction_md( $wp_customize );
	}

	/**
	 * Section: Main Navigation Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_main_nav( $wp_customize ) {
		$wp_customize->add_section(
			'sec_main_nav',
			array(
				'title'       => esc_html__( 'Main Navigation', 'oceanly' ),
				'description' => esc_html__( 'You can customize the main navigation options in here.', 'oceanly' ),
				'priority'    => 159,
			)
		);
	}

	/**
	 * Setting: Menu Alignment (Medium / Large Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_menu_alignment_md( $wp_customize ) {
		$wp_customize->add_setting(
			'set_menu_alignment_md',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::menu_alignment_md(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_menu_alignment_md',
			array(
				'section'     => 'sec_main_nav',
				'type'        => 'select',
				'choices'     => $this->menu_alignments(),
				'label'       => esc_html__( 'Menu Alignment (Medium / Large Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Left', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_menu_alignment_md',
			array(
				'selector'            => '.site-navigation-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_navigation' ),
			)
		);
	}

	/**
	 * Setting: Menu Alignment (Small Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_menu_alignment_sm( $wp_customize ) {
		$wp_customize->add_setting(
			'set_menu_alignment_sm',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::menu_alignment_sm(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_menu_alignment_sm',
			array(
				'section'     => 'sec_main_nav',
				'type'        => 'select',
				'choices'     => $this->menu_alignments(),
				'label'       => esc_html__( 'Menu Alignment (Small Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Center', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_menu_alignment_sm',
			array(
				'selector'            => '.site-navigation-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_navigation' ),
			)
		);
	}

	/**
	 * Setting: Sub-Menu Direction (Large Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_submenu_direction_lg( $wp_customize ) {
		$wp_customize->add_setting(
			'set_submenu_direction_lg',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::submenu_direction_lg(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_submenu_direction_lg',
			array(
				'section'     => 'sec_main_nav',
				'type'        => 'select',
				'choices'     => $this->submenu_directions(),
				'label'       => esc_html__( 'Sub-Menu Direction (Large Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Right', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_submenu_direction_lg',
			array(
				'selector'            => '.site-navigation-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_navigation' ),
			)
		);
	}

	/**
	 * Setting: Sub-Menu Direction (Medium Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_submenu_direction_md( $wp_customize ) {
		$wp_customize->add_setting(
			'set_submenu_direction_md',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::submenu_direction_md(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_submenu_direction_md',
			array(
				'section'     => 'sec_main_nav',
				'type'        => 'select',
				'choices'     => $this->submenu_directions(),
				'label'       => esc_html__( 'Sub-Menu Direction (Medium Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Right', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_submenu_direction_md',
			array(
				'selector'            => '.site-navigation-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_navigation' ),
			)
		);
	}

	/**
	 * Render navigation for selective refresh.
	 *
	 * @return void
	 */
	public function render_navigation() {
		get_template_part( 'template-parts/header/navigation' );
	}

	/**
	 * Menu Alignments.
	 *
	 * @return array
	 */
	public function menu_alignments() {
		return array(
			'left'   => esc_html__( 'Left', 'oceanly' ),
			'center' => esc_html__( 'Center', 'oceanly' ),
			'right'  => esc_html__( 'Right', 'oceanly' ),
		);
	}

	/**
	 * Sub-menu Directions.
	 *
	 * @return array
	 */
	public function submenu_directions() {
		return array(
			'left'  => esc_html__( 'Left', 'oceanly' ),
			'right' => esc_html__( 'Right', 'oceanly' ),
		);
	}
}
