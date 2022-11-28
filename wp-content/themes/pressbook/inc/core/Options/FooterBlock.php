<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer footer block options service.
 *
 * @package PressBook
 */

namespace PressBook\Options;

/**
 * Footer block options service class.
 */
class FooterBlock extends BlockSection {
	const SETTING_KEYS = array( 'id', 'full_width', 'b_margin', 'in_front', 'in_blog', 'in_archive', 'in_post', 'in_page' );

	/**
	 * Add footer block options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_footer_block( $wp_customize );

		$this->set_footer_block( $wp_customize, 1 );
		$this->selective_refresh_block_1( $wp_customize, 1 );
	}

	/**
	 * Section: Footer Block Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_footer_block( $wp_customize ) {
		$wp_customize->add_section(
			'sec_footer_block',
			array(
				'title'       => esc_html__( 'Footer Block', 'pressbook' ),
				'description' => esc_html__( 'You can customize the footer block options in here.', 'pressbook' ),
				'priority'    => 153,
			)
		);
	}

	/**
	 * Add setting: Footer Block.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param int                  $number Block number.
	 */
	public function set_footer_block( $wp_customize, $number = 1 ) {
		$setting_key = ( 'set_footer_block[' . absint( $number ) . ']' );

		$set_id = ( $setting_key . '[id]' );

		$wp_customize->add_setting(
			$set_id,
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_footer_block_default( 'id' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_block_post' ),
			)
		);

		$wp_customize->add_control(
			$set_id,
			array(
				'section'     => 'sec_footer_block',
				'type'        => 'select',
				'choices'     => $this->reusable_blocks_choices(),
				'label'       => sprintf(
					/* translators: %s: footer block number */
					esc_html__( 'Footer Block %s', 'pressbook' ),
					absint( $number )
				),
				'description' => $this->block_description(),
			)
		);

		$set_full_width = ( $setting_key . '[full_width]' );

		$wp_customize->add_setting(
			$set_full_width,
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_footer_block_default( 'full_width' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_full_width,
			array(
				'section'     => 'sec_footer_block',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Set Full Width', 'pressbook' ),
				'description' => sprintf(
					/* translators: %s: footer block number */
					esc_html__( 'Footer Block %s', 'pressbook' ),
					absint( $number )
				),
			)
		);

		$set_b_margin = ( $setting_key . '[b_margin]' );

		$wp_customize->add_setting(
			$set_b_margin,
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_footer_block_default( 'b_margin' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_b_margin,
			array(
				'section'     => 'sec_footer_block',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Bottom Margin', 'pressbook' ),
				'description' => sprintf(
					/* translators: %s: footer block number */
					esc_html__( 'Footer Block %s', 'pressbook' ),
					absint( $number )
				),
			)
		);

		$set_in_front = ( $setting_key . '[in_front]' );

		$wp_customize->add_setting(
			$set_in_front,
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_footer_block_default( 'in_front' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_in_front,
			array(
				'section'     => 'sec_footer_block',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show in Front Page', 'pressbook' ),
				'description' => sprintf(
					/* translators: %s: footer block number */
					esc_html__( 'Footer Block %s', 'pressbook' ),
					absint( $number )
				),
			)
		);

		$set_in_blog = ( $setting_key . '[in_blog]' );

		$wp_customize->add_setting(
			$set_in_blog,
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_footer_block_default( 'in_blog' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_in_blog,
			array(
				'section'     => 'sec_footer_block',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show in Blog Page', 'pressbook' ),
				'description' => sprintf(
					/* translators: %s: footer block number */
					esc_html__( 'Footer Block %s', 'pressbook' ),
					absint( $number )
				),
			)
		);

		$set_in_archive = ( $setting_key . '[in_archive]' );

		$wp_customize->add_setting(
			$set_in_archive,
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_footer_block_default( 'in_archive' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_in_archive,
			array(
				'section'     => 'sec_footer_block',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show in Archive Pages', 'pressbook' ),
				'description' => sprintf(
					/* translators: %s: footer block number */
					esc_html__( 'Footer Block %s', 'pressbook' ),
					absint( $number )
				),
			)
		);

		$set_in_post = ( $setting_key . '[in_post]' );

		$wp_customize->add_setting(
			$set_in_post,
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_footer_block_default( 'in_post' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_in_post,
			array(
				'section'     => 'sec_footer_block',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show in Posts', 'pressbook' ),
				'description' => sprintf(
					/* translators: %s: footer block number */
					esc_html__( 'Footer Block %s', 'pressbook' ),
					absint( $number )
				),
			)
		);

		$set_in_page = ( $setting_key . '[in_page]' );

		$wp_customize->add_setting(
			$set_in_page,
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_footer_block_default( 'in_page' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_in_page,
			array(
				'section'     => 'sec_footer_block',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show in Pages', 'pressbook' ),
				'description' => sprintf(
					/* translators: %s: footer block number */
					esc_html__( 'Footer Block %s', 'pressbook' ),
					absint( $number )
				),
			)
		);
	}

	/**
	 * Get setting: Footer Block.
	 *
	 * @param int $number Block number.
	 * @return array.
	 */
	public static function get_footer_block( $number = 1 ) {
		$setting_key = get_theme_mod( 'set_footer_block', array() );

		if ( array_key_exists( $number, $setting_key ) ) {
			return wp_parse_args(
				$setting_key[ $number ],
				self::get_footer_block_default()
			);
		}

		return self::get_footer_block_default();
	}

	/**
	 * Get default setting: Footer Block.
	 *
	 * @param string $key Setting key.
	 * @return mixed|array
	 */
	public static function get_footer_block_default( $key = '' ) {
		$default = apply_filters(
			'pressbook_default_footer_block',
			array(
				'id'         => '',
				'full_width' => false,
				'b_margin'   => true,
				'in_front'   => true,
				'in_blog'    => true,
				'in_archive' => false,
				'in_post'    => false,
				'in_page'    => false,
			)
		);

		if ( array_key_exists( $key, $default ) ) {
			return $default[ $key ];
		}

		return $default;
	}

	/**
	 * Selective Refresh: Footer Block 1.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param int                  $number Block number.
	 */
	public function selective_refresh_block_1( $wp_customize, $number ) {
		$setting_key = ( 'set_footer_block[' . absint( $number ) . ']' );

		foreach ( static::SETTING_KEYS as $key ) {
			$wp_customize->selective_refresh->add_partial(
				( $setting_key . '[' . $key . ']' ),
				array(
					'selector'            => '.footer-block-' . absint( $number ),
					'container_inclusive' => true,
					'render_callback'     => function() {
						get_template_part( 'template-parts/footer/block-section' );
					},
				)
			);
		}
	}
}
