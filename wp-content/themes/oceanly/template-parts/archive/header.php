<?php
/**
 * Template part for displaying the archive post header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

?>

<header class="entry-header">
	<?php
	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	if ( 'post' === get_post_type() ) {
		?>
		<div class="entry-meta">
			<?php
			Oceanly\TemplateTags::posted_on();
			Oceanly\TemplateTags::posted_by();
			Oceanly\TemplateTags::comments();
			?>
		</div><!-- .entry-meta -->
		<?php
	}
	?>
</header><!-- .entry-header -->
