<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Theme services.
 *
 * @package PressBook
 */

namespace PressBook;

/**
 * Register and initialize theme services.
 */
class Theme {
	/**
	 * Get theme services.
	 */
	public static function get_services() {
		return apply_filters(
			'pressbook_services',
			array(
				Setup::class,
				Menu::class,
				Widget::class,
				Header::class,
				Enhance::class,
				Scripts::class,
				IconsHelper::class,
				Editor::class,
				PageSettings::class,
				WooCommerce::class,
				Jetpack::class,
				Options\SiteIdentity::class,
				Options\Colors::class,
				Options\Fonts::class,
				Options\HeaderImage::class,
				Options\TopNavbar::class,
				Options\TopBanner::class,
				Options\PrimaryNavbar::class,
				Options\HeaderBlock::class,
				Options\Content::class,
				Options\Sidebar::class,
				Options\Blog::class,
				Options\General::class,
				Options\FooterBlock::class,
				Options\Footer::class,
				Options\Upsell::class,
			)
		);
	}

	/**
	 * Initialize theme services.
	 */
	public static function init() {
		foreach ( self::get_services() as $class ) {
			self::register_service( new $class() );
		}
	}

	/**
	 * Register a theme service.
	 *
	 * @param Serviceable $service Service instance.
	 */
	private static function register_service( Serviceable $service ) {
		$service->register();
	}
}
