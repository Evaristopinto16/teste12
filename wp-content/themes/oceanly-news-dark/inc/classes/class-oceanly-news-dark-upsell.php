<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Upsell customizer service.
 *
 * @package Oceanly_News_Dark
 */

/**
 * Upsell service class.
 */
class Oceanly_News_Dark_Upsell extends Oceanly\Customizer {
	/**
	 * Add upsell in the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		if ( class_exists( '\Oceanly_Upsell_Control' ) ) {
			$this->upsell( $wp_customize );
		}
	}

	/**
	 * Section: Upsell.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function upsell( $wp_customize ) {
		$wp_customize->add_control(
			new \Oceanly_Upsell_Control(
				$wp_customize,
				'sec_featured_posts',
				array(
					'section'     => 'sec_featured_posts',
					'type'        => 'oceanly-addon',
					'label'       => esc_html__( 'Learn More', 'oceanly-news-dark' ),
					'description' => esc_html__( 'Premium version also includes top header bar, accent color, RGBA colors, fonts selector, multiple header and footer blocks.', 'oceanly-news-dark' ),
					'url'         => esc_url( Oceanly\Helpers::get_upsell_detail_url() ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);

		$wp_customize->add_control(
			new \Oceanly_Upsell_Control(
				$wp_customize,
				'sec_related_posts',
				array(
					'section'     => 'sec_related_posts',
					'type'        => 'oceanly-addon',
					'label'       => esc_html__( 'Learn More', 'oceanly-news-dark' ),
					'description' => esc_html__( 'Premium version also includes top header bar, accent color, RGBA colors, fonts selector, multiple header and footer blocks.', 'oceanly-news-dark' ),
					'url'         => esc_url( Oceanly\Helpers::get_upsell_detail_url() ),
					'priority'    => 999,
					'settings'    => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
				)
			)
		);
	}
}
