<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer featured posts options service.
 *
 * @package Oceanly_News_Dark
 */

/**
 * Featured posts options service class.
 */
class Oceanly_News_Dark_Featured_Posts extends Oceanly\Customizer {
	/**
	 * Register service features.
	 */
	public function register() {
		/**
		 * Featured posts.
		 */
		add_action( 'oceanly_before_header_end', array( $this, 'featured_posts' ), 15 );

		/**
		 * Add featured posts options for the theme customizer.
		 */
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_scripts' ) );
	}

	/**
	 * Add featured posts in the header.
	 */
	public function featured_posts() {
		get_template_part( 'template-parts/header/featured-posts' );
	}

	/**
	 * Add featured posts options for the theme customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		if ( method_exists( $wp_customize, 'register_control_type' ) ) {
			$wp_customize->register_control_type( Oceanly_News_Dark_Select_Multiple::class );
		}

		$this->sec_featured_posts( $wp_customize );

		$this->set_featured_posts_enable( $wp_customize );
		$this->set_featured_posts_show( $wp_customize );
		$this->set_featured_posts_source( $wp_customize );
		$this->set_featured_posts_categories( $wp_customize );
		$this->set_featured_posts_tags( $wp_customize );
		$this->set_featured_posts_count( $wp_customize );
		$this->set_featured_posts_order( $wp_customize );
		$this->set_featured_posts_orderby( $wp_customize );
		$this->set_featured_posts_taxonomy( $wp_customize );
		$this->set_featured_posts_date( $wp_customize );
		$this->set_featured_posts_fill( $wp_customize );
	}

	/**
	 * Contextual controls scripts.
	 */
	public function customize_controls_scripts() {
		wp_enqueue_script( 'oceanly-customizer-contextual', get_stylesheet_directory_uri() . '/assets/js/customizer-contextual.js', array( 'customize-controls' ), OCEANLY_NEWS_DARK_VERSION, true );
	}

