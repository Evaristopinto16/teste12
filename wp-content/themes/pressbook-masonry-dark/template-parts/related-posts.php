<?php
/**
 * The template for displaying related posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook_Masonry_Dark
 */

$pressbook_posts = PressBook_Masonry_Dark_Related_Posts::options_query();
if ( ! $pressbook_posts ) {
	return;
}

$pressbook_query = $pressbook_posts['query'];
if ( ! $pressbook_query->have_posts() ) {
	return;
}
?>

<div class="pb-related-posts">
	<h2 class="pb-related-posts-title"><?php echo esc_html( $pressbook_posts['options']['title'] ); ?></h2>

	<div class="related-posts">
		<div class="pb-row">
		<?php
		while ( $pressbook_query->have_posts() ) {
			$pressbook_query->the_post();
			$pressbook_categories = get_the_category( get_the_ID() );
			?>
			<div class="pb-col-xs-6 pb-col-md-4">
				<div class="pb-related-post">
					<a href="<?php the_permalink(); ?>" class="pb-related-link">
					<?php
					if ( has_post_thumbnail() ) {
						?>
						<?php
						the_post_thumbnail(
							'post-thumbnail',
							array( 'class' => 'pb-related-post-image' )
						);
						?>
						<?php
					}

					if ( '' !== get_the_title() ) {
						?>
						<span class="pb-related-post-title"><?php the_title(); ?></span>
						<?php
					}

					if ( $pressbook_posts['options']['taxonomy'] ) {
						if ( ! empty( $pressbook_categories ) ) {
							$pressbook_category = $pressbook_categories[0];
							?>
							<span class="pb-related-post-taxonomy"><?php echo esc_html( $pressbook_category->name ); ?></span>
							<?php
						} else {
							$pressbook_tags = get_the_tags( get_the_ID() );
							if ( ! empty( $pressbook_tags ) ) {
								$pressbook_tag = $pressbook_tags[0];
								?>
							<span class="pb-related-post-taxonomy"><?php echo esc_html( $pressbook_tag->name ); ?></span>
								<?php
							}
						}
					}
					?>
					</a>
				</div>
			</div>
			<?php
		}

		wp_reset_postdata();
		?>
		</div>
	</div>
</div>
