<?php
/**
 * Template part for displaying single post content in single.php.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'pb-article pb-singular' ); ?>>
	<?php PressBook\TemplateTags::post_thumbnail(); ?>

	<header class="entry-header">
	<?php
	the_title( '<h1 class="entry-title">', '</h1>' );

	if ( 'post' === get_post_type() ) {
		?>
		<div class="<?php echo esc_attr( PressBook\Options\Blog::entry_meta_class() ); ?>">
			<?php
			PressBook\TemplateTags::posted_on();
			PressBook\TemplateTags::posted_by();
			PressBook\TemplateTags::comments();
			?>
		</div><!-- .entry-meta -->
		<?php
	}
	?>
	</header><!-- .entry-header -->

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

	<?php
	PressBook\TemplateTags::post_categories();
	PressBook\TemplateTags::post_tags();
	PressBook\TemplateTags::edit_post_link();
	?>
</article><!-- #post-<?php the_ID(); ?> -->