	/**
	 * Section: Featured Posts.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sec_featured_posts( $wp_customize ) {
		$wp_customize->add_section(
			'sec_featured_posts',
			array(
				'title'       => esc_html__( 'Featured Posts', 'oceanly-news-dark' ),
				'description' => esc_html__( 'You can configure the featured posts options in here.', 'oceanly-news-dark' ),
				'priority'    => 160,
			)
		);
	}

	/**
	 * Add setting: Enable Featured Posts.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_featured_posts_enable( $wp_customize ) {
		$wp_customize->add_setting(
			'set_featured_posts[enable]',
			array(
				'default'           => static::get_featured_posts_default( 'enable' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_featured_posts[enable]',
			array(
				'section' => 'sec_featured_posts',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Enable Featured Posts', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_featured_posts[enable]',
			array(
				'selector'            => '.featured-posts-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_featured_posts' ),
			)
		);
	}

	/**
	 * Add setting: Featured Posts Show.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_featured_posts_show( $wp_customize ) {
		$default_show = static::get_featured_posts_default( 'show' );

		$set_id = 'set_featured_posts[show]';

		$set_in_front = ( $set_id . '[in_front]' );

		$wp_customize->add_setting(
			$set_in_front,
			array(
				'type'              => 'theme_mod',
				'default'           => $default_show['in_front'],
				'transport'         => 'refresh',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_in_front,
			array(
				'section' => 'sec_featured_posts',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show in Front Page', 'oceanly-news-dark' ),
			)
		);

		$set_in_blog = ( $set_id . '[in_blog]' );

		$wp_customize->add_setting(
			$set_in_blog,
			array(
				'type'              => 'theme_mod',
				'default'           => $default_show['in_blog'],
				'transport'         => 'refresh',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_in_blog,
			array(
				'section' => 'sec_featured_posts',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show in Blog Page', 'oceanly-news-dark' ),
			)
		);

		$set_in_archive = ( $set_id . '[in_archive]' );

		$wp_customize->add_setting(
			$set_in_archive,
			array(
				'type'              => 'theme_mod',
				'default'           => $default_show['in_archive'],
				'transport'         => 'refresh',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_in_archive,
			array(
				'section' => 'sec_featured_posts',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show in Archive Pages', 'oceanly-news-dark' ),
			)
		);

		$set_in_post = ( $set_id . '[in_post]' );

		$wp_customize->add_setting(
			$set_in_post,
			array(
				'type'              => 'theme_mod',
				'default'           => $default_show['in_post'],
				'transport'         => 'refresh',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_in_post,
			array(
				'section' => 'sec_featured_posts',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show in Posts', 'oceanly-news-dark' ),
			)
		);

		$set_in_page = ( $set_id . '[in_page]' );

		$wp_customize->add_setting(
			$set_in_page,
			array(
				'type'              => 'theme_mod',
				'default'           => $default_show['in_page'],
				'transport'         => 'refresh',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			$set_in_page,
			array(
				'section' => 'sec_featured_posts',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show in Pages', 'oceanly-news-dark' ),
			)
		);
	}

	/**
	 * Add setting: Featured Posts Source.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_featured_posts_source( $wp_customize ) {
		$wp_customize->add_setting(
			'set_featured_posts[source]',
			array(
				'default'           => static::get_featured_posts_default( 'source' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_featured_posts[source]',
			array(
				'section'     => 'sec_featured_posts',
				'type'        => 'select',
				'choices'     => array(
					''           => esc_html__( 'All Posts', 'oceanly-news-dark' ),
					'categories' => esc_html__( 'Posts from Selected Categories', 'oceanly-news-dark' ),
					'tags'       => esc_html__( 'Posts from Selected Tags', 'oceanly-news-dark' ),
				),
				'label'       => esc_html__( 'Featured Posts Source', 'oceanly-news-dark' ),
				'description' => esc_html__( 'Default: All Posts', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_featured_posts[source]',
			array(
				'selector'            => '.featured-posts-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_featured_posts' ),
			)
		);
	}

	/**
	 * Add setting: Featured Posts Categories.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_featured_posts_categories( $wp_customize ) {
		$set_id = 'set_featured_posts[categories]';

		$wp_customize->add_setting(
			$set_id,
			array(
				'default'           => static::get_featured_posts_default( 'categories' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( $this, 'sanitize_array' ),
			)
		);

		$control_args = array(
			'section'         => 'sec_featured_posts',
			'type'            => 'oceanly-select-multiple',
			'choices'         => $this->categories(),
			'label'           => esc_html__( 'Featured Posts Categories', 'oceanly-news-dark' ),
			'description'     => esc_html__( 'Select the categories for the featured posts. You can select multiple categories by holding the CTRL key.', 'oceanly-news-dark' ),
			'settings'        => ( isset( $wp_customize->selective_refresh ) ) ? array( $set_id ) : $set_id,
			'active_callback' => function() {
				$featured_posts = static::get_featured_posts();
				if ( 'categories' === $featured_posts['source'] ) {
					return true;
				}

				return false;
			},
		);

		$wp_customize->add_control(
			new Oceanly_News_Dark_Select_Multiple(
				$wp_customize,
				$set_id,
				$control_args
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_featured_posts[categories]',
			array(
				'selector'            => '.featured-posts-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_featured_posts' ),
			)
		);
	}

	/**
	 * Add setting: Featured Posts Tags.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_featured_posts_tags( $wp_customize ) {
		$set_id = 'set_featured_posts[tags]';

		$wp_customize->add_setting(
			$set_id,
			array(
				'default'           => static::get_featured_posts_default( 'tags' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( $this, 'sanitize_array' ),
			)
		);

		$control_args = array(
			'section'         => 'sec_featured_posts',
			'type'            => 'oceanly-select-multiple',
			'choices'         => $this->tags(),
			'label'           => esc_html__( 'Featured Posts Tags', 'oceanly-news-dark' ),
			'description'     => esc_html__( 'Select the tags for the featured posts. You can select multiple tags by holding the CTRL key.', 'oceanly-news-dark' ),
			'settings'        => ( isset( $wp_customize->selective_refresh ) ) ? array( $set_id ) : $set_id,
			'active_callback' => function() {
				$featured_posts = static::get_featured_posts();
				if ( 'tags' === $featured_posts['source'] ) {
					return true;
				}

				return false;
			},
		);

		$wp_customize->add_control(
			new Oceanly_News_Dark_Select_Multiple(
				$wp_customize,
				$set_id,
				$control_args
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_featured_posts[tags]',
			array(
				'selector'            => '.featured-posts-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_featured_posts' ),
			)
		);
	}

	/**
	 * Add setting: Featured Posts Count.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_featured_posts_count( $wp_customize ) {
		$wp_customize->add_setting(
			'set_featured_posts[count]',
			array(
				'default'           => static::get_featured_posts_default( 'count' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_featured_posts[count]',
			array(
				'section'     => 'sec_featured_posts',
				'type'        => 'select',
				'choices'     => $this->count(),
				'label'       => esc_html__( 'Featured Posts Count', 'oceanly-news-dark' ),
				'description' => esc_html__( 'Set the number of featured posts. Default: 4', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_featured_posts[count]',
			array(
				'selector'            => '.featured-posts-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_featured_posts' ),
			)
		);
	}

	/**
	 * Add setting: Featured Posts Order.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_featured_posts_order( $wp_customize ) {
		$wp_customize->add_setting(
			'set_featured_posts[order]',
			array(
				'default'           => static::get_featured_posts_default( 'order' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_featured_posts[order]',
			array(
				'section'     => 'sec_featured_posts',
				'type'        => 'select',
				'choices'     => array(
					'desc' => esc_html__( 'Latest First', 'oceanly-news-dark' ),
					'asc'  => esc_html__( 'Oldest First', 'oceanly-news-dark' ),
				),
				'label'       => esc_html__( 'Featured Posts Order', 'oceanly-news-dark' ),
				'description' => esc_html__( 'Designates the ascending or descending order. Default: Latest First', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_featured_posts[order]',
			array(
				'selector'            => '.featured-posts-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_featured_posts' ),
			)
		);
	}

	/**
	 * Add setting: Featured Posts Order By.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_featured_posts_orderby( $wp_customize ) {
		$wp_customize->add_setting(
			'set_featured_posts[orderby]',
			array(
				'default'           => static::get_featured_posts_default( 'orderby' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'set_featured_posts[orderby]',
			array(
				'section'     => 'sec_featured_posts',
				'type'        => 'select',
				'choices'     => array(
					'rand'     => esc_html__( 'Random Order', 'oceanly-news-dark' ),
					'date'     => esc_html__( 'Post Date', 'oceanly-news-dark' ),
					'modified' => esc_html__( 'Last Modified Date', 'oceanly-news-dark' ),
				),
				'label'       => esc_html__( 'Featured Posts Order By', 'oceanly-news-dark' ),
				'description' => esc_html__( 'Sort retrieved featured posts by parameter. Default: Random Order', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_featured_posts[orderby]',
			array(
				'selector'            => '.featured-posts-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_featured_posts' ),
			)
		);
	}

	/**
	 * Add setting: Show Post Label.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_featured_posts_taxonomy( $wp_customize ) {
		$wp_customize->add_setting(
			'set_featured_posts[taxonomy]',
			array(
				'default'           => static::get_featured_posts_default( 'taxonomy' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_featured_posts[taxonomy]',
			array(
				'section' => 'sec_featured_posts',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show Post Label', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_featured_posts[taxonomy]',
			array(
				'selector'            => '.featured-posts-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_featured_posts' ),
			)
		);
	}

	/**
	 * Add setting: Show Post Date.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_featured_posts_date( $wp_customize ) {
		$wp_customize->add_setting(
			'set_featured_posts[date]',
			array(
				'default'           => static::get_featured_posts_default( 'date' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_featured_posts[date]',
			array(
				'section' => 'sec_featured_posts',
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show Post Date', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_featured_posts[date]',
			array(
				'selector'            => '.featured-posts-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_featured_posts' ),
			)
		);
	}

	/**
	 * Add setting: Fill Available Space.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function set_featured_posts_fill( $wp_customize ) {
		$wp_customize->add_setting(
			'set_featured_posts[fill]',
			array(
				'default'           => static::get_featured_posts_default( 'fill' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => array( Oceanly\Customizer\Sanitizer::class, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'set_featured_posts[fill]',
			array(
				'section'     => 'sec_featured_posts',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Fill Available Space', 'oceanly-news-dark' ),
				'description' => esc_html__( 'Fill any available space by the columns in a row.', 'oceanly-news-dark' ),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'set_featured_posts[fill]',
			array(
				'selector'            => '.featured-posts-wrap',
				'container_inclusive' => true,
				'render_callback'     => array( $this, 'render_featured_posts' ),
			)
		);
	}

	/**
	 * Get setting: Featured Posts.
	 *
	 * @return array
	 */
	public static function get_featured_posts() {
		return wp_parse_args(
			get_theme_mod( 'set_featured_posts', array() ),
			static::get_featured_posts_default()
		);
	}

