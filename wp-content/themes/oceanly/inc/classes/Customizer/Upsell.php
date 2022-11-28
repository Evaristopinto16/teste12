<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Upsell customizer service.
 *
 * @package Oceanly
 */

namespace Oceanly\Customizer;

use Oceanly\Customizer;
use Oceanly\Helpers;

/**
 * Upsell service class.
 */
class Upsell extends Customizer {
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
			$wp_customize->register_section_type( \Oceanly_Upsell_Section::class );
		}

		if ( method_exists( $wp_customize, 'register_control_type' ) ) {
			$wp_customize->register_control_type( \Oceanly_Upsell_Control::class );
		}

		$wp_customize->add_section(
			new \Oceanly_Upsell_Section(
				$wp_customize,
				'oceanly_premium',
				array(
					'title'       => esc_html__( 'Premium Available', 'oceanly' ),
					'button_text' => esc_html__( 'Get Premium', 'oceanly' ),
					'button_url'  => esc_url( Helpers::get_upsell_buy_url() ),
					'priority'    => 1,
				)
			)
		);

		$wp_customize->add_control(
			new \Oceanly_Upsell_Control(
				$wp_customize,
				'addon_colors',
				array(
					'section'     => 'colors',
					'type'        => 'oceanly-addon',
					'label'       => esc_html__( 'Learn More', 'oceanly' ),
					'description' => esc_html__( 'More color options are available in our premium version.', 'oceanly' ),
					'url'         => esc_url( Helpers::get_upsell_detail_url() ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \Oceanly_Upsell_Control(
				$wp_customize,
				'addon_header_image',
				array(
					'section'     => 'header_image',
					'type'        => 'oceanly-addon',
					'label'       => esc_html__( 'Learn More', 'oceanly' ),
					'description' => esc_html__( 'More header options are available in our premium version.', 'oceanly' ),
					'url'         => esc_url( Helpers::get_upsell_detail_url() ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \Oceanly_Upsell_Control(
				$wp_customize,
				'addon_sec_general',
				array(
					'section'     => 'sec_general',
					'type'        => 'oceanly-addon',
					'label'       => esc_html__( 'Learn More', 'oceanly' ),
					'description' => esc_html__( 'More general options are available in our premium version.', 'oceanly' ),
					'url'         => esc_url( Helpers::get_upsell_detail_url() ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \Oceanly_Upsell_Control(
				$wp_customize,
				'addon_sec_hero_header',
				array(
					'section'     => 'sec_hero_header',
					'type'        => 'oceanly-addon',
					'label'       => esc_html__( 'Learn More', 'oceanly' ),
					'description' => esc_html__( 'More hero header options are available in our premium version.', 'oceanly' ),
					'url'         => esc_url( Helpers::get_upsell_detail_url() ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \Oceanly_Upsell_Control(
				$wp_customize,
				'addon_sec_header_block_area',
				array(
					'section'     => 'sec_header_block_area',
					'type'        => 'oceanly-addon',
					'label'       => esc_html__( 'Learn More', 'oceanly' ),
					'description' => esc_html__( 'More header and footer block areas are available in our premium version.', 'oceanly' ),
					'url'         => esc_url( Helpers::get_upsell_detail_url() ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \Oceanly_Upsell_Control(
				$wp_customize,
				'addon_sec_footer_widgets',
				array(
					'section'     => 'sec_footer_widgets',
					'type'        => 'oceanly-addon',
					'label'       => esc_html__( 'Learn More', 'oceanly' ),
					'description' => esc_html__( 'More footer widgets and layout options are available in our premium version.', 'oceanly' ),
					'url'         => esc_url( Helpers::get_upsell_detail_url() ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \Oceanly_Upsell_Control(
				$wp_customize,
				'addon_sec_footer',
				array(
					'section'     => 'sec_footer',
					'type'        => 'oceanly-addon',
					'label'       => esc_html__( 'Learn More', 'oceanly' ),
					'description' => esc_html__( 'More footer options are available in our premium version.', 'oceanly' ),
					'url'         => esc_url( Helpers::get_upsell_detail_url() ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);
	}
}
