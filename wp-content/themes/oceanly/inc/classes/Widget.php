<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Widget service.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Register theme widget area.
 */
class Widget implements Serviceable {
	const FOOTER_WIDGETS = 3;

	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );

		if ( is_admin() && isset( $GLOBALS['pagenow'] ) && in_array( $GLOBALS['pagenow'], array( 'widgets.php', 'nav-menus.php' ), true ) ) {
			add_filter( 'body_class', array( $this, 'body_classes' ) );
			add_action( 'wp_print_styles', array( $this, 'print_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 11 );
		}
	}

	/**
	 * Register widget area.
	 */
	public function widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Main Sidebar', 'oceanly' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'oceanly' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		for ( $i = 1; $i <= self::FOOTER_WIDGETS; $i++ ) {
			register_sidebar(
				array(
					/* translators: %s: footer widget area number */
					'name'          => sprintf( esc_html__( 'Footer Widget Area %s', 'oceanly' ), $i ),
					'id'            => 'footer-' . $i,
					'description'   => esc_html__( 'Add widgets here.', 'oceanly' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);
		}
	}

	/**
	 * Get number of active footer widgets area.
	 * return int.
	 */
	public static function footer_widgets_active() {
		$footer_widgets_active = 0;

		for ( $i = 1; $i <= self::FOOTER_WIDGETS; $i++ ) {
			if ( is_active_sidebar( 'footer-' . $i ) ) {
				$footer_widgets_active++;
			}
		}

		return $footer_widgets_active;
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public function body_classes( $classes ) {
		$classes[] = 'oceanly-widgets-editor';

		return $classes;
	}

	/**
	 * Remove theme inline style.
	 */
	public function print_styles() {
		if ( wp_style_is( 'oceanly-style', 'enqueued' ) ) {
			wp_style_add_data( 'oceanly-style', 'after', '' );
		}
	}

	/**
	 * Enqueue styles and scripts.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'oceanly-widgets-editor-legacy-style', get_template_directory_uri() . '/inc/widgets-editor-legacy.css', array(), OCEANLY_VERSION );
	}
}
