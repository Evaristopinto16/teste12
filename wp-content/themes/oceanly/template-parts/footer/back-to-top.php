<?php
/**
 * Template part for displaying the back to top button.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

if ( ! Oceanly\Helpers::hide_back_to_top() ) {
	?>
	<a href="#" class="back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'oceanly' ); ?>"></a>
	<?php
}
