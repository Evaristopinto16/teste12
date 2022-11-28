<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer top banner options service.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use PressBook\Options;
use PressBook\CSSRules;

/**
 * Top banner options service class
 */
class TopBanner extends Options {
	const MAIN_SETTING_KEYS   = array( 'image', 'link_url', 'link_title', 'link_rel', 'link_new_tab', 'shadow' );
	const DEVICE_SETTING_KEYS = array( 'hide_sm', 'hide_md' );

	/**
	 * Add top banner options for theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_top_banner( $wp_customize );

		$this->set_top_banner_image( $wp_customize );
		$this->set_top_banner_link_url( $wp_customize );
		$this->set_top_banner_link_title( $wp_customize );
		$this->set_top_banner_link_rel( $wp_customize );
		$this->set_top_banner_link_new_tab( $wp_customize );
		$this->set_top_banner_shadow( $wp_customize );
		$this->set_top_banner_max_height( $wp_customize );
		$this->set_top_banner_hide_sm( $wp_customize );
		$this->set_top_banner_hide_md( $wp_customize );
		$this->selective_refresh_top_banner_main_keys( $wp_customize );
		$this->selective_refresh_top_banner_device_keys( $wp_customize );

		$this->set_top_banner_block( $wp_customize );
	}

	/**
	 * Section: Top Banner Options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_top_banner( $wp_customize ) {
		$wp_customize->add_section(
			'sec_top_banner',
			array(
				'title'       => esc_html__( 'Top Banner', 'pressbook' ),
				'description' => esc_html__( 'You can customize the top banner options in here.', 'pressbook' ),
				'priority'    => 152,
			)
		);
	}

	/**
	 * Add setting: Top Banner Image.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_top_banner_image( $wp_customize ) {
		$wp_customize->add_setting(
			'set_top_banner[image]',
			array(
				'default'           => self::get_top_banner_default( 'image' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'set_top_banner[image]',
				array(
					'section'     => 'sec_top_banner',
					'label'       => esc_html__( 'Top Banner Image', 'pressbook' ),
					'description' => esc_html__( 'Select the top banner image. The theme works best with an image size of 728 x 90 pixels. ', 'pressbook' ),
					'flex_width'  => true,
					'flex_height' => true,
					'width'       => 728,
					'height'      => 90,
				)
			)
		);
	}

	/**
	 * Add setting: Top Banner Link - URL.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_top_banner_link_url( $wp_customize ) {
		$wp_customize->add_setting(
			'set_top_banner[link_url]',
			array(
				'default'           => self::get_top_banner_default( 'link_url' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'set_top_banner[link_url]',
			array(
				'section'     => 'sec_top_banner',
				'type'        => 'url',
				'label'       => esc_html__( 'Top Banner Link - URL', 'pressbook' ),
				'description' => esc_html__( 'Enter the URL for the banner link.', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Top Banner Link - Title.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_top_banner_link_title( $wp_customize ) {
		$wp_customize->add_setting(
			'set_top_banner[link_title]',
			array(
				'default'           => self::get_top_banner_default( 'link_title' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'set_top_banner[link_title]',
			array(
				'section'     => 'sec_top_banner',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Banner Link - Title', 'pressbook' ),
				'description' => esc_html__( 'Enter the "title" attribute for the banner link.', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Top Banner Link - Rel.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_top_banner_link_rel( $wp_customize ) {
		$wp_customize->add_setting(
			'set_top_banner[link_rel]',
			array(
				'default'           => self::get_top_banner_default( 'link_rel' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'set_top_banner[link_rel]',
			array(
				'section'     => 'sec_top_banner',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Banner Link - Rel', 'pressbook' ),
				'description' => esc_html__( 'Enter the "rel" attribute for the banner link.', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Top Banner Link - Open in New Tab.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_top_banner_link_new_tab( $wp_customize ) {
		$wp_customize->add_setting(
			'set_top_banner[link_new_tab]',
			array(
				'default'           => self::get_top_banner_default( 'link_new_tab' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_top_banner[link_new_tab]',
			array(
				'section' => 'sec_top_banner',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Top Banner Link - Open in New Tab', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Top Banner Shadow Effect.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_top_banner_shadow( $wp_customize ) {
		$wp_customize->add_setting(
			'set_top_banner[shadow]',
			array(
				'default'           => self::get_top_banner_default( 'shadow' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_top_banner[shadow]',
			array(
				'section' => 'sec_top_banner',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Top Banner Shadow Effect', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Top Banner Maximum Height.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_top_banner_max_height( $wp_customize ) {
		$wp_customize->add_setting(
			'set_styles[top_banner_max_height]',
			array(
				'default'           => CSSRules::default_styles( 'top_banner_max_height' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			'set_styles[top_banner_max_height]',
			array(
				'section'     => 'sec_top_banner',
				'type'        => 'number',
				'label'       => esc_html__( 'Top Banner Maximum Height', 'pressbook' ),
				'description' => esc_html__( 'Set the maximum height allowed for the top banner image in pixels. Default: 150', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Hide in Small-Screen Devices.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_top_banner_hide_sm( $wp_customize ) {
		$wp_customize->add_setting(
			'set_top_banner[hide_sm]',
			array(
				'default'           => self::get_top_banner_default( 'hide_sm' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_top_banner[hide_sm]',
			array(
				'section' => 'sec_top_banner',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Hide in Small-Screen Devices', 'pressbook' ),
			)
		);
	}

	/**
	 * Add setting: Hide in Medium-Screen Devices.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_top_banner_hide_md( $wp_customize ) {
		$wp_customize->add_setting(
			'set_top_banner[hide_md]',
			array(
				'default'           => self::get_top_banner_default( 'hide_md' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_top_banner[hide_md]',
			array(
				'section' => 'sec_top_banner',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Hide in Medium-Screen Devices', 'pressbook' ),
			)
		);
	}

	/**
	 * Get setting: Top Banner.
	 *
	 * @return array
	 */
	public static function get_top_banner() {
		return wp_parse_args(
			get_theme_mod( 'set_top_banner', array() ),
			self::get_top_banner_default()
		);
	}

