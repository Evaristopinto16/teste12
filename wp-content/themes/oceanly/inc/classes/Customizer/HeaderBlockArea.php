<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer header block area options service.
 *
 * @package Oceanly
 */

namespace Oceanly\Customizer;

use Oceanly\Defaults;

/**
 * Header block area options service class.
 */
class HeaderBlockArea extends BlockArea {
	const KEYS = array( 'id', 'full_width', 'b_margin', 'in_front', 'in_blog', 'in_archive', 'in_post', 'in_page' );

	/**
	 * Add header block area options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_header_block_area( $wp_customize );

		$this->set_header_block_area( $wp_customize, 1 );
		$this->selective_refresh_block_area_1( $wp_customize, 1 );
	}

	/**
	 * Section: Header Block Area Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_header_block_area( $wp_customize ) {
		$wp_customize->add_section(
			'sec_header_block_area',
			array(
				'title'       => esc_html__( 'Header Block Area', 'oceanly' ),
				'description' => esc_html__( 'You can customize the header block area options in here.', 'oceanly' ),
				'priority'    => 161,
			)
		);
	}

	/**
	 * Setting: Header Block Area.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param int                  $number Block area number.
	 */
	public function set_header_block_area( $wp_customize, $number = 1 ) {
		$setting_key = ( 'set_header_block_area[' . absint( $number ) . ']' );

		$header_block_area_default = Defaults::header_block_area();

		$set_header_block_area_id = ( $setting_key . '[id]' );

		$wp_customize->add_setting(
			$set_header_block_area_id,
			array(
				'type'              => 'theme_mod',
				'default'           => $header_block_area_default['id'],
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_block_post' ),
			)
		);

		$wp_customize->add_control(
			$set_header_block_area_id,
			array(
				'section'     => 'sec_header_block_area',
				'type'        => 'select',
				'choices'     => $this->reusable_blocks_choices(),
				'label'       => sprintf(
					/* translators: %s: block area number */
					esc_html__( 'Header Block Area %s', 'oceanly' ),
					absint( $number )
				),
				'description' => $this->block_area_description(),
			)
		);

		$set_header_block_area_full_width = ( $setting_key . '[full_width]' );

		$wp_customize->add_setting(
			$set_header_block_area_full_width,
			array(
				'type'              => 'theme_mod',
				'default'           => $header_block_area_default['full_width'],
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_header_block_area_full_width,
			array(
				'section'     => 'sec_header_block_area',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Set Full Width', 'oceanly' ),
				'description' => sprintf(
					/* translators: %s: block area number */
					esc_html__( 'Header Block Area %s', 'oceanly' ),
					absint( $number )
				),
			)
		);

		$set_header_block_area_b_margin = ( $setting_key . '[b_margin]' );

		$wp_customize->add_setting(
			$set_header_block_area_b_margin,
			array(
				'type'              => 'theme_mod',
				'default'           => $header_block_area_default['b_margin'],
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_header_block_area_b_margin,
			array(
				'section'     => 'sec_header_block_area',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Bottom Margin', 'oceanly' ),
				'description' => sprintf(
					/* translators: %s: block area number */
					esc_html__( 'Header Block Area %s', 'oceanly' ),
					absint( $number )
				),
			)
		);

		$set_header_block_area_in_front = ( $setting_key . '[in_front]' );

		$wp_customize->add_setting(
			$set_header_block_area_in_front,
			array(
				'type'              => 'theme_mod',
				'default'           => $header_block_area_default['in_front'],
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_header_block_area_in_front,
			array(
				'section'     => 'sec_header_block_area',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show in Front Page', 'oceanly' ),
				'description' => sprintf(
					/* translators: %s: block area number */
					esc_html__( 'Header Block Area %s', 'oceanly' ),
					absint( $number )
				),
			)
		);

		$set_header_block_area_in_blog = ( $setting_key . '[in_blog]' );

		$wp_customize->add_setting(
			$set_header_block_area_in_blog,
			array(
				'type'              => 'theme_mod',
				'default'           => $header_block_area_default['in_blog'],
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_header_block_area_in_blog,
			array(
				'section'     => 'sec_header_block_area',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show in Blog Page', 'oceanly' ),
				'description' => sprintf(
					/* translators: %s: block area number */
					esc_html__( 'Header Block Area %s', 'oceanly' ),
					absint( $number )
				),
			)
		);

		$set_header_block_area_in_archive = ( $setting_key . '[in_archive]' );

		$wp_customize->add_setting(
			$set_header_block_area_in_archive,
			array(
				'type'              => 'theme_mod',
				'default'           => $header_block_area_default['in_archive'],
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_header_block_area_in_archive,
			array(
				'section'     => 'sec_header_block_area',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show in Archive Pages', 'oceanly' ),
				'description' => sprintf(
					/* translators: %s: block area number */
					esc_html__( 'Header Block Area %s', 'oceanly' ),
					absint( $number )
				),
			)
		);

		$set_header_block_area_in_post = ( $setting_key . '[in_post]' );

		$wp_customize->add_setting(
			$set_header_block_area_in_post,
			array(
				'type'              => 'theme_mod',
				'default'           => $header_block_area_default['in_post'],
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_header_block_area_in_post,
			array(
				'section'     => 'sec_header_block_area',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show in Posts', 'oceanly' ),
				'description' => sprintf(
					/* translators: %s: block area number */
					esc_html__( 'Header Block Area %s', 'oceanly' ),
					absint( $number )
				),
			)
		);

		$set_header_block_area_in_page = ( $setting_key . '[in_page]' );

		$wp_customize->add_setting(
			$set_header_block_area_in_page,
			array(
				'type'              => 'theme_mod',
				'default'           => $header_block_area_default['in_page'],
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_header_block_area_in_page,
			array(
				'section'     => 'sec_header_block_area',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show in Pages', 'oceanly' ),
				'description' => sprintf(
					/* translators: %s: block area number */
					esc_html__( 'Header Block Area %s', 'oceanly' ),
					absint( $number )
				),
			)
		);
	}

	/**
	 * Selective Refresh: Header Block Area 1.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param int                  $number Block area number.
	 */
	public function selective_refresh_block_area_1( $wp_customize, $number ) {
		$setting_key = ( 'set_header_block_area[' . absint( $number ) . ']' );

		foreach ( self::KEYS as $key ) {
			$wp_customize->selective_refresh->add_partial(
				( $setting_key . '[' . $key . ']' ),
				array(
					'selector'            => '.header-block-area-' . absint( $number ),
					'container_inclusive' => true,
					'render_callback'     => function() {
						get_template_part( 'template-parts/header/block-area' );
					},
				)
			);
		}
	}
}