	/**
	 * Get default setting: Featured Posts.
	 *
	 * @param string $key Setting key.
	 * @return mixed|array
	 */
	public static function get_featured_posts_default( $key = '' ) {
		$default = array(
			'enable'     => true,
			'show'       => array(
				'in_front'   => true,
				'in_blog'    => true,
				'in_archive' => false,
				'in_post'    => false,
				'in_page'    => false,
			),
			'source'     => '',
			'categories' => array(),
			'tags'       => array(),
			'count'      => 6,
			'order'      => 'desc',
			'orderby'    => 'rand',
			'taxonomy'   => true,
			'date'       => true,
			'fill'       => false,
		);

		if ( array_key_exists( $key, $default ) ) {
			return $default[ $key ];
		}

		return $default;
	}

	/**
	 * Render featured posts for selective refresh.
	 *
	 * @return void
	 */
	public function render_featured_posts() {
		get_template_part( 'template-parts/header/featured-posts' );
	}

	/**
	 * Post Categories.
	 *
	 * @return array
	 */
	public function categories() {
		$data       = array();
		$categories = get_categories(
			array(
				'orderby'    => 'count',
				'hide_empty' => false,
			)
		);

		foreach ( $categories as $category ) {
			$data[ $category->term_id ] = $category->name;
		}

		return $data;
	}

