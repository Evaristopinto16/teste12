<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Oceanly
 */

get_header();
?>

	<div class="content-sidebar-wrap c-wrap">
		<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', 'single' );
			}

			if ( 'post' === get_post_type() ) {
				the_post_navigation(
					array(
						'prev_text' => '<span class="post-navigation-arrow" aria-hidden="true">&#10094;</span> ' .
						'<span class="post-navigation-title"><span class="screen-reader-text">' .
						esc_html__( 'Previous Post:', 'oceanly' ) . '</span> %title</span>',
						'next_text' => '<span class="post-navigation-title"><span class="screen-reader-text">' .
						esc_html__( 'Next Post:', 'oceanly' ) . '</span> %title</span>' .
							' <span class="post-navigation-arrow" aria-hidden="true">&#10095;</span>',
					)
				);
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		}
		?>

		</main><!-- #primary -->

		<?php get_sidebar(); ?>
	</div><!-- .content-sidebar-wrap -->

<?php
get_footer();
