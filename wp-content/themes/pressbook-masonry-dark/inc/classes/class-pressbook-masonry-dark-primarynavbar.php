<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer primary navbar options service.
 *
 * @package PressBook_Masonry_Dark
 */

/**
 * Primary navbar options service class.
 */
class PressBook_Masonry_Dark_PrimaryNavbar extends PressBook\Options {
	/**
	 * Add primary navbar options for theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->set_primary_navbar_hover_bg_color( $wp_customize );

		$wp_customize->get_control( 'set_primary_navbar_search' )->priority = 11;
	}

	/**
	 * Add setting: Primary Navbar Hover Background Color.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_primary_navbar_hover_bg_color( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[primary_navbar_hover_bg_color]',
			array(
				'default'           => PressBook_Masonry_Dark_CSSRules::default_styles( 'primary_navbar_hover_bg_color' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_alpha_color' ),
			)
		);

		$wp_customize->add_control(
			new PressBook\Options\AlphaColorControl(
				$wp_customize,
				'set_styles[primary_navbar_hover_bg_color]',
				array(
					'section'      => 'sec_primary_navbar',
					'label'        => esc_html__( 'Primary Navbar Hover Background Color', 'pressbook-masonry-dark' ),
					'settings'     => 'set_styles[primary_navbar_hover_bg_color]',
					'palette'      => true,
					'show_opacity' => true,
				)
			)
		);
	}
}
