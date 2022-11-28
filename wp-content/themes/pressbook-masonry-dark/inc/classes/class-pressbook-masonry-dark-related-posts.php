<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer related posts service.
 *
 * @package PressBook_Masonry_Dark
 */

/**
 * Related posts service class.
 */
class PressBook_Masonry_Dark_Related_Posts extends PressBook\Options {
	/**
	 * Add related posts options for theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_posts_related( $wp_customize );

		$this->set_related_posts_enable( $wp_customize );
		$this->set_related_posts_title( $wp_customize );
		$this->set_related_posts_source( $wp_customize );
		$this->set_related_posts_count( $wp_customize );
		$this->set_related_posts_order( $wp_customize );
		$this->set_related_posts_orderby( $wp_customize );
		$this->set_related_posts_taxonomy( $wp_customize );
	}

	/**
	 * Section: Related Posts.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_posts_related( $wp_customize ) {
		$wp_customize->add_section(
			'sec_posts_related',
			array(
				'title'       => esc_html__( 'Related Posts', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'You can customize the related posts options in here.', 'pressbook-masonry-dark' ),
				'priority'    => 158,
			)
		);
	}

	/**
	 * Add setting: Enable Related Posts.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_related_posts_enable( $wp_customize ) {
		$wp_customize->add_setting(
			'set_related_posts[enable]',
			array(
				'default'           => static::get_related_posts_default( 'enable' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[enable]',
			array(
				'section' => 'sec_posts_related',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Enable Related Posts', 'pressbook-masonry-dark' ),
			)
		);
	}

	/**
	 * Add setting: Related Posts Title.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_related_posts_title( $wp_customize ) {
		$wp_customize->add_setting(
			'set_related_posts[title]',
			array(
				'default'           => static::get_related_posts_default( 'title' ),
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'set_related_posts[title]',
			array(
				'section'     => 'sec_posts_related',
				'type'        => 'text',
				'label'       => esc_html__( 'Related Posts Title', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'You can change the heading of the related posts that is shown below the single post content.', 'pressbook-masonry-dark' ),
			)
		);
	}

	/**
	 * Add setting: Related Posts Based On.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_related_posts_source( $wp_customize ) {
		$wp_customize->add_setting(
			'set_related_posts[source]',
			array(
				'default'           => static::get_related_posts_default( 'source' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[source]',
			array(
				'section'     => 'sec_posts_related',
				'type'        => 'select',
				'choices'     => array(
					'categories' => esc_html__( 'Categories', 'pressbook-masonry-dark' ),
					'tags'       => esc_html__( 'Tags', 'pressbook-masonry-dark' ),
				),
				'label'       => esc_html__( 'Related Posts Based On', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Select the source for related posts to display. Default: Categories', 'pressbook-masonry-dark' ),
			)
		);
	}

	/**
	 * Add setting: Related Posts Count.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_related_posts_count( $wp_customize ) {
		$wp_customize->add_setting(
			'set_related_posts[count]',
			array(
				'default'           => static::get_related_posts_default( 'count' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[count]',
			array(
				'section'     => 'sec_posts_related',
				'type'        => 'select',
				'choices'     => $this->count(),
				'label'       => esc_html__( 'Related Posts Count', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Set the number of related posts. Default: 6', 'pressbook-masonry-dark' ),
			)
		);
	}

	/**
	 * Add setting: Related Posts Order.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_related_posts_order( $wp_customize ) {
		$wp_customize->add_setting(
			'set_related_posts[order]',
			array(
				'default'           => static::get_related_posts_default( 'order' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[order]',
			array(
				'section'     => 'sec_posts_related',
				'type'        => 'select',
				'choices'     => $this->order(),
				'label'       => esc_html__( 'Related Posts Order', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Designates the ascending or descending order. Default: Latest First', 'pressbook-masonry-dark' ),
			)
		);
	}

	/**
	 * Add setting: Related Posts Order By.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_related_posts_orderby( $wp_customize ) {
		$wp_customize->add_setting(
			'set_related_posts[orderby]',
			array(
				'default'           => static::get_related_posts_default( 'orderby' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[orderby]',
			array(
				'section'     => 'sec_posts_related',
				'type'        => 'select',
				'choices'     => $this->orderby(),
				'label'       => esc_html__( 'Related Posts Order By', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Sort retrieved related posts by parameter. Default: Random Order', 'pressbook-masonry-dark' ),
			)
		);
	}

	/**
	 * Add setting: Show Taxonomy on Hover.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_related_posts_taxonomy( $wp_customize ) {
		$wp_customize->add_setting(
			'set_related_posts[taxonomy]',
			array(
				'default'           => static::get_related_posts_default( 'taxonomy' ),
				'transport'         => 'refresh',
				'sanitize_callback' => array( PressBook\Options\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[taxonomy]',
			array(
				'section'     => 'sec_posts_related',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show Taxonomy On Hover', 'pressbook-masonry-dark' ),
				'description' => esc_html__( 'Whether to show the post category or tag on hover.', 'pressbook-masonry-dark' ),
			)
		);
	}

	/**
	 * Get setting: Related Posts.
	 *
	 * @return array
	 */
	public static function get_related_posts() {
		return wp_parse_args(
			get_theme_mod( 'set_related_posts', array() ),
			static::get_related_posts_default()
		);
	}

