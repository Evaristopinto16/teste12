<?php
/**
 * Template part for displaying the header search form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

if ( ! Oceanly\Helpers::show_header_search() ) {
	return;
}
?>

<div class="header-search-form-wrap c-wrap">

	<div class="header-search-form">
		<?php get_search_form( array( 'echo' => true ) ); ?>
	</div><!-- .header-search-form -->

</div><!-- .header-search-form-wrap -->
