<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Theme services.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Register and initialize theme services.
 */
class Theme {
	/**
	 * Get theme services.
	 */
	public static function get_services() {
		return apply_filters(
			'oceanly_services',
			array(
				Setup::class,
				Menu::class,
				Widget::class,
				Header::class,
				Enhance::class,
				Enqueue::class,
				Hooks::class,
				Metabox::class,
				IconsHelper::class,
				WooCommerce::class,
				Jetpack::class,
				Customizer\SiteIdentity::class,
				Customizer\Colors::class,
				Customizer\General::class,
				Customizer\HeaderBranding::class,
				Customizer\HeroHeader::class,
				Customizer\MainNavigation::class,
				Customizer\HeaderBlockArea::class,
				Customizer\FooterWidgets::class,
				Customizer\Footer::class,
				Customizer\Upsell::class,
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
