<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Theme setup service.
 *
 * @package PressBook
 */

namespace PressBook;

/**
 * Register theme setup hook.
 */
class Setup implements Serviceable {
	const DEFAULT_BACKGROUND = 'ededed';

	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'after_setup_theme', array( $this, 'set_content_width' ), 0 );

		add_action( 'after_setup_theme', array( $this, 'register_theme_features' ) );
	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	public function set_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'pressbook_content_width', 650 );
	}

	/**
	 * Register theme features.
	 */
	public function register_theme_features() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on PressBook, use a find and replace
		 * to change 'pressbook' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pressbook', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			apply_filters(
				'pressbook_html5_args',
				array(
					'navigation-widgets',
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'style',
					'script',
				)
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'pressbook_custom_background_args',
				array(
					'default-color' => self::DEFAULT_BACKGROUND,
					'default-image' => '',
				)
			)
		);

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for wide alignment.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			apply_filters(
				'pressbook_custom_logo_args',
				array(
					'height'      => 250,
					'width'       => 250,
					'flex-width'  => true,
					'flex-height' => true,
				)
			)
		);

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add theme support for padding controls.
		add_theme_support( 'custom-spacing' );
	}
}