	/**
	 * Post Tags.
	 *
	 * @return array
	 */
	public function tags() {
		$data = array();
		$tags = get_tags(
			array(
				'orderby'    => 'count',
				'hide_empty' => false,
			)
		);

		foreach ( $tags as $tag ) {
			$data[ $tag->term_id ] = $tag->name;
		}

		return $data;
	}

	/**
	 * Posts Count.
	 *
	 * @return array
	 */
	public function count() {
		return array(
			'1'  => esc_html_x( '1', 'Featured Posts Count', 'oceanly-news-dark' ),
			'2'  => esc_html_x( '2', 'Featured Posts Count', 'oceanly-news-dark' ),
			'3'  => esc_html_x( '3', 'Featured Posts Count', 'oceanly-news-dark' ),
			'4'  => esc_html_x( '4', 'Featured Posts Count', 'oceanly-news-dark' ),
			'5'  => esc_html_x( '5', 'Featured Posts Count', 'oceanly-news-dark' ),
			'6'  => esc_html_x( '6', 'Featured Posts Count', 'oceanly-news-dark' ),
			'7'  => esc_html_x( '7', 'Featured Posts Count', 'oceanly-news-dark' ),
			'8'  => esc_html_x( '8', 'Featured Posts Count', 'oceanly-news-dark' ),
			'9'  => esc_html_x( '9', 'Featured Posts Count', 'oceanly-news-dark' ),
			'10' => esc_html_x( '10', 'Featured Posts Count', 'oceanly-news-dark' ),
			'11' => esc_html_x( '11', 'Featured Posts Count', 'oceanly-news-dark' ),
			'12' => esc_html_x( '12', 'Featured Posts Count', 'oceanly-news-dark' ),
			'13' => esc_html_x( '13', 'Featured Posts Count', 'oceanly-news-dark' ),
			'14' => esc_html_x( '14', 'Featured Posts Count', 'oceanly-news-dark' ),
			'15' => esc_html_x( '15', 'Featured Posts Count', 'oceanly-news-dark' ),
		);
	}

	/**
	 * Get featured posts options and query.
	 *
	 * @return array|bool
	 */
	public static function options_query() {
		$options = static::get_featured_posts();

		if ( ! $options['enable'] ) {
			return false;
		}

		$show = wp_parse_args(
			$options['show'],
			static::get_featured_posts_default()['show']
		);

		if ( ( is_front_page() && ! $show['in_front'] ) ||
			( is_home() && ! $show['in_blog'] ) ||
			( is_archive() && ! $show['in_archive'] ) ||
			( is_404() ) ||
			( is_search() && ! $show['in_archive'] ) ||
			( is_single() && ! $show['in_post'] ) ||
			( ( ! is_front_page() && is_page() ) && ! $show['in_page'] ) ) {
			return false;
		}

		$query_args = array(
			'post_type'           => array( 'post' ),
			'post_status'         => 'publish',
			'posts_per_page'      => absint( $options['count'] ),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
			'order'               => strtoupper( $options['order'] ),
			'orderby'             => $options['orderby'],
		);

		if ( is_singular( 'post' ) ) {
			$query_args['post__not_in'] = array( get_the_ID() );
		}

		if ( 'categories' === $options['source'] ) {
			if ( is_array( $options['categories'] ) && ! empty( $options['categories'] ) ) {
				$query_args['category__in'] = $options['categories'];
			} else {
				return false;
			}
		} elseif ( 'tags' === $options['source'] ) {
			if ( is_array( $options['tags'] ) && ! empty( $options['tags'] ) ) {
				$query_args['tag__in'] = $options['tags'];
			} else {
				return false;
			}
		}

		return apply_filters(
			'oceanly_featured_posts_options_query',
			array(
				'options' => $options,
				'query'   => ( new \WP_Query( $query_args ) ),
			)
		);
	}

	/**
	 * Sanitize controls that returns array.
	 *
	 * @param mixed $input The input from the setting.
	 * @return array
	 */
	public function sanitize_array( $input ) {
		$output = $input;

		if ( ! is_array( $input ) ) {
			$output = explode( ',', $input );
		}

		if ( ! empty( $output ) ) {
			return array_map( 'sanitize_text_field', $output );
		}

		return array();
	}
}
