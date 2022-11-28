<?php
/**
 * Customize control upsell class.
 *
 * @package PressBook
 */

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'PressBook_Upsell_Control' ) ) {
	/**
	 * Create in-section upsell control.
	 * Escape URL in the Customizer using esc_url().
	 */
	class PressBook_Upsell_Control extends WP_Customize_Control {
		/**
		 * The type of customize control being rendered.
		 *
		 * @var string
		 */
		public $type = 'pressbook-addon';

		/**
		 * Custom button URL to output.
		 *
		 * @var string
		 */
		public $url = '';

		/**
		 * Description of control.
		 *
		 * @var string
		 */
		public $description = '';


		/**
		 * Label of control.
		 *
		 * @var string
		 */
		public $label = '';

		/**
		 * Load the CSS.
		 */
		public function enqueue() {
			wp_enqueue_style( 'pressbook-customize-section-button', get_theme_file_uri( 'inc/customize-controls.css' ), array(), PRESSBOOK_VERSION );
		}

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 */
		public function to_json() {
			parent::to_json();
			$this->json['url'] = esc_url( $this->url );
		}

		/**
		 * Outputs the template.
		 *
		 * @return void
		 */
		public function content_template() {
			?>
			<p class="description">{{{ data.description }}}</p>
			<span class="get-addon">
				<a href="{{{ data.url }}}" class="button button-primary" target="_blank">{{ data.label }}</a>
			</span>
			<?php
		}
	}
}
