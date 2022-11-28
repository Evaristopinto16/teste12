<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Footer widgets options service.
 *
 * @package Oceanly
 */

namespace Oceanly\Customizer;

use Oceanly\Customizer;
use Oceanly\Defaults;

/**
 * Footer widgets service class.
 */
class FooterWidgets extends Customizer {
	/**
	 * Add footer widgets for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_footer_widgets( $wp_customize );

		$this->set_footer_widgets_per_row_lg( $wp_customize );
		$this->set_footer_widgets_per_row_md( $wp_customize );
		$this->set_footer_widgets_per_row_sm( $wp_customize );
	}

	/**
	 * Section: Footer Widgets.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_footer_widgets( $wp_customize ) {
		$wp_customize->add_section(
			'sec_footer_widgets',
			array(
				'title'       => esc_html__( 'Footer Widgets', 'oceanly' ),
				'description' => esc_html__( 'You can customize the footer widgets options in here.', 'oceanly' ),
				'priority'    => 163,
			)
		);
	}

	/**
	 * Setting: Footer Widgets Per Row (Large Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_footer_widgets_per_row_lg( $wp_customize ) {
		$wp_customize->add_setting(
			'set_footer_widgets_per_row_lg',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::footer_widgets_per_row_lg(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_footer_widgets_per_row_lg',
			array(
				'section'     => 'sec_footer_widgets',
				'type'        => 'select',
				'choices'     => $this->footer_widgets_per_row(),
				'label'       => esc_html__( 'Footer Widgets Per Row (Large Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: 3', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_footer_widgets_per_row_lg',
			array(
				'selector'            => '.footer-widgets',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_footer_widgets' ),
			)
		);
	}

	/**
	 * Setting: Footer Widgets Per Row (Medium Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_footer_widgets_per_row_md( $wp_customize ) {
		$wp_customize->add_setting(
			'set_footer_widgets_per_row_md',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::footer_widgets_per_row_md(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_footer_widgets_per_row_md',
			array(
				'section'     => 'sec_footer_widgets',
				'type'        => 'select',
				'choices'     => $this->footer_widgets_per_row(),
				'label'       => esc_html__( 'Footer Widgets Per Row (Medium Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: 2', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_footer_widgets_per_row_md',
			array(
				'selector'            => '.footer-widgets',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_footer_widgets' ),
			)
		);
	}

	/**
	 * Setting: Footer Widgets Per Row (Small Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_footer_widgets_per_row_sm( $wp_customize ) {
		$wp_customize->add_setting(
			'set_footer_widgets_per_row_sm',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::footer_widgets_per_row_sm(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_footer_widgets_per_row_sm',
			array(
				'section'     => 'sec_footer_widgets',
				'type'        => 'select',
				'choices'     => $this->footer_widgets_per_row(),
				'label'       => esc_html__( 'Footer Widgets Per Row (Small Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: 1', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_footer_widgets_per_row_sm',
			array(
				'selector'            => '.footer-widgets',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_footer_widgets' ),
			)
		);
	}

	/**
	 * Render footer widgets for selective refresh.
	 *
	 * @return void
	 */
	public function render_footer_widgets() {
		get_template_part( 'template-parts/footer/widgets' );
	}

	/**
	 * Footer Widgets Per Row.
	 *
	 * @return array
	 */
	public function footer_widgets_per_row() {
		return array(
			1 => esc_html__( '1', 'oceanly' ),
			2 => esc_html__( '2', 'oceanly' ),
			3 => esc_html__( '3', 'oceanly' ),
		);
	}
}
