<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

get_header();
?>

	<div class="content-sidebar-wrap c-wrap">
		<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) {
			?>
			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title archive-title">', '</h1>' );
				the_archive_description();
				?>
			</header><!-- .page-header -->
			<?php

			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			}

			the_posts_pagination();
		} else {
			get_template_part( 'template-parts/content', 'none' );
		}
		?>

		</main><!-- #primary -->

		<?php get_sidebar(); ?>
	</div><!-- .content-sidebar-wrap -->

<?php
get_footer();
