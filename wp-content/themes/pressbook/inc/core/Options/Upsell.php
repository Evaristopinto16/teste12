<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Upsell customizer service.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use PressBook\Options;
use PressBook\Helpers;

/**
 * Upsell service class.
 */
class Upsell extends Options {
	/**
	 * Add upsell in the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_upsell( $wp_customize );
	}

	/**
	 * Section: Upsell.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_upsell( $wp_customize ) {
		if ( method_exists( $wp_customize, 'register_section_type' ) ) {
			$wp_customize->register_section_type( \PressBook_Upsell_Section::class );
		}

		if ( method_exists( $wp_customize, 'register_control_type' ) ) {
			$wp_customize->register_control_type( \PressBook_Upsell_Control::class );
		}

		$wp_customize->add_section(
			new \PressBook_Upsell_Section(
				$wp_customize,
				'pressbook_premium',
				array(
					'title'       => esc_html__( 'Premium Available', 'pressbook' ),
					'button_text' => esc_html__( 'Get Premium', 'pressbook' ),
					'button_url'  => esc_url( Helpers::get_upsell_buy_url() ),
					'priority'    => 1,
				)
			)
		);

		$wp_customize->add_control(
			new \PressBook_Upsell_Control(
				$wp_customize,
				'addon_colors',
				array(
					'section'     => 'colors',
					'type'        => 'pressbook-addon',
					'label'       => esc_html__( 'Learn More', 'pressbook' ),
					'description' => esc_html__( 'More color options like button text color, link color, theme accent color, RGBA colors, fonts selector, and many more options are available in our premium version.', 'pressbook' ),
					'url'         => ( esc_url( Helpers::get_upsell_detail_url() ) ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \PressBook_Upsell_Control(
				$wp_customize,
				'sec_fonts',
				array(
					'section'     => 'sec_fonts',
					'type'        => 'pressbook-addon',
					'label'       => esc_html__( 'Learn More', 'pressbook' ),
					'description' => esc_html__( 'Advanced typography settings: font-family, font-size, body font-weight, line-height, over 50+ Google fonts, and custom Google font loader are available to select for the headings and body text in our premium version.', 'pressbook' ),
					'url'         => ( esc_url( Helpers::get_upsell_detail_url() ) ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \PressBook_Upsell_Control(
				$wp_customize,
				'sec_top_navbar',
				array(
					'section'     => 'sec_top_navbar',
					'type'        => 'pressbook-addon',
					'label'       => esc_html__( 'Learn More', 'pressbook' ),
					'description' => esc_html__( 'Multiple eye-catching block patterns, custom gradient color options, header blocks, footer blocks, and many more options are available in our premium version.', 'pressbook' ),
					'url'         => ( esc_url( Helpers::get_upsell_detail_url() ) . '#description' ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \PressBook_Upsell_Control(
				$wp_customize,
				'sec_top_banner',
				array(
					'section'     => 'sec_top_banner',
					'type'        => 'pressbook-addon',
					'label'       => esc_html__( 'Learn More', 'pressbook' ),
					'description' => esc_html__( 'Multiple eye-catching block patterns, custom gradient color scheme, header blocks, footer blocks are available in our premium version.', 'pressbook' ),
					'url'         => ( esc_url( Helpers::get_upsell_detail_url() ) . '#description' ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \PressBook_Upsell_Control(
				$wp_customize,
				'sec_primary_navbar',
				array(
					'section'     => 'sec_primary_navbar',
					'type'        => 'pressbook-addon',
					'label'       => esc_html__( 'Learn More', 'pressbook' ),
					'description' => esc_html__( 'More color options for primary navigation are available in our premium version.', 'pressbook' ),
					'url'         => ( esc_url( Helpers::get_upsell_detail_url() ) . '#description' ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \PressBook_Upsell_Control(
				$wp_customize,
				'sec_header_block',
				array(
					'section'     => 'sec_header_block',
					'type'        => 'pressbook-addon',
					'label'       => esc_html__( 'Learn More', 'pressbook' ),
					'description' => esc_html__( 'More header blocks and footer blocks are available in our premium version.', 'pressbook' ),
					'url'         => ( esc_url( Helpers::get_upsell_detail_url() ) ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \PressBook_Upsell_Control(
				$wp_customize,
				'sec_footer_block',
				array(
					'section'     => 'sec_footer_block',
					'type'        => 'pressbook-addon',
					'label'       => esc_html__( 'Learn More', 'pressbook' ),
					'description' => esc_html__( 'More footer blocks and header blocks are available in our premium version.', 'pressbook' ),
					'url'         => ( esc_url( Helpers::get_upsell_detail_url() ) ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \PressBook_Upsell_Control(
				$wp_customize,
				'sec_content',
				array(
					'section'     => 'sec_content',
					'type'        => 'pressbook-addon',
					'label'       => esc_html__( 'Learn More', 'pressbook' ),
					'description' => esc_html__( 'Content background, text color, button color, link color and many more options are available in our premium version.', 'pressbook' ),
					'url'         => ( esc_url( Helpers::get_upsell_detail_url() ) ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \PressBook_Upsell_Control(
				$wp_customize,
				'sec_sidebar',
				array(
					'section'     => 'sec_sidebar',
					'type'        => 'pressbook-addon',
					'label'       => esc_html__( 'Learn More', 'pressbook' ),
					'description' => esc_html__( 'Sidebar background, text color, post meta color, and many more options are available in our premium version.', 'pressbook' ),
					'url'         => ( esc_url( Helpers::get_upsell_detail_url() ) ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \PressBook_Upsell_Control(
				$wp_customize,
				'sec_blog',
				array(
					'section'     => 'sec_blog',
					'type'        => 'pressbook-addon',
					'label'       => esc_html__( 'Learn More', 'pressbook' ),
					'description' => esc_html__( 'More blog options and advanced theme options are available in our premium version.', 'pressbook' ),
					'url'         => ( esc_url( Helpers::get_upsell_detail_url() ) ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \PressBook_Upsell_Control(
				$wp_customize,
				'sec_footer',
				array(
					'section'     => 'sec_footer',
					'type'        => 'pressbook-addon',
					'label'       => esc_html__( 'Learn More', 'pressbook' ),
					'description' => esc_html__( 'More footer and color options are available in our premium version.', 'pressbook' ),
					'url'         => ( esc_url( Helpers::get_upsell_detail_url() ) ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);
	}
}
