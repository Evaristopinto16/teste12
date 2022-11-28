<?php
/**
 * Template part for displaying the page header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

$oceanly_settings = get_post_meta( get_the_ID(), 'oceanly_settings', true );
if ( ! is_array( $oceanly_settings ) ) {
	$oceanly_settings = array();
}

$oceanly_hide_header_title = array_key_exists( 'hide_header_title', $oceanly_settings ) ? (bool) $oceanly_settings['hide_header_title'] : false;

if ( $oceanly_hide_header_title ) {
	return;
}
?>

<header class="entry-header">
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
</header><!-- .entry-header -->
