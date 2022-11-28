<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer related posts options service.
 *
 * @package Oceanly_News_Dark
 */

/**
 * Related posts options service class.
 */
class Oceanly_News_Dark_Related_Posts extends Oceanly\Customizer {
	/**
	 * Add related posts options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$this->sec_related_posts( $wp_customize );

		$this->set_related_posts_enable( $wp_customize );
		$this->set_related_posts_title( $wp_customize );
		$this->set_related_posts_source( $wp_customize );
		$this->set_related_posts_count( $wp_customize );
		$this->set_related_posts_order( $wp_customize );
		$this->set_related_posts_orderby( $wp_customize );
		$this->set_related_posts_taxonomy( $wp_customize );
		$this->set_related_posts_date( $wp_customize );
		$this->set_related_posts_fill( $wp_customize );
	}

	/**
	 * Section: Related Posts.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_related_posts( $wp_customize ) {
		$wp_customize->add_section(
			'sec_related_posts',
			array(
				'title'       => esc_html__( 'Related Posts', 'oceanly-news-dark' ),
				'description' => esc_html__( 'You can configure the related posts options in here.', 'oceanly-news-dark' ),
				'priority'    => 160,
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
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[enable]',
			array(
				'section' => 'sec_related_posts',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Enable Related Posts', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_related_posts[enable]',
			array(
				'selector'            => '.ol-related-posts',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_related_posts' ),
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
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'set_related_posts[title]',
			array(
				'section'     => 'sec_related_posts',
				'type'        => 'text',
				'label'       => esc_html__( 'Related Posts Title', 'oceanly-news-dark' ),
				'description' => esc_html__( 'You can change the heading of the related posts that are shown below the single post content.', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_related_posts[title]',
			array(
				'selector'            => '.ol-related-posts',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_related_posts' ),
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
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[source]',
			array(
				'section'     => 'sec_related_posts',
				'type'        => 'select',
				'choices'     => array(
					'categories' => esc_html__( 'Categories', 'oceanly-news-dark' ),
					'tags'       => esc_html__( 'Tags', 'oceanly-news-dark' ),
				),
				'label'       => esc_html__( 'Related Posts Based On', 'oceanly-news-dark' ),
				'description' => esc_html__( 'Select the source for related posts to display. Default: Categories', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_related_posts[source]',
			array(
				'selector'            => '.ol-related-posts',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_related_posts' ),
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
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[count]',
			array(
				'section'     => 'sec_related_posts',
				'type'        => 'select',
				'choices'     => $this->count(),
				'label'       => esc_html__( 'Related Posts Count', 'oceanly-news-dark' ),
				'description' => esc_html__( 'Set the number of related posts. Default: 4', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_related_posts[count]',
			array(
				'selector'            => '.ol-related-posts',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_related_posts' ),
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
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[order]',
			array(
				'section'     => 'sec_related_posts',
				'type'        => 'select',
				'choices'     => array(
					'desc' => esc_html__( 'Latest First', 'oceanly-news-dark' ),
					'asc'  => esc_html__( 'Oldest First', 'oceanly-news-dark' ),
				),
				'label'       => esc_html__( 'Related Posts Order', 'oceanly-news-dark' ),
				'description' => esc_html__( 'Designates the ascending or descending order. Default: Latest First', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_related_posts[order]',
			array(
				'selector'            => '.ol-related-posts',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_related_posts' ),
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
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[orderby]',
			array(
				'section'     => 'sec_related_posts',
				'type'        => 'select',
				'choices'     => array(
					'rand'     => esc_html__( 'Random Order', 'oceanly-news-dark' ),
					'date'     => esc_html__( 'Post Date', 'oceanly-news-dark' ),
					'modified' => esc_html__( 'Last Modified Date', 'oceanly-news-dark' ),
				),
				'label'       => esc_html__( 'Related Posts Order By', 'oceanly-news-dark' ),
				'description' => esc_html__( 'Sort retrieved related posts by parameter. Default: Random Order', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_related_posts[orderby]',
			array(
				'selector'            => '.ol-related-posts',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_related_posts' ),
			)
		);
	}

	/**
	 * Add setting: Show Post Label.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_related_posts_taxonomy( $wp_customize ) {
		$wp_customize->add_setting(
			'set_related_posts[taxonomy]',
			array(
				'default'           => static::get_related_posts_default( 'taxonomy' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[taxonomy]',
			array(
				'section' => 'sec_related_posts',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show Post Label', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_related_posts[taxonomy]',
			array(
				'selector'            => '.ol-related-posts',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_related_posts' ),
			)
		);
	}

	/**
	 * Add setting: Show Post Date.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_related_posts_date( $wp_customize ) {
		$wp_customize->add_setting(
			'set_related_posts[date]',
			array(
				'default'           => static::get_related_posts_default( 'date' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[date]',
			array(
				'section' => 'sec_related_posts',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show Post Date', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_related_posts[date]',
			array(
				'selector'            => '.ol-related-posts',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_related_posts' ),
			)
		);
	}

	/**
	 * Add setting: Fill Available Space.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_related_posts_fill( $wp_customize ) {
		$wp_customize->add_setting(
			'set_related_posts[fill]',
			array(
				'default'           => static::get_related_posts_default( 'fill' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_related_posts[fill]',
			array(
				'section'     => 'sec_related_posts',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Fill Available Space', 'oceanly-news-dark' ),
				'description' => esc_html__( 'Fill any available space by the columns in a row.', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_related_posts[fill]',
			array(
				'selector'            => '.ol-related-posts',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_related_posts' ),
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
		$default = array(
			'enable'   => true,
			'title'    => esc_html__( 'You may also like', 'oceanly-news-dark' ),
			'source'   => 'categories',
			'count'    => 4,
			'order'    => 'desc',
			'orderby'  => 'rand',
			'taxonomy' => true,
			'date'     => true,
			'fill'     => false,
		);

		if ( array_key_exists( $key, $default ) ) {
			return $default[ $key ];
		}

		return $default;
	}

	/**
	 * Render related posts for selective refresh.
	 *
	 * @return void
	 */
	public function render_related_posts() {
		get_template_part( 'template-parts/related-posts' );
	}

