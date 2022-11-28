<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Editor service.
 *
 * @package PressBook_Masonry_Dark
 */

/**
 * Editor setup.
 */
class PressBook_Masonry_Dark_Editor extends PressBook\Editor {
	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'after_setup_theme', array( $this, 'support_editor_styles' ) );

		add_filter( 'body_class', array( $this, 'body_classes' ) );

		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_assets' ) );
	}

	/**
	 * Support editor styles.
	 */
	public function support_editor_styles() {
		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for dark editor style.
		add_theme_support( 'dark-editor-style' );

		// Enqueue editor styles.
		add_editor_style( 'editor-style.css' );
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public function body_classes( $classes ) {
		// Adds a class of pressbook-dark.
		$classes[] = 'pressbook-dark';

		return $classes;
	}

	/**
	 * Enqueue editor assets.
	 */
	public function enqueue_editor_assets() {
		$current_screen = get_current_screen();
		if ( $current_screen && in_array( $current_screen->id, array( 'widgets', 'nav-menus' ), true ) ) {
			return;
		}

		// Enqueue fonts.
		wp_enqueue_style( 'pressbook-masonry-dark-editor-fonts', PressBook_Masonry_Dark_Scripts::fonts_url(), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

		// Add inline style for fonts in the block editor.
		$this->load_editor_fonts_css();

		// Enqueue the block editor stylesheet.
		wp_enqueue_style( 'pressbook-masonry-dark-block-editor-style', get_theme_file_uri( 'assets/css/block-editor.css' ), array(), PRESSBOOK_MASONRY_DARK_VERSION );

		// Add output of customizer settings as inline style.
		wp_add_inline_style( 'pressbook-masonry-dark-block-editor-style', PressBook_Masonry_Dark_CSSRules::output_editor() );
	}

	/**
	 * Add inline style for fonts in the block editor.
	 */
	public function load_editor_fonts_css() {
		$fonts_css = '';

		/* translators: If there are characters in your language that are not supported by Inter, translate this to 'off'. Do not translate into your own language. */
		$inter = _x( 'on', 'Inter font (in the editor): on or off', 'pressbook-masonry-dark' );
		if ( 'off' !== $inter ) {
			$fonts_css .= ( '.block-editor-page .editor-styles-wrapper{font-family:\'Inter\', Arial, Helvetica, sans-serif;}' );
		}

		/* translators: If there are characters in your language that are not supported by Philosopher, translate this to 'off'. Do not translate into your own language. */
		$philosopher = _x( 'on', 'Philosopher font (in the editor): on or off', 'pressbook-masonry-dark' );
		if ( 'off' !== $philosopher ) {
			$fonts_css .= ( '.editor-styles-wrapper .editor-post-title__input,.editor-styles-wrapper .editor-post-title .editor-post-title__input,.editor-styles-wrapper h1,.editor-styles-wrapper h2,.editor-styles-wrapper h3,.editor-styles-wrapper h4,.editor-styles-wrapper h5,.editor-styles-wrapper h6{font-family:\'Philosopher\', \'Cambria\', sans-serif;}' );
		}

		if ( '' !== $fonts_css ) {
			wp_add_inline_style( 'pressbook-masonry-dark-editor-fonts', $fonts_css );
		}
	}
}
