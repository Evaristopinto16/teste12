<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Widget service.
 *
 * @package PressBook
 */

namespace PressBook;

/**
 * Register theme widget area.
 */
class Widget implements Serviceable {
	const FOOTER_WIDGETS_COUNT = 4;

	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );

		if ( is_admin() && isset( $GLOBALS['pagenow'] ) && in_array( $GLOBALS['pagenow'], array( 'widgets.php', 'nav-menus.php' ), true ) ) {
			add_filter( 'body_class', array( $this, 'body_classes' ) );
			add_action( 'wp_print_styles', array( $this, 'print_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 11 );
			add_editor_style( get_template_directory_uri() . '/inc/widgets-editor-style.css' );
		}
	}

	/**
	 * Register widget area.
	 */
	public function widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Left Sidebar', 'pressbook' ),
				'id'            => 'sidebar-2',
				'description'   => esc_html__( 'Add widgets here.', 'pressbook' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Right Sidebar', 'pressbook' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'pressbook' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		for ( $i = 1; $i <= self::FOOTER_WIDGETS_COUNT; $i++ ) {
			register_sidebar(
				array(
					/* translators: %s: footer widgets area number */
					'name'          => sprintf( esc_html__( 'Footer Widgets Area %s', 'pressbook' ), $i ),
					'id'            => 'footer-' . $i,
					'description'   => esc_html__( 'Add widgets here.', 'pressbook' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);
		}
	}

	/**
	 * Get total number of active footer widgets area.
	 * return int.
	 */
	public static function get_active_footer_widgets() {
		$total_active = 0;

		for ( $i = 1; $i <= self::FOOTER_WIDGETS_COUNT; $i++ ) {
			if ( is_active_sidebar( 'footer-' . $i ) ) {
				$total_active++;
			}
		}

		return $total_active;
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public function body_classes( $classes ) {
		$classes[] = 'pb-widgets-editor';

		return $classes;
	}

	/**
	 * Remove theme inline style.
	 */
	public function print_styles() {
		if ( wp_style_is( 'pressbook-style', 'enqueued' ) ) {
			wp_style_add_data( 'pressbook-style', 'after', '' );
		}
	}

	/**
	 * Enqueue styles and scripts.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'pressbook-widgets-editor-legacy-style', get_template_directory_uri() . '/inc/widgets-editor-legacy.css', array(), PRESSBOOK_VERSION );
		wp_style_add_data( 'pressbook-widgets-editor-legacy-style', 'rtl', 'replace' );

		// Add output of customizer settings as inline style.
		wp_add_inline_style( 'pressbook-widgets-editor-legacy-style', CSSRules::output_widgets_editor_legacy() );
	}

	/**
	 * Styles keys for the widgets editor legacy CSS output.
	 *
	 * @return array
	 */
	public static function legacy_styles_keys() {
		return apply_filters(
			'pressbook_default_widgets_editor_legacy_styles_keys',
			array(
				'button_bg_color_1',
				'button_bg_color_2',
				'button_font_wgt',
			)
		);
	}
}
