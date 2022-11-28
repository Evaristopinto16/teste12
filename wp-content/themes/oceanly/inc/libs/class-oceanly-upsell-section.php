<?php
/**
 * Customize section upsell button class.
 *
 * @package Oceanly
 */

if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'Oceanly_Upsell_Section' ) ) {
	/**
	 * Create upsell section.
	 */
	class Oceanly_Upsell_Section extends WP_Customize_Section {
		/**
		 * The type of customize section being rendered.
		 *
		 * @var string
		 */
		public $type = 'oceanly-button';

		/**
		 * Custom button text to output.
		 *
		 * @var string
		 */
		public $button_text = '';

		/**
		 * Custom button URL to output.
		 *
		 * @var string
		 */
		public $button_url = '';

		/**
		 * Default priority of the section.
		 *
		 * @var    string
		 */
		public $priority = 999;

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @return array
		 */
		public function json() {
			$json       = parent::json();
			$theme      = wp_get_theme();
			$button_url = $this->button_url;

			if ( ! $this->button_url && $theme->get( 'ThemeURI' ) ) {
				// Fall back to the `Theme URI` defined in `style.css`.
				$button_url = $theme->get( 'ThemeURI' );

			} elseif ( ! $this->button_url && $theme->get( 'AuthorURI' ) ) {
				// Fall back to the `Author URI` defined in `style.css`.
				$button_url = $theme->get( 'AuthorURI' );
			}

			$json['button_text'] = $this->button_text ? esc_html( $this->button_text ) : $theme->get( 'Name' );
			$json['button_url']  = esc_url( $button_url );

			return $json;
		}

		/**
		 * Outputs the template.
		 *
		 * @return void
		 */
		protected function render_template() {
			?>
			<li id="accordion-section-{{ data.id }}" class="oceanly-upsell-accordion-section accordion-section control-section control-section-{{ data.type }} cannot-expand">
				<h3 class="accordion-section-title">
					{{ data.title }}
					<# if ( data.button_text && data.button_url ) { #>
						<a href="{{ data.button_url }}" class="button alignright" target="_blank">{{ data.button_text }}</a>
					<# } #>
				</h3>
			</li>
			<?php
		}
	}
}

/**
 * Load the JS and CSS.
 */
function oceanly_customizer_controls_scripts() {
	wp_enqueue_style( 'oceanly-customize-section-button', get_theme_file_uri( 'inc/customize-controls.css' ), array( 'customize-controls' ), OCEANLY_VERSION );

	wp_enqueue_script( 'oceanly-customize-section-button', get_theme_file_uri( 'js/customize-controls.js' ), array( 'customize-controls' ), OCEANLY_VERSION, true );
}
add_action( 'customize_controls_enqueue_scripts', 'oceanly_customizer_controls_scripts' );
