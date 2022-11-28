<?php
/**
 * Template part for displaying posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook
 */

$pressbook_has_content = ( ( '' !== get_the_excerpt() ) || has_post_thumbnail() || ( '' !== get_the_content() ) );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'pb-article pb-archive' . ( $pressbook_has_content ? '' : ' pb-no-content' ) ); ?>>
	<header class="entry-header">
	<?php
	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	if ( 'post' === get_post_type() ) {
		?>
		<div class="<?php echo esc_attr( PressBook\Options\Blog::entry_meta_class() ); ?>">
			<?php
			PressBook\TemplateTags::posted_on();
			PressBook\TemplateTags::posted_by();
			PressBook\TemplateTags::comments();

			if ( is_home() && is_sticky() ) {
				echo '<span class="pb-sticky">';
				PressBook\IconsHelper::the_theme_svg( 'bookmark' );
				echo ( '<span class="pb-sticky-label">' . esc_html( PressBook\Options\Blog::featured_label_text() ) . '</span>' );
				echo '</span>';
			}
			?>
		</div><!-- .entry-meta -->
		<?php
	}
	?>
	</header><!-- .entry-header -->

	<?php
	if ( $pressbook_has_content ) {
		?>
	<div class="pb-content">
		<?php
		PressBook\TemplateTags::post_thumbnail();

		if ( ( '' !== get_the_excerpt() ) && PressBook\Helpers::show_excerpt() ) {
			?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
			<?php
		} else {
			?>
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
			<?php
		}
		?>
	</div><!-- .pb-content -->
		<?php
	}

	PressBook\TemplateTags::post_categories();
	?>
</article><!-- #post-<?php the_ID(); ?> -->