	/**
	 * Get default setting: Related Posts.
	 *
	 * @param string $key Setting key.
	 * @return mixed|array
	 */
	public static function get_related_posts_default( $key = '' ) {
		$default = apply_filters(
			'pressbook_default_related_posts',
			array(
				'enable'   => true,
				'title'    => esc_html__( 'Related Posts', 'pressbook-masonry-dark' ),
				'source'   => 'categories',
				'count'    => 6,
				'order'    => 'desc',
				'orderby'  => 'rand',
				'taxonomy' => true,
			)
		);

		if ( array_key_exists( $key, $default ) ) {
			return $default[ $key ];
		}

		return $default;
	}

	/**
	 * Get related posts options and query.
	 *
	 * @return array|bool
	 */
	public static function options_query() {
		$options = static::get_related_posts();

		if ( ! $options['enable'] ) {
			return false;
		}

		$query_args = array(
			'post_type'           => array( 'post' ),
			'post_status'         => 'publish',
			'posts_per_page'      => absint( $options['count'] ),
			'post__not_in'        => array( get_the_ID() ),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
			'order'               => strtoupper( $options['order'] ),
			'orderby'             => $options['orderby'],
		);

		if ( 'tags' === $options['source'] ) {
			$tags_id = wp_get_post_tags( get_the_ID(), array( 'fields' => 'ids' ) );
			if ( ! is_wp_error( $tags_id ) && ! empty( $tags_id ) ) {
				$query_args['tag__in'] = $tags_id;
			} else {
				return false;
			}
		} else {
			$categories_id = wp_get_post_categories( get_the_ID(), array( 'fields' => 'ids' ) );
			if ( ! is_wp_error( $categories_id ) && ! empty( $categories_id ) ) {
				$query_args['category__in'] = $categories_id;
			} else {
				return false;
			}
		}

		return array(
			'options' => $options,
			'query'   => ( new \WP_Query( $query_args ) ),
		);
	}

	/**
	 * Posts Source.
	 *
	 * @return array
	 */
	public function source() {
		return array(
			''           => esc_html__( 'All Posts', 'pressbook-masonry-dark' ),
			'categories' => esc_html__( 'Posts from Selected Categories', 'pressbook-masonry-dark' ),
			'tags'       => esc_html__( 'Posts from Selected Tags', 'pressbook-masonry-dark' ),
		);
	}

	/**
	 * Posts Count.
	 *
	 * @return array
	 */
	public function count() {
		return array(
			'1'  => esc_html_x( '1', 'Related Posts Count', 'pressbook-masonry-dark' ),
			'2'  => esc_html_x( '2', 'Related Posts Count', 'pressbook-masonry-dark' ),
			'3'  => esc_html_x( '3', 'Related Posts Count', 'pressbook-masonry-dark' ),
			'4'  => esc_html_x( '4', 'Related Posts Count', 'pressbook-masonry-dark' ),
			'5'  => esc_html_x( '5', 'Related Posts Count', 'pressbook-masonry-dark' ),
			'6'  => esc_html_x( '6', 'Related Posts Count', 'pressbook-masonry-dark' ),
			'7'  => esc_html_x( '7', 'Related Posts Count', 'pressbook-masonry-dark' ),
			'8'  => esc_html_x( '8', 'Related Posts Count', 'pressbook-masonry-dark' ),
			'9'  => esc_html_x( '9', 'Related Posts Count', 'pressbook-masonry-dark' ),
			'10' => esc_html_x( '10', 'Related Posts Count', 'pressbook-masonry-dark' ),
			'11' => esc_html_x( '11', 'Related Posts Count', 'pressbook-masonry-dark' ),
			'12' => esc_html_x( '12', 'Related Posts Count', 'pressbook-masonry-dark' ),
		);
	}

	/**
	 * Posts Order.
	 *
	 * @return array
	 */
	public function order() {
		return array(
			'desc' => esc_html__( 'Latest First', 'pressbook-masonry-dark' ),
			'asc'  => esc_html__( 'Oldest First', 'pressbook-masonry-dark' ),
		);
	}

	/**
	 * Posts Order By.
	 *
	 * @return array
	 */
	public function orderby() {
		return array(
			'rand'     => esc_html__( 'Random Order', 'pressbook-masonry-dark' ),
			'date'     => esc_html__( 'Post Date', 'pressbook-masonry-dark' ),
			'modified' => esc_html__( 'Last Modified Date', 'pressbook-masonry-dark' ),
		);
	}
}
