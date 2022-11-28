<?php
/**
 * Template part for displaying the page entry content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

?>

<div class="entry-content">
	<?php
	the_content();
	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'oceanly' ),
			'after'  => '</div>',
		)
	);
	?>
</div><!-- .entry-content -->
