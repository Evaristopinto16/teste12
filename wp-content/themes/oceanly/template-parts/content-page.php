<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'singular-content-wrap page-content-wrap' ); ?>>
	<?php Oceanly\TemplateTags::post_thumbnail(); ?>

	<div class="content-wrap">
		<?php
		get_template_part( 'template-parts/page/header' );

		get_template_part( 'template-parts/page/content' );
		Oceanly\TemplateTags::edit_post_link();
		?>
	</div><!-- .content-wrap -->
</article><!-- #post-<?php the_ID(); ?> -->
