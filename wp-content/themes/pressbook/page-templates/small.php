<?php
/**
 * Template Name: Small width template
 *
 * @package PressBook
 */

$pressbook_settings = PressBook\PageSettings::get_meta_config( get_the_ID() );

get_header();
?>

	<div class="pb-content-sidebar u-wrapper<?php echo esc_attr( $pressbook_settings['wrapper_class'] ); ?>">
		<main id="primary" class="site-main<?php echo esc_attr( $pressbook_settings['site_main_class'] ); ?>">

		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', $pressbook_settings['page_content'] );
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		}
		?>

		</main><!-- #primary -->
	</div><!-- .pb-content-sidebar -->

<?php
get_footer();
