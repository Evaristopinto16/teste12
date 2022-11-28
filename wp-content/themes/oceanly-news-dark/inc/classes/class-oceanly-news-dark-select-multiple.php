<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * The multiple select customize control extends the WP_Customize_Control class.
 *
 * @package Oceanly_News_Dark
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * Multiple select customize control class.
	 */
	class Oceanly_News_Dark_Select_Multiple extends WP_Customize_Control {
		/**
		 * The type of customize control being rendered.
		 *
		 * @var string
		 */
		public $type = 'oceanly-select-multiple';

		/**
		 * Custom classes to apply on select.
		 *
		 * @var string
		 */
		public $custom_class = '';

		/**
		 * Constructor.
		 *
		 * @param WP_Customize_Manager $manager Customize manager object.
		 * @param string               $id Control id.
		 * @param array                $args Control arguments.
		 */
		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
			if ( array_key_exists( 'custom_class', $args ) ) {
				$this->custom_class = esc_attr( $args['custom_class'] );
			}
		}

		/**
		 * Enqueue scripts and styles.
		 */
		public function enqueue() {
			wp_enqueue_script( 'customizer-select-multiple', get_theme_file_uri( 'assets/js/customizer-select-multiple.js' ), array( 'jquery', 'customize-base' ), OCEANLY_NEWS_DARK_VERSION, true );
		}

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @return array
		 */
		public function json() {
			$json                 = parent::json();
			$json['choices']      = $this->choices;
			$json['link']         = $this->get_link();
			$json['value']        = (array) $this->value();
			$json['id']           = $this->id;
			$json['custom_class'] = $this->custom_class;

			return $json;
		}


		/**
		 * JS template to handle the control's output.
		 */
		public function content_template() {
			?>
			<#
			if ( ! data.choices ) {
				return;
			} #>

			<label>
				<# if ( data.label ) { #>
					<span class="customize-control-title">{{ data.label }}</span>
				<# } #>

				<# if ( data.description ) { #>
					<span class="description customize-control-description">{{{ data.description }}}</span>
				<# } #>

				<#
				var custom_class = ''
				if ( data.custom_class ) {
					custom_class = 'class='+data.custom_class
				} #>
				<select size="8" multiple="multiple" {{{ data.link }}} {{ custom_class }}>
					<# _.each( data.choices, function( label, choice ) {
						var selected = data.value.includes( choice.toString() ) ? 'selected="selected"' : ''
						#>
						<option value="{{ choice }}" {{ selected }} >{{ label }}</option>
					<# } ) #>
				</select>
			</label>
			<?php
		}
	}
}
