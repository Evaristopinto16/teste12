<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer blog options service.
 *
 * @package PressBook_Masonry_Dark
 */

/**
 * Blog options service class.
 */
class PressBook_Masonry_Dark_Options extends PressBook\Options {
	/**
	 * Allows to define customizer sections, settings, and controls.
	 */
	public function register() {
		add_filter( 'body_class', array( $this, 'body_classes' ), 15 );

		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public function body_classes( $classes ) {
		if ( have_posts() ) {
			$classes[] = 'pb-content-grid';

			if ( in_array( 'pb-content-columns pb-content-cover', $classes, true ) ) {
				unset( $classes[ array_search( 'pb-content-columns pb-content-cover', $classes, true ) ] );
			} elseif ( in_array( 'pb-content-columns', $classes, true ) ) {
				unset( $classes[ array_search( 'pb-content-columns', $classes, true ) ] );
			}
		}

		return $classes;
	}

	/**
	 * Add blog options for theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->set_masonry_margin( $wp_customize );
		$this->set_masonry_cols_2xl( $wp_customize );
		$this->set_masonry_cols_xl( $wp_customize );
		$this->set_masonry_cols_lg( $wp_customize );
		$this->set_masonry_cols_md( $wp_customize );
		$this->set_masonry_cols_sm( $wp_customize );
		$this->set_masonry_cols_xs( $wp_customize );

		$this->set_posts_grid_shadow( $wp_customize );
		$this->set_posts_grid_excerpt( $wp_customize );

		$wp_customize->remove_control( 'set_archive_post_layout_lg' );
		$wp_customize->remove_control( 'set_archive_content' );
	}

	/**
	 * Add setting: Masonry Grid - Columns Margin.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_masonry_margin( $wp_customize ) {
		$wp_customize->add_setting(
			'set_masonry[margin]',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_masonry_default( 'margin' ),
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			'set_masonry[margin]',
			array(
				'section'     => 'sec_blog',
				'type'        => 'number',
				'label'       => esc_html__( 'Masonry Grid - Columns Margin', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Adjust the margin between columns with a pixel value. Default: 24', 'pressbook-masonry-dark' ),
				'priority'    => 8,
			)
		);
	}

	/**
	 * Add setting: Number Of Columns (2xl) - Masonry.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_masonry_cols_2xl( $wp_customize ) {
		$wp_customize->add_setting(
			'set_masonry[cols_2xl]',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_masonry_default( 'cols_2xl' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_masonry[cols_2xl]',
			array(
				'section'     => 'sec_blog',
				'type'        => 'select',
				'choices'     => $this->masonry_cols(),
				'label'       => esc_html__( 'Number Of Columns (2xl) - Masonry', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Extra Large (2xl) Screen-Devices. Default: 3', 'pressbook-masonry-dark' ),
				'priority'    => 8,
			)
		);
	}

	/**
	 * Add setting: Number Of Columns (xl) - Masonry.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_masonry_cols_xl( $wp_customize ) {
		$wp_customize->add_setting(
			'set_masonry[cols_xl]',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_masonry_default( 'cols_xl' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_masonry[cols_xl]',
			array(
				'section'     => 'sec_blog',
				'type'        => 'select',
				'choices'     => $this->masonry_cols(),
				'label'       => esc_html__( 'Number Of Columns (xl) - Masonry', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Extra Large (xl) Screen-Devices. Default: 3', 'pressbook-masonry-dark' ),
				'priority'    => 8,
			)
		);
	}

	/**
	 * Add setting: Number Of Columns (lg) - Masonry.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_masonry_cols_lg( $wp_customize ) {
		$wp_customize->add_setting(
			'set_masonry[cols_lg]',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_masonry_default( 'cols_lg' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_masonry[cols_lg]',
			array(
				'section'     => 'sec_blog',
				'type'        => 'select',
				'choices'     => $this->masonry_cols(),
				'label'       => esc_html__( 'Number Of Columns (lg) - Masonry', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Large (lg) Screen-Devices. Default: 2', 'pressbook-masonry-dark' ),
				'priority'    => 8,
			)
		);
	}

	/**
	 * Add setting: Number Of Columns (md) - Masonry.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_masonry_cols_md( $wp_customize ) {
		$wp_customize->add_setting(
			'set_masonry[cols_md]',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_masonry_default( 'cols_md' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_masonry[cols_md]',
			array(
				'section'     => 'sec_blog',
				'type'        => 'select',
				'choices'     => $this->masonry_cols(),
				'label'       => esc_html__( 'Number Of Columns (md) - Masonry', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Medium (md) Screen-Devices. Default: 2', 'pressbook-masonry-dark' ),
				'priority'    => 8,
			)
		);
	}

	/**
	 * Add setting: Number Of Columns (sm) - Masonry.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_masonry_cols_sm( $wp_customize ) {
		$wp_customize->add_setting(
			'set_masonry[cols_sm]',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_masonry_default( 'cols_sm' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_masonry[cols_sm]',
			array(
				'section'     => 'sec_blog',
				'type'        => 'select',
				'choices'     => $this->masonry_cols(),
				'label'       => esc_html__( 'Number Of Columns (sm) - Masonry', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Small (sm) Screen-Devices. Default: 1', 'pressbook-masonry-dark' ),
				'priority'    => 8,
			)
		);
	}

	/**
	 * Add setting: Number Of Columns (xs) - Masonry.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_masonry_cols_xs( $wp_customize ) {
		$wp_customize->add_setting(
			'set_masonry[cols_xs]',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_masonry_default( 'cols_xs' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_masonry[cols_xs]',
			array(
				'section'     => 'sec_blog',
				'type'        => 'select',
				'choices'     => $this->masonry_cols(),
				'label'       => esc_html__( 'Number Of Columns (xs) - Masonry', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Extra Small (xs) Screen-Devices. Default: 1', 'pressbook-masonry-dark' ),
				'priority'    => 8,
			)
		);
	}

	/**
	 * Get setting: Masonry.
	 *
	 * @return array
	 */
	public static function get_masonry() {
		return wp_parse_args(
			get_theme_mod( 'set_masonry', array() ),
			self::get_masonry_default()
		);
	}

	/**
	 * Get default setting: Masonry.
	 *
	 * @param string $key Setting key.
	 * @return mixed|array
	 */
	public static function get_masonry_default( $key = '' ) {
		$default = apply_filters(
			'pressbook_default_masonry',
			array(
				'margin'   => 24,
				'cols_2xl' => 3,
				'cols_xl'  => 3,
				'cols_lg'  => 2,
				'cols_md'  => 2,
				'cols_sm'  => 1,
				'cols_xs'  => 1,
			)
		);

		if ( array_key_exists( $key, $default ) ) {
			return $default[ $key ];
		}

		return $default;
	}

	/**
	 * Add setting: Post Card Shadow Effect.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_posts_grid_shadow( $wp_customize ) {
		$wp_customize->add_setting(
			'set_posts_grid_shadow',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_posts_grid_shadow( true ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_posts_grid_shadow',
			array(
				'section'     => 'sec_blog',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Post Card Shadow Effect', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Show shadow effect around the post card.', 'pressbook-masonry-dark' ),
				'priority'    => 8,
			)
		);
	}

	/**
	 * Get setting: Post Card Shadow Effect.
	 *
	 * @param bool $get_default Get default.
	 * @return bool
	 */
	public static function get_posts_grid_shadow( $get_default = false ) {
		$default = apply_filters( 'pressbook_default_posts_grid_shadow', true );
		if ( $get_default ) {
			return $default;
		}

		return get_theme_mod( 'set_posts_grid_shadow', $default );
	}

	/**
	 * Add setting: Post Card Summary.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_posts_grid_excerpt( $wp_customize ) {
		$wp_customize->add_setting(
			'set_posts_grid_excerpt',
			array(
				'type'              => 'theme_mod',
				'default'           => self::get_posts_grid_excerpt( true ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_posts_grid_excerpt',
			array(
				'section'     => 'sec_blog',
				'type'        => 'radio',
				'choices'     => array(
					''  => esc_html__( 'Hide summary for all posts in a grid.', 'pressbook-masonry-dark' ),
					'1' => esc_html__( 'Show summary only when there is no featured image.', 'pressbook-masonry-dark' ),
					'2' => esc_html__( 'Show summary even when there is featured image.', 'pressbook-masonry-dark' ),
				),
				'label'       => esc_html__( 'Post Card Summary', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Select when to show the post summary in the posts grid.', 'pressbook-masonry-dark' ),
				'priority'    => 8,
			)
		);
	}

	/**
	 * Get setting: Post Card Summary.
	 *
	 * @param bool $get_default Get default.
	 * @return string
	 */
	public static function get_posts_grid_excerpt( $get_default = false ) {
		$default = apply_filters( 'pressbook_default_posts_grid_excerpt', '1' );
		if ( $get_default ) {
			return $default;
		}

		return get_theme_mod( 'set_posts_grid_excerpt', $default );
	}

	/**
	 * Get blog site main class.
	 *
	 * @return string
	 */
	public static function blog_site_main_class() {
		$site_main_class = 'site-main';
		if ( have_posts() ) {
			$site_main_class .= ' site-main-grid';
		}

		return apply_filters( 'pressbook_blog_site_main_class', $site_main_class );
	}

	/**
	 * Get grid post row class.
	 *
	 * @return string
	 */
	public static function grid_post_row_class() {
		$grid_post_row_class = 'pb-grid-post-row';
		if ( self::get_posts_grid_shadow() ) {
			$grid_post_row_class .= ' pb-grid-post-shadow';
		}

		$hide_post_meta = PressBook\Options\Blog::get_hide_post_meta();

		if ( $hide_post_meta['all'] && $hide_post_meta['cat'] ) {
			$grid_post_row_class .= ' pb-grid-post-hide-meta-all';
		} else {
			if ( $hide_post_meta['all'] ) {
				$grid_post_row_class .= ' pb-grid-post-hide-meta';
			}

			if ( $hide_post_meta['cat'] ) {
				$grid_post_row_class .= ' pb-grid-post-hide-cat';
			}
		}

		return apply_filters( 'pressbook_grid_post_row_class', $grid_post_row_class );
	}

	/**
	 * Output the post excerpt in the posts grid.
	 */
	public static function the_grid_post_exceprt() {
		$posts_grid_excerpt = self::get_posts_grid_excerpt();

		if ( ! $posts_grid_excerpt ) {
			return;
		}

		if ( '1' === $posts_grid_excerpt ) {
			if ( ! has_post_thumbnail() && ( '' !== get_the_excerpt() ) ) {
				?>
				<div class="entry-summary"><?php the_excerpt(); ?></div>
				<?php
			}
		} elseif ( '2' === $posts_grid_excerpt ) {
			if ( '' !== get_the_excerpt() ) {
				?>
				<div class="entry-summary"><?php the_excerpt(); ?></div>
				<?php
			}
		}
	}

	/**
	 * Number Of Columns - Masonry Grid.
	 *
	 * @return array
	 */
	public function masonry_cols() {
		return array(
			'1' => esc_html_x( '1', 'Number of columns - Masonry', 'pressbook-masonry-dark' ),
			'2' => esc_html_x( '2', 'Number of columns - Masonry', 'pressbook-masonry-dark' ),
			'3' => esc_html_x( '3', 'Number of columns - Masonry', 'pressbook-masonry-dark' ),
			'4' => esc_html_x( '4', 'Number of columns - Masonry', 'pressbook-masonry-dark' ),
			'5' => esc_html_x( '5', 'Number of columns - Masonry', 'pressbook-masonry-dark' ),
			'6' => esc_html_x( '6', 'Number of columns - Masonry', 'pressbook-masonry-dark' ),
			'7' => esc_html_x( '7', 'Number of columns - Masonry', 'pressbook-masonry-dark' ),
		);
	}
}
