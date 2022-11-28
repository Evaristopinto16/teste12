<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Footer options service.
 *
 * @package Oceanly
 */

namespace Oceanly\Customizer;

use Oceanly\Customizer;
use Oceanly\Defaults;

/**
 * Footer options service class.
 */
class Footer extends Customizer {
	/**
	 * Add footer options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_footer( $wp_customize );

		$this->set_copyright( $wp_customize );
	}

	/**
	 * Section: Footer Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_footer( $wp_customize ) {
		$wp_customize->add_section(
			'sec_footer',
			array(
				'title'       => esc_html__( 'Footer Options', 'oceanly' ),
				'description' => esc_html__( 'You can customize the footer options in here.', 'oceanly' ),
				'priority'    => 165,
			)
		);
	}

	/**
	 * Section: Footer Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_copyright( $wp_customize ) {
		$wp_customize->add_setting(
			'set_copyright',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::copyright(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_copyright' ),
			)
		);

		$wp_customize->add_control(
			'set_copyright',
			array(
				'section'     => 'sec_footer',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Copyright Text', 'oceanly' ),
				'description' => esc_html__( 'You can edit the copyright text to be shown in the footer. You may use the following tags: em, strong, span, a, br.', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_copyright',
			array(
				'selector'            => '.footer-copyright',
				'container_inclusive' => true,
				'render_callback'     => function() {
					get_template_part( 'template-parts/footer/copyright' );
				},
			)
		);
	}
}
