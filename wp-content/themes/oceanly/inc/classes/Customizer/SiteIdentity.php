<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer site identity options service.
 *
 * @package Oceanly
 */

namespace Oceanly\Customizer;

use Oceanly\CSSRules;
use Oceanly\Defaults;
use Oceanly\Customizer;

/**
 * Site identity options service class.
 */
class SiteIdentity extends Customizer {
	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_action( 'customize_preview_init', array( $this, 'customize_preview_scripts' ) );
	}

	/**
	 * Add site identity options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		// Selective refresh for site title.
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

		// Selective refresh for site tagline.
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		$this->set_show_site_title( $wp_customize );
		$this->set_show_site_tagline( $wp_customize );
	}

	/**
	 * Setting: Show Site Title.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_show_site_title( $wp_customize ) {
		$wp_customize->add_setting(
			'set_show_site_title',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::show_site_title(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_show_site_title',
			array(
				'section' => 'title_tagline',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show Site Title', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_show_site_title',
			array(
				'selector'            => '.site-header-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Setting: Show Site Tagline.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_show_site_tagline( $wp_customize ) {
		$wp_customize->add_setting(
			'set_show_site_tagline',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::show_site_tagline(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_show_site_tagline',
			array(
				'section' => 'title_tagline',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show Site Tagline', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_show_site_tagline',
			array(
				'selector'            => '.site-header-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Render site branding for selective refresh.
	 *
	 * @return void
	 */
	public function render_site_branding() {
		get_template_part( 'template-parts/header/branding' );
	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	public function customize_preview_scripts() {
		wp_enqueue_script( 'oceanly-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview', 'jquery' ), OCEANLY_VERSION, true );

		wp_localize_script(
			'oceanly-customizer',
			'oceanly',
			array(
				'styles' => CSSRules::output_array(),
			)
		);
	}
}