	/**
	 * Posts Count.
	 *
	 * @return array
	 */
	public function count() {
		return array(
			'1'  => esc_html_x( '1', 'Related Posts Count', 'oceanly-news-dark' ),
			'2'  => esc_html_x( '2', 'Related Posts Count', 'oceanly-news-dark' ),
			'3'  => esc_html_x( '3', 'Related Posts Count', 'oceanly-news-dark' ),
			'4'  => esc_html_x( '4', 'Related Posts Count', 'oceanly-news-dark' ),
			'5'  => esc_html_x( '5', 'Related Posts Count', 'oceanly-news-dark' ),
			'6'  => esc_html_x( '6', 'Related Posts Count', 'oceanly-news-dark' ),
			'7'  => esc_html_x( '7', 'Related Posts Count', 'oceanly-news-dark' ),
			'8'  => esc_html_x( '8', 'Related Posts Count', 'oceanly-news-dark' ),
			'9'  => esc_html_x( '9', 'Related Posts Count', 'oceanly-news-dark' ),
			'10' => esc_html_x( '10', 'Related Posts Count', 'oceanly-news-dark' ),
			'11' => esc_html_x( '11', 'Related Posts Count', 'oceanly-news-dark' ),
			'12' => esc_html_x( '12', 'Related Posts Count', 'oceanly-news-dark' ),
		);
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

		return apply_filters(
			'oceanly_related_posts_options_query',
			array(
				'options' => $options,
				'query'   => ( new \WP_Query( $query_args ) ),
			)
		);
	}
}
