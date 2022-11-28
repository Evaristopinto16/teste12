<?php
/**
 * Template part for displaying the archive post entry summary or content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

?>

<?php if ( Oceanly\Helpers::show_excerpt() ) { ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
<?php } else { ?>
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
<?php } ?>