	/**
	 * Get default setting: Top Banner.
	 *
	 * @param string $key Setting key.
	 * @return mixed|array
	 */
	public static function get_top_banner_default( $key = '' ) {
		$default = apply_filters(
			'pressbook_default_top_banner',
			array(
				'image'        => '',
				'link_url'     => '#',
				'link_title'   => '',
				'link_rel'     => '',
				'link_new_tab' => true,
				'shadow'       => false,
				'hide_sm'      => true,
				'hide_md'      => false,
			)
		);

		if ( array_key_exists( $key, $default ) ) {
			return $default[ $key ];
		}

		return $default;
	}

	/**
	 * Selective Refresh: Top Banner Main Keys.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function selective_refresh_top_banner_main_keys( $wp_customize ) {
		foreach ( self::MAIN_SETTING_KEYS as $key ) {
			$wp_customize->selective_refresh->add_partial(
				( 'set_top_banner[' . $key . ']' ),
				array(
					'selector'            => '.top-banner',
					'container_inclusive' => true,
					'render_callback'     => function() {
						get_template_part( 'template-parts/header/top-banner' );
					},
				)
			);
		}
	}

	/**
	 * Selective Refresh: Top Banner Device Keys.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function selective_refresh_top_banner_device_keys( $wp_customize ) {
		foreach ( self::DEVICE_SETTING_KEYS as $key ) {
			$wp_customize->selective_refresh->add_partial(
				( 'set_top_banner[' . $key . ']' ),
				array(
					'selector'            => '.site-branding',
					'container_inclusive' => true,
					'render_callback'     => function() {
						get_template_part( 'template-parts/header/site-branding' );
					},
				)
			);
		}
	}

	/**
	 * Get top banner class.
	 *
	 * @param array $top_banner Top banner settings.
	 * @return string
	 */
	public static function top_banner_class( $top_banner ) {
		$top_banner_class = 'top-banner';
		if ( $top_banner['shadow'] ) {
			$top_banner_class .= ' top-banner-shadow';
		}

		if ( $top_banner['hide_sm'] ) {
			$top_banner_class .= ' top-banner-hide-sm';
		}
		if ( $top_banner['hide_md'] ) {
			$top_banner_class .= ' top-banner-hide-md';
		}

		return apply_filters( 'pressbook_top_banner_class', $top_banner_class, $top_banner );
	}

	/**
	 * Add setting: Top Banner Block Section.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_top_banner_block( $wp_customize ) {
		$wp_customize->add_setting(
			'set_top_banner_block',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_top_banner_block( true ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( Sanitizer::class, 'sanitize_block_post' ),
			)
		);

		$wp_customize->add_control(
			'set_top_banner_block',
			array(
				'section'     => 'sec_top_banner',
				'type'        => 'select',
				'choices'     => $this->reusable_blocks_choices(),
				'label'       => esc_html__( 'Top Banner Block Section', 'pressbook' ),
				'description' => wp_kses(
					sprintf(
						/* translators: %s: URL to the reusable-blocks admin page. */
						__( 'You can use this to replace top banner image and use any custom block (For example: "Custom HTML block"). This is the content of the block section. You can create or edit the block section in the <a href="%s" target="_blank">Reusable Blocks Manager (opens in a new window)</a>.<br>After creating the reusable block, you may need to refresh this customizer page and then select the newly created block.<br>The selected block content will appear on the block section, replacing the top banner image and overriding its related options.', 'pressbook' ),
						esc_url( admin_url( 'edit.php?post_type=wp_block' ) )
					),
					array(
						'a'  => array(
							'href'   => array(),
							'target' => array(),
						),
						'br' => array(),
					)
				),
			)
		);
	}

	/**
	 * Get setting: Top Banner Block Section.
	 *
	 * @param bool $get_default Get default.
	 * @return string
	 */
	public static function get_top_banner_block( $get_default = false ) {
		$default = apply_filters( 'pressbook_top_banner_block_default', '' );
		if ( $get_default ) {
			return $default;
		}

		return get_theme_mod( 'set_top_banner_block', $default );
	}

	/**
	 * Get an array of reusable-blocks formatted as [ ID => Title ].
	 *
	 * @return array
	 */
	public function reusable_blocks_choices() {
		$reusable_blocks = get_posts(
			array(
				'post_type'   => 'wp_block',
				'numberposts' => 100,
			)
		);

		$reusable_blocks_choices = array( 0 => esc_html__( 'Select a block', 'pressbook' ) );
		foreach ( $reusable_blocks as $block ) {
			$reusable_blocks_choices[ $block->ID ] = $block->post_title;
		}

		return $reusable_blocks_choices;
	}
}
