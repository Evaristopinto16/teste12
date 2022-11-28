<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer hero header options service.
 *
 * @package Oceanly
 */

namespace Oceanly\Customizer;

use Oceanly\Customizer;
use Oceanly\Defaults;

/**
 * Hero header options service class.
 */
class HeroHeader extends Customizer {
	/**
	 * Add hero header options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_hero_header( $wp_customize );

		$this->set_hero_header_enable( $wp_customize );

		$this->set_site_header_b_margin( $wp_customize );

		$this->set_hero_header_bg_fixed( $wp_customize );
		$this->set_hero_header_bg_position( $wp_customize );
		$this->set_hero_header_bg_size( $wp_customize );
	}

	/**
	 * Section: Hero Header Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_hero_header( $wp_customize ) {
		$wp_customize->add_section(
			'sec_hero_header',
			array(
				'title'       => esc_html__( 'Hero Header', 'oceanly' ),
				'description' => esc_html__( 'You can customize the hero header options in here.', 'oceanly' ),
				'priority'    => 158,
			)
		);
	}

	/**
	 * Setting: Enable Hero Header.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_hero_header_enable( $wp_customize ) {
		$wp_customize->add_setting(
			'set_hero_header_enable',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::hero_header_enable(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_hero_header_enable',
			array(
				'section'     => 'sec_hero_header',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Enable Hero Header', 'oceanly' ),
				'description' => esc_html__( 'You can enable or disable the hero header. If you disable the hero header, then this will also disable the search form and breadcrumbs that are shown in the hero header.', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_hero_header_enable',
			array(
				'selector'            => '.site-hero-header',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_hero_header' ),
			)
		);
	}

	/**
	 * Setting: Site Header Bottom Margin.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_site_header_b_margin( $wp_customize ) {
		$wp_customize->add_setting(
			'set_site_header_b_margin',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::site_header_b_margin(),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_site_header_b_margin',
			array(
				'section'     => 'sec_hero_header',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Site Header Bottom Margin', 'oceanly' ),
				'description' => esc_html__( 'If you disable the hero header, then you may want to add some bottom margin from the site header.', 'oceanly' ),
			)
		);
	}

	/**
	 * Setting: Header Image Parallax Effect.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_hero_header_bg_fixed( $wp_customize ) {
		$wp_customize->add_setting(
			'set_hero_header_bg_fixed',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::hero_header_bg_fixed(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_hero_header_bg_fixed',
			array(
				'section'     => 'sec_hero_header',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Enable Header Image Parallax Effect', 'oceanly' ),
				'description' => esc_html__( 'You can enable or disable the parallax effect on the hero header image.', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_hero_header_bg_fixed',
			array(
				'selector'            => '.site-hero-header',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_hero_header' ),
			)
		);
	}

	/**
	 * Setting: Header Image Background Position.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_hero_header_bg_position( $wp_customize ) {
		$wp_customize->add_setting(
			'set_hero_header_bg_position',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::hero_header_bg_position(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_hero_header_bg_position',
			array(
				'section'     => 'sec_hero_header',
				'type'        => 'select',
				'choices'     => $this->background_positions(),
				'label'       => esc_html__( 'Header Image Background Position', 'oceanly' ),
				'description' => esc_html__( 'Default: Center Center', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_hero_header_bg_position',
			array(
				'selector'            => '.site-hero-header',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_hero_header' ),
			)
		);
	}

	/**
	 * Setting: Header Image Background Size.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_hero_header_bg_size( $wp_customize ) {
		$wp_customize->add_setting(
			'set_hero_header_bg_size',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::hero_header_bg_size(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_hero_header_bg_size',
			array(
				'section'     => 'sec_hero_header',
				'type'        => 'select',
				'choices'     => $this->background_sizes(),
				'label'       => esc_html__( 'Header Image Background Size', 'oceanly' ),
				'description' => esc_html__( 'Default: Cover', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_hero_header_bg_size',
			array(
				'selector'            => '.site-hero-header',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_hero_header' ),
			)
		);
	}

	/**
	 * Render hero header for selective refresh.
	 *
	 * @return void
	 */
	public function render_hero_header() {
		get_template_part( 'template-parts/header/hero-header' );
	}

	/**
	 * Background Positions.
	 *
	 * @return array
	 */
	public function background_positions() {
		return array(
			'left-top'      => esc_html__( 'Left Top', 'oceanly' ),
			'left-center'   => esc_html__( 'Left Center', 'oceanly' ),
			'left-bottom'   => esc_html__( 'Left Bottom', 'oceanly' ),
			'right-top'     => esc_html__( 'Right Top', 'oceanly' ),
			'right-center'  => esc_html__( 'Right Center', 'oceanly' ),
			'right-bottom'  => esc_html__( 'Right Bottom', 'oceanly' ),
			'center-top'    => esc_html__( 'Center Top', 'oceanly' ),
			'center-center' => esc_html__( 'Center Center', 'oceanly' ),
			'center-bottom' => esc_html__( 'Center Bottom', 'oceanly' ),
		);
	}

	/**
	 * Background Sizes.
	 *
	 * @return array
	 */
	public function background_sizes() {
		return array(
			'auto'    => esc_html__( 'Auto', 'oceanly' ),
			'cover'   => esc_html__( 'Cover', 'oceanly' ),
			'contain' => esc_html__( 'Contain', 'oceanly' ),
		);
	}
}
