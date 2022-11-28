<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Scripts service.
 *
 * @package PressBook_Masonry_Dark
 */

/**
 * Enqueue theme styles and scripts.
 */
class PressBook_Masonry_Dark_Scripts extends PressBook\Scripts {
	/**
	 * Register service features.
	 */
	public function register() {
		parent::register();

		// Remove parent theme inline stlyes.
		add_action( 'wp_print_styles', array( $this, 'print_styles' ) );

		if ( is_admin() && isset( $GLOBALS['pagenow'] ) && in_array( $GLOBALS['pagenow'], array( 'widgets.php', 'nav-menus.php' ), true ) ) {
			add_action( 'wp_print_styles', array( $this, 'remove_dynamic_styles' ) );
		}
	}

	/**
	 * Enqueue styles and scripts.
	 */
	public function enqueue_scripts() {
		// Enqueue child theme fonts.
		wp_enqueue_style( 'pressbook-masonry-dark-fonts', static::fonts_url(), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

		// Enqueue parent theme styles and scripts.
		parent::enqueue_scripts();

		// Dequeue parent theme fonts.
		wp_dequeue_style( 'pressbook-fonts' );

		// Enqueue child theme stylesheet.
		wp_enqueue_style( 'pressbook-masonry-dark-style', get_stylesheet_directory_uri() . '/style.min.css', array(), PRESSBOOK_MASONRY_DARK_VERSION );
		wp_style_add_data( 'pressbook-masonry-dark-style', 'rtl', 'replace' );

		// Add output of customizer settings as inline style.
		wp_add_inline_style( 'pressbook-masonry-dark-style', PressBook_Masonry_Dark_CSSRules::output() );

		// Masonry script.
		wp_enqueue_script( 'macy', get_stylesheet_directory_uri() . '/assets/macy/macy.min.js', array(), '2.5.1', false );

		$pressbook_masonry_deps = array( 'macy' );
		if ( class_exists( '\Jetpack' ) && \Jetpack::is_module_active( 'infinite-scroll' ) ) {
			array_push( $pressbook_masonry_deps, 'jquery' );
		}

		wp_enqueue_script( 'pressbook-masonry-dark-script', get_stylesheet_directory_uri() . '/assets/js/script.min.js', $pressbook_masonry_deps, PRESSBOOK_MASONRY_DARK_VERSION, true );

		$pressbook_masonry_options = PressBook_Masonry_Dark_Options::get_masonry();
		wp_localize_script(
			'pressbook-masonry-dark-script',
			'pressbookMasonry',
			array(
				'margin'   => absint( $pressbook_masonry_options['margin'] ),
				'cols_2xl' => absint( $pressbook_masonry_options['cols_2xl'] ),
				'cols_xl'  => absint( $pressbook_masonry_options['cols_xl'] ),
				'cols_lg'  => absint( $pressbook_masonry_options['cols_lg'] ),
				'cols_md'  => absint( $pressbook_masonry_options['cols_md'] ),
				'cols_sm'  => absint( $pressbook_masonry_options['cols_sm'] ),
				'cols_xs'  => absint( $pressbook_masonry_options['cols_xs'] ),
			)
		);
	}

	/**
	 * Get fonts URL.
	 */
	public static function fonts_url() {
		$fonts_url = '';

		$font_families = array();

		$query_params = array();

		/* translators: If there are characters in your language that are not supported by Inter, translate this to 'off'. Do not translate into your own language. */
		$inter = _x( 'on', 'Inter font: on or off', 'pressbook-masonry-dark' );
		if ( 'off' !== $inter ) {
			array_push( $font_families, 'Inter:wght@400;600' );
		}

		/* translators: If there are characters in your language that are not supported by Philosopher, translate this to 'off'. Do not translate into your own language. */
		$philosopher = _x( 'on', 'Philosopher font: on or off', 'pressbook-masonry-dark' );
		if ( 'off' !== $philosopher ) {
			array_push( $font_families, 'Philosopher:ital,wght@0,400;0,700;1,400;1,700' );
		}

		if ( count( $font_families ) > 0 ) {
			foreach ( $font_families as $font_family ) {
				array_push( $query_params, ( 'family=' . $font_family ) );
			}

			array_push( $query_params, 'display=swap' );

			$fonts_url = ( 'https://fonts.googleapis.com/css2?' . implode( '&', $query_params ) );
		}

		$fonts_url = apply_filters( 'pressbook_masonry_dark_fonts_url', $fonts_url );

		$fonts_url = esc_url_raw( $fonts_url );

		if ( function_exists( 'wptt_get_webfont_url' ) ) {
			return wptt_get_webfont_url( $fonts_url );
		}

		return $fonts_url;
	}

	/**
	 * Remove parent theme inline style.
	 */
	public function print_styles() {
		if ( wp_style_is( 'pressbook-style', 'enqueued' ) ) {
			wp_style_add_data( 'pressbook-style', 'after', '' );
		}
	}

	/**
	 * Remove theme inline style.
	 */
	public function remove_dynamic_styles() {
		if ( wp_style_is( 'pressbook-masonry-dark-style', 'enqueued' ) ) {
			wp_style_add_data( 'pressbook-masonry-dark-style', 'after', '' );
		}
	}
}
