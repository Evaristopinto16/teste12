<?php
/**
 * Template part for displaying single post content in single.php.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'singular-content-wrap single-content-wrap' ); ?>>
	<?php Oceanly\TemplateTags::post_thumbnail(); ?>

	<div class="content-wrap">
		<?php
		get_template_part( 'template-parts/single/header' );

		Oceanly\TemplateTags::post_categories();
		get_template_part( 'template-parts/single/content' );
		Oceanly\TemplateTags::edit_post_link();
		?>
	</div><!-- .content-wrap -->

	<?php get_template_part( 'template-parts/single/footer' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
