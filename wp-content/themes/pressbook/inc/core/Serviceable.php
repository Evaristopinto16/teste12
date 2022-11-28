<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Service interface contract.
 *
 * @package PressBook
 */

namespace PressBook;

/**
 * Interface for service instance.
 */
interface Serviceable {
	/**
	 * Register a service.
	 */
	public function register();
}
