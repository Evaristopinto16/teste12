<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Alpha color picker customizer control.
 *
 * This control adds a second slider for opacity to the stock WordPress color picker,
 * and it includes logic to seamlessly convert between RGBa and Hex color values as
 * opacity is added to or removed from a color.
 *
 * This Alpha Color Picker is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this Alpha Color Picker. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use \WP_Customize_Control;

if ( class_exists( '\WP_Customize_Control' ) ) {
	/**
	 * Alpha color picker control class.
	 */
	class AlphaColorControl extends WP_Customize_Control {
		/**
		 * Control name.
		 *
		 * @var string
		 */
		public $type = 'alpha-color';

		/**
		 * Add support for palettes to be passed in.
		 *
		 * Supported palette values are true, false, or an array of RGBa and Hex colors.
		 *
		 * @var bool
		 */
		public $palette;

		/**
		 * Add support for showing the opacity value on the slider handle.
		 *
		 * @var array
		 */
		public $show_opacity;

		/**
		 * Enqueue scripts and styles.
		 */
		public function enqueue() {
			wp_enqueue_style( 'alpha-color-picker', get_theme_file_uri( 'inc/alpha-color-picker.css' ), array( 'wp-color-picker' ), PRESSBOOK_VERSION );

			wp_enqueue_script( 'alpha-color-picker', get_theme_file_uri( 'js/alpha-color-picker.js' ), array( 'jquery', 'wp-color-picker' ), PRESSBOOK_VERSION, true );
		}

		/**
		 * Render the control.
		 */
		public function render_content() {
			// Process the palette.
			if ( is_array( $this->palette ) ) {
				$palette = implode( '|', $this->palette );
			} else {
				// Default to true.
				$palette = ( ( false === $this->palette ) || ( 'false' === $this->palette ) ) ? 'false' : 'true';
			}

			// Support passing show_opacity as string or boolean. Default to true.
			$show_opacity = ( ( false === $this->show_opacity ) || ( 'false' === $this->show_opacity ) ) ? 'false' : 'true';

			// Output the label and description if they were passed in.
			if ( isset( $this->label ) && ( '' !== $this->label ) ) {
				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
			}
			if ( isset( $this->description ) && ( '' !== $this->description ) ) {
				echo '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
			}
			?>

			<label>
				<input class="alpha-color-control" type="text" data-show-opacity="<?php echo esc_attr( $show_opacity ); ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?>>
			</label>
			<?php
		}
	}
}
