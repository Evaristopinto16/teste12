<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer general options service.
 *
 * @package Oceanly
 */

namespace Oceanly\Customizer;

use Oceanly\Customizer;
use Oceanly\Defaults;

/**
 * General options service class.
 */
class General extends Customizer {
	/**
	 * Add general options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_general( $wp_customize );

		$this->set_show_header_search( $wp_customize );
		$this->set_show_header_breadcrumbs( $wp_customize );

		$this->set_read_more_text( $wp_customize );

		$this->set_blog_content( $wp_customize );
		$this->set_blog_sidebar( $wp_customize );
		$this->set_sticky_sidebar( $wp_customize );
		$this->set_blog_width_no_sidebar( $wp_customize );

		$this->set_post_thumbnail_hover_effect( $wp_customize );
		$this->set_hide_back_to_top( $wp_customize );
	}

	/**
	 * Section: General Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_general( $wp_customize ) {
		$wp_customize->add_section(
			'sec_general',
			array(
				'title'       => esc_html__( 'General Options', 'oceanly' ),
				'description' => esc_html__( 'You can customize the general options in here.', 'oceanly' ),
				'priority'    => 155,
			)
		);
	}

	/**
	 * Setting: Show Header Search Form.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_show_header_search( $wp_customize ) {
		$wp_customize->add_setting(
			'set_show_header_search',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::show_header_search(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_show_header_search',
			array(
				'section'     => 'sec_general',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show Header Search Form', 'oceanly' ),
				'description' => esc_html__( 'You can show or hide search form in the header.', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_show_header_search',
			array(
				'selector'            => '.header-search-form-wrap',
				'container_inclusive' => true,
				'render_callback'     => function() {
					get_template_part( 'template-parts/header/search-form' );
				},
			)
		);
	}

	/**
	 * Setting: Show Header Breadcrumbs.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_show_header_breadcrumbs( $wp_customize ) {
		$wp_customize->add_setting(
			'set_show_header_breadcrumbs',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::show_header_breadcrumbs(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_show_header_breadcrumbs',
			array(
				'section'     => 'sec_general',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show Header Breadcrumbs', 'oceanly' ),
				'description' => esc_html__( 'You can show or hide breadcrumbs in the header.', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_show_header_breadcrumbs',
			array(
				'selector'            => '.site-hero-header .breadcrumbs',
				'container_inclusive' => true,
				'render_callback'     => function() {
					get_template_part( 'template-parts/header/breadcrumbs' );
				},
			)
		);
	}

	/**
	 * Setting: Read More Text.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_read_more_text( $wp_customize ) {
		$wp_customize->add_setting(
			'set_read_more_text',
			array(
				'default'           => Defaults::read_more_text(),
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'set_read_more_text',
			array(
				'section'     => 'sec_general',
				'type'        => 'text',
				'label'       => esc_html__( 'Read More Text', 'oceanly' ),
				'description' => esc_html__( 'You can change the "Read More" text. Leave this empty for default text.', 'oceanly' ),
			)
		);
	}

	/**
	 * Setting: Blog Content Archive.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_blog_content( $wp_customize ) {
		$wp_customize->add_setting(
			'set_blog_content',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::blog_content(),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_blog_content',
			array(
				'section'     => 'sec_general',
				'type'        => 'radio',
				'choices'     => array(
					'full'    => esc_html__( 'Full text', 'oceanly' ),
					'summary' => esc_html__( 'Summary', 'oceanly' ),
				),
				'label'       => esc_html__( 'Blog Content Archive', 'oceanly' ),
				'description' => esc_html__( 'You can choose what to show in blog archive posts and pages (Default: Summary).', 'oceanly' ),
			)
		);
	}

	/**
	 * Setting: Blog Page Sidebar.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_blog_sidebar( $wp_customize ) {
		$wp_customize->add_setting(
			'set_blog_sidebar',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::blog_sidebar(),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_blog_sidebar',
			array(
				'section'     => 'sec_general',
				'type'        => 'radio',
				'choices'     => array(
					'left'  => esc_html__( 'Left Sidebar', 'oceanly' ),
					'right' => esc_html__( 'Right Sidebar', 'oceanly' ),
				),
				'label'       => esc_html__( 'Blog Page Sidebar', 'oceanly' ),
				'description' => esc_html__( 'You can set the sidebar layout for the blog page (Default: Right Sidebar).', 'oceanly' ),
			)
		);
	}

	/**
	 * Setting: Sticky Sidebar.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_sticky_sidebar( $wp_customize ) {
		$wp_customize->add_setting(
			'set_sticky_sidebar',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::sticky_sidebar(),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_sticky_sidebar',
			array(
				'section'     => 'sec_general',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Sticky Sidebar', 'oceanly' ),
				'description' => esc_html__( 'You can enable or disable sticky sidebar that floats on scrolling.', 'oceanly' ),
			)
		);
	}

	/**
	 * Setting: Blog Page Width (No Sidebar).
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_blog_width_no_sidebar( $wp_customize ) {
		$wp_customize->add_setting(
			'set_blog_width_no_sidebar',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::blog_width_no_sidebar(),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_blog_width_no_sidebar',
			array(
				'section'     => 'sec_general',
				'type'        => 'radio',
				'choices'     => array(
					'compact' => esc_html__( 'Compact', 'oceanly' ),
					'full'    => esc_html__( 'Full', 'oceanly' ),
				),
				'label'       => esc_html__( 'Blog Page Width (No Sidebar)', 'oceanly' ),
				'description' => esc_html__( 'You can set the blog page width when there is no active sidebar (Default: Compact).', 'oceanly' ),
			)
		);
	}

	/**
	 * Setting: Post Thumbnail Hover Effect.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_post_thumbnail_hover_effect( $wp_customize ) {
		$wp_customize->add_setting(
			'set_post_thumbnail_hover_effect',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::post_thumbnail_hover_effect(),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_post_thumbnail_hover_effect',
			array(
				'section'     => 'sec_general',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Enable Post Thumbnail Hover Effect', 'oceanly' ),
				'description' => esc_html__( 'You can enable or disable post thumbnail hover effect on blog archive pages.', 'oceanly' ),
			)
		);
	}

	/**
	 * Setting: Hide Back to Top.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_hide_back_to_top( $wp_customize ) {
		$wp_customize->add_setting(
			'set_hide_back_to_top',
			array(
				'type'              => 'theme_mod',
				'default'           => Defaults::hide_back_to_top(),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_hide_back_to_top',
			array(
				'section'     => 'sec_general',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Hide Back to Top', 'oceanly' ),
				'description' => esc_html__( 'You can show or hide the back to top button.', 'oceanly' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_hide_back_to_top',
			array(
				'selector'            => '.back-to-top',
				'container_inclusive' => true,
				'render_callback'     => function() {
					get_template_part( 'template-parts/footer/back-top-top' );
				},
			)
		);
	}
}
