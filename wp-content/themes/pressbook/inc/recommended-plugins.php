<?php
/**
 * TGM - Recommended plugins.
 *
 * @package PressBook
 */

if ( ! function_exists( 'pressbook_register_required_plugins' ) ) {
	/**
	 * Register the required plugins for this theme.
	 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
	 */
	function pressbook_register_required_plugins() {
		/*
		* Array of plugin arrays. Required keys are name and slug.
		* If the source is NOT from the .org repo, then source is also required.
		*/
		$plugins = array(
			array(
				'name'     => 'Contact Form Query',
				'slug'     => 'contact-form-query',
				'required' => false,
			),
			array(
				'name'     => 'Social Icons Sticky',
				'slug'     => 'share-social-media',
				'required' => false,
			),
		);

		// Don't recommend if pro version already active.
		if ( ! defined( 'DARKMODETG_PRO_PLUGIN_VER' ) ) {
			array_push(
				$plugins,
				array(
					'name'     => 'Dark Mode Toggle',
					'slug'     => 'dark-mode-toggle',
					'required' => false,
				)
			);
		}

		// Don't recommend if pro version already active.
		if ( ! class_exists( 'STLSP_Login_Security_Pro' ) ) {
			array_push(
				$plugins,
				array(
					'name'     => 'Login Security reCAPTCHA',
					'slug'     => 'login-security-recaptcha',
					'required' => false,
				)
			);
		}

		/*
		* Array of configuration settings. Amend each line as needed.
		*
		* TGMPA will start providing localized text strings soon. If you already have translations of our standard
		* strings available, please help us make TGMPA even better by giving us access to these translations or by
		* sending in a pull-request with .po file(s) with the translations.
		*
		* Only uncomment the strings in the config array if you want to customize the strings.
		*/
		$config = array(
			'id'           => 'pressbook',             // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}

add_action( 'tgmpa_register', 'pressbook_register_required_plugins' );
