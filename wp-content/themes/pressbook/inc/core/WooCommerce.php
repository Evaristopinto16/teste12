<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * WooCommerce compatibility.
 *
 * @link https://woocommerce.com/
 *
 * @package PressBook
 */

namespace PressBook;

/**
 * Setup WooCommerce for the theme.
 */
class WooCommerce implements Serviceable {
	/**
	 * Register service features.
	 */
	public function register() {
		if ( class_exists( '\WooCommerce' ) ) {
			add_action( 'after_setup_theme', array( $this, 'woocommerce_setup' ) );

			add_action( 'widgets_init', array( $this, 'widgets_init' ) );

			add_action( 'wp', array( $this, 'woocommerce_modify' ) );

			add_filter( 'body_class', array( $this, 'body_classes' ) );
		}
	}

	/**
	 * WooCommerce setup function.
	 *
	 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
	 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
	 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
	 *
	 * @return void
	 */
	public function woocommerce_setup() {
		// Add support for WooCommerce.
		add_theme_support(
			'woocommerce',
			array(
				'product_grid' => array(
					'default_rows'    => 8,
					'min_rows'        => 5,
					'max_rows'        => 10,
					'default_columns' => 4,
					'min_columns'     => 2,
					'max_columns'     => 4,
				),
			)
		);

		// Add support for WooCommerce features.
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Remove default WooCommerce wrappers.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}

	/**
	 * Register shop widget area.
	 */
	public function widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Shop Sidebar', 'pressbook' ),
				'id'            => 'sidebar-shop',
				'description'   => esc_html__( 'Add widgets here.', 'pressbook' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

	/**
	 * Modify WooCommerce templates.
	 */
	public function woocommerce_modify() {
		add_action( 'woocommerce_before_main_content', array( $this, 'woocommerce_open_wrapper_columns' ), 7 );

		add_action( 'woocommerce_before_main_content', array( $this, 'woocommerce_open_content_column' ), 9 );

		add_action( 'woocommerce_after_main_content', array( $this, 'woocommerce_close_content_column' ), 7 );

		if ( is_shop() || is_archive() ) {
			// Output the shop sidebar.
			add_action( 'woocommerce_after_main_content', 'woocommerce_get_sidebar', 9 );
		}

		add_action( 'woocommerce_after_main_content', array( $this, 'woocommerce_close_wrapper_columns' ), 11 );
	}

	/**
	 * Opening wrapper.
	 */
	public function woocommerce_open_wrapper_columns() {
		?>
		<div class="pb-content-sidebar u-wrapper">
		<?php
	}

	/**
	 * Closing wrapper.
	 */
	public function woocommerce_close_wrapper_columns() {
		?>
		</div><!-- .pb-content-sidebar -->
		<?php
	}

	/**
	 * Opening shop content.
	 */
	public function woocommerce_open_content_column() {
		?>
		<main id="primary" class="site-main">

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'pb-article pb-singular' ); ?>>

				<div class="pb-content">
					<div class="entry-content">
		<?php
	}

	/**
	 * Closing shop content.
	 */
	public function woocommerce_close_content_column() {
		?>
					</div><!-- .entry-content -->
				</div><!-- .pb-content -->

			</article><!-- #post-<?php the_ID(); ?> -->

		</main><!-- #primary -->
		<?php
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public function body_classes( $classes ) {
		if ( is_active_sidebar( 'sidebar-shop' ) ) {
			$classes[] = 'wc-sidebar';
		} else {
			$classes[] = 'wc-no-sidebar';
		}

		return $classes;
	}
}
