<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer header branding options service.
 *
 * @package Oceanly
 */

namespace Oceanly\Customizer;

use Oceanly\Customizer;
use Oceanly\Defaults;

/**
 * Header branding options service class.
 */
class HeaderBranding extends Customizer {
	/**
	 * Add header branding options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_branding( $wp_customize );

		$this->set_branding_alignment_md( $wp_customize );
		$this->set_logo_alignment_md( $wp_customize );

		$this->set_branding_alignment_sm( $wp_customize );
		$this->set_logo_alignment_sm( $wp_customize );

		$this->set_logo_size_lg( $wp_customize );

		$this->set_logo_size_md( $wp_customize );
		$this->set_site_title_size_md( $wp_customize );
		$this->set_site_tagline_size_md( $wp_customize );

		$this->set_logo_size_sm( $wp_customize );
		$this->set_site_title_size_sm( $wp_customize );
		$this->set_site_tagline_size_sm( $wp_customize );
	}

	/**
	 * Section: Header Branding Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_branding( $wp_customize ) {
		$wp_customize->add_section(
			'sec_branding',
			array(
				'title'       => esc_html__( 'Header Branding', 'oceanly' ),
				'description' => esc_html__( 'You can customize the header branding options in here.', 'oceanly' ),
				'priority'    => 157,
			)
		);
	}

	/**
	 * Setting: Branding Alignment (Medium / Large Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_branding_alignment_md( $wp_customize ) {
		$wp_customize->add_setting(
			'set_branding_alignment_md',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::branding_alignment_md(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_branding_alignment_md',
			array(
				'section'     => 'sec_branding',
				'type'        => 'select',
				'choices'     => $this->branding_alignments(),
				'label'       => esc_html__( 'Branding Alignment (Medium / Large Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Left', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_branding_alignment_md',
			array(
				'selector'            => '.site-header-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Setting: Branding Alignment (Small Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_branding_alignment_sm( $wp_customize ) {
		$wp_customize->add_setting(
			'set_branding_alignment_sm',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::branding_alignment_sm(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_branding_alignment_sm',
			array(
				'section'     => 'sec_branding',
				'type'        => 'select',
				'choices'     => $this->branding_alignments(),
				'label'       => esc_html__( 'Branding Alignment (Small Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Center', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_branding_alignment_sm',
			array(
				'selector'            => '.site-header-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Setting: Logo Alignment (Medium / Large Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_logo_alignment_md( $wp_customize ) {
		$wp_customize->add_setting(
			'set_logo_alignment_md',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::logo_alignment_md(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_logo_alignment_md',
			array(
				'section'     => 'sec_branding',
				'type'        => 'select',
				'choices'     => $this->logo_alignments(),
				'label'       => esc_html__( 'Logo Alignment (Medium / Large Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Left', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_logo_alignment_md',
			array(
				'selector'            => '.site-header-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Setting: Logo Alignment (Small Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_logo_alignment_sm( $wp_customize ) {
		$wp_customize->add_setting(
			'set_logo_alignment_sm',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::logo_alignment_sm(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_logo_alignment_sm',
			array(
				'section'     => 'sec_branding',
				'type'        => 'select',
				'choices'     => $this->logo_alignments(),
				'label'       => esc_html__( 'Logo Alignment (Small Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Top', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_logo_alignment_sm',
			array(
				'selector'            => '.site-header-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Setting: Logo Size (Large Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_logo_size_lg( $wp_customize ) {
		$wp_customize->add_setting(
			'set_logo_size_lg',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::logo_size_lg(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_logo_size_lg',
			array(
				'section'     => 'sec_branding',
				'type'        => 'select',
				'choices'     => $this->logo_sizes(),
				'label'       => esc_html__( 'Logo Size (Large Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Medium', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_logo_size_lg',
			array(
				'selector'            => '.site-header-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Setting: Logo Size (Medium Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_logo_size_md( $wp_customize ) {
		$wp_customize->add_setting(
			'set_logo_size_md',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::logo_size_md(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_logo_size_md',
			array(
				'section'     => 'sec_branding',
				'type'        => 'select',
				'choices'     => $this->logo_sizes(),
				'label'       => esc_html__( 'Logo Size (Medium Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Extra Small', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_logo_size_md',
			array(
				'selector'            => '.site-header-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Setting: Logo Size (Small Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_logo_size_sm( $wp_customize ) {
		$wp_customize->add_setting(
			'set_logo_size_sm',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::logo_size_sm(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_logo_size_sm',
			array(
				'section'     => 'sec_branding',
				'type'        => 'select',
				'choices'     => $this->logo_sizes(),
				'label'       => esc_html__( 'Logo Size (Small Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Extra Small', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_logo_size_sm',
			array(
				'selector'            => '.site-header-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Setting: Site Title Size (Medium / Large Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_site_title_size_md( $wp_customize ) {
		$wp_customize->add_setting(
			'set_site_title_size_md',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::site_title_size_md(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_site_title_size_md',
			array(
				'section'     => 'sec_branding',
				'type'        => 'select',
				'choices'     => $this->site_title_tagline_sizes(),
				'label'       => esc_html__( 'Site Title Size (Medium / Large Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Large', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_site_title_size_md',
			array(
				'selector'            => '.site-header-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Setting: Site Title Size (Small Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_site_title_size_sm( $wp_customize ) {
		$wp_customize->add_setting(
			'set_site_title_size_sm',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::site_title_size_sm(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_site_title_size_sm',
			array(
				'section'     => 'sec_branding',
				'type'        => 'select',
				'choices'     => $this->site_title_tagline_sizes(),
				'label'       => esc_html__( 'Site Title Size (Small Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Medium', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_site_title_size_sm',
			array(
				'selector'            => '.site-header-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Setting: Site Tagline Size (Medium / Large Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_site_tagline_size_md( $wp_customize ) {
		$wp_customize->add_setting(
			'set_site_tagline_size_md',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::site_tagline_size_md(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_site_tagline_size_md',
			array(
				'section'     => 'sec_branding',
				'type'        => 'select',
				'choices'     => $this->site_title_tagline_sizes(),
				'label'       => esc_html__( 'Site Tagline Size (Medium / Large Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Medium', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_site_tagline_size_md',
			array(
				'selector'            => '.site-header-branding',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_site_branding' ),
			)
		);
	}

	/**
	 * Setting: Site Tagline Size (Small Devices).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_site_tagline_size_sm( $wp_customize ) {
		$wp_customize->add_setting(
			'set_site_tagline_size_sm',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::site_tagline_size_sm(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_site_tagline_size_sm',
			array(
				'section'     => 'sec_branding',
				'type'        => 'select',
				'choices'     => $this->site_title_tagline_sizes(),
				'label'       => esc_html__( 'Site Tagline Size (Small Devices)', 'oceanly' ),
				'description' => esc_html__( 'Default: Medium', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_site_tagline_size_sm',
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
	 * Branding Alignments.
	 *
	 * @return array
	 */
	public function branding_alignments() {
		return array(
			'left'   => esc_html__( 'Left', 'oceanly' ),
			'center' => esc_html__( 'Center', 'oceanly' ),
			'right'  => esc_html__( 'Right', 'oceanly' ),
		);
	}

