<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Service interface contract.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Interface for service instance.
 */
interface Serviceable {
	/**
	 * Register a service.
	 */
	public function register();
}
