<?php
/**
 * Template part for displaying posts in a masonry grid.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook_Masonry_Dark
 */

?>

<div class="pb-grid-post-col">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'pb-article pb-grid-post' ); ?>>
		<?php PressBook\TemplateTags::post_thumbnail(); ?>

		<header class="entry-header pb-grid-post-header">
		<?php
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		PressBook_Masonry_Dark_Options::the_grid_post_exceprt();

		if ( 'post' === get_post_type() ) {
			$pressbook_categories = get_the_category( get_the_ID() );
			if ( ! empty( $pressbook_categories ) || ( is_home() && is_sticky() ) ) {
				?>
				<div class="pb-grid-post-meta">
				<?php
				if ( ! empty( $pressbook_categories ) ) {
					$pressbook_category = $pressbook_categories[0];
					?>
					<span class="cat-links"><?php PressBook\IconsHelper::the_theme_svg( 'category' ); ?><a href="<?php echo esc_url( get_category_link( $pressbook_category->term_id ) ); ?>" rel="category tag"><?php echo esc_html( $pressbook_category->name ); ?></a></span>
					<?php
				}

				if ( is_home() && is_sticky() ) {
					echo '<span class="pb-sticky">';
					PressBook\IconsHelper::the_theme_svg( 'bookmark' );
					echo ( '<span class="pb-sticky-label">' . esc_html( PressBook\Options\Blog::featured_label_text() ) . '</span>' );
					echo '</span>';
				}
				?>
				</div><!-- .pb-grid-post-meta -->
				<?php
			}
		}
		?>
		</header><!-- .entry-header -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .pb-grid-post-col -->