	/**
	 * Logo Alignments.
	 *
	 * @return array
	 */
	public function logo_alignments() {
		return array(
			'top'  => esc_html__( 'Top', 'oceanly' ),
			'left' => esc_html__( 'Left', 'oceanly' ),
		);
	}

	/**
	 * Logo Sizes.
	 *
	 * @return array
	 */
	public function logo_sizes() {
		return array(
			'xs' => esc_html__( 'Extra Small', 'oceanly' ),
			'sm' => esc_html__( 'Small', 'oceanly' ),
			'md' => esc_html__( 'Medium', 'oceanly' ),
			'lg' => esc_html__( 'Large', 'oceanly' ),
			'xl' => esc_html__( 'Extra Large', 'oceanly' ),
		);
	}

	/**
	 * Site Title / Tagline Sizes.
	 *
	 * @return array
	 */
	public function site_title_tagline_sizes() {
		return array(
			'xxs' => esc_html__( 'Extra Small 1', 'oceanly' ),
			'xs'  => esc_html__( 'Extra Small 2', 'oceanly' ),
			'sm'  => esc_html__( 'Small', 'oceanly' ),
			'md'  => esc_html__( 'Medium', 'oceanly' ),
			'lg'  => esc_html__( 'Large', 'oceanly' ),
			'xl'  => esc_html__( 'Extra Large 1', 'oceanly' ),
			'xxl' => esc_html__( 'Extra Large 2', 'oceanly' ),
		);
	}
}
