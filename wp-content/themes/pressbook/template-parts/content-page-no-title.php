<?php
/**
 * Template part for displaying page content without title in page.php.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'pb-article pb-singular' ); ?>>
	<?php PressBook\TemplateTags::post_thumbnail(); ?>

	<div class="pb-content">
		<div class="entry-content">
			<?php
			the_content();
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pressbook' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	</div><!-- .pb-content -->

	<?php PressBook\TemplateTags::edit_post_link(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
