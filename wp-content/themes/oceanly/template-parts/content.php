<?php
/**
 * Template part for displaying posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-content-wrap' ); ?>>
	<div class="header-thumbnail-wrap">
		<?php
		get_template_part( 'template-parts/archive/header' );
		Oceanly\TemplateTags::post_thumbnail();

		if ( is_home() && is_sticky() ) {
			Oceanly\IconsHelper::the_theme_svg( 'pin' );
		}
		?>
	</div>

	<div class="content-wrap">
		<?php
		Oceanly\TemplateTags::post_categories();
		get_template_part( 'template-parts/archive/content' );
		Oceanly\TemplateTags::edit_post_link();
		?>
	</div><!-- .content-wrap -->
</article><!-- #post-<?php the_ID(); ?> -->
