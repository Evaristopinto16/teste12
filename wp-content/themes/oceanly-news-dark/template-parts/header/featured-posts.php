<?php
/**
 * Template part for displaying the featured posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly_News_Dark
 */

$oceanly_posts = Oceanly_News_Dark_Featured_Posts::options_query();
if ( ! $oceanly_posts ) {
	return;
}

$oceanly_query = $oceanly_posts['query'];
if ( ! $oceanly_query->have_posts() ) {
	return;
}

$oceanly_cols = 'ol-cols';
if ( ! $oceanly_posts['options']['fill'] ) {
	$oceanly_cols .= ' ol-cols-shrink';
}
?>

<div class="featured-posts-wrap c-wrap">
	<div class="<?php echo esc_attr( $oceanly_cols ); ?>">
	<?php
	while ( $oceanly_query->have_posts() ) {
		$oceanly_query->the_post();
		?>
		<div class="ol-col">
			<div class="ol-card">
				<?php if ( has_post_thumbnail() ) { ?>
				<div class="ol-card-img">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'post-thumbnail' ); ?></a>
				</div>
				<?php } ?>
				<div class="ol-card-body">
				<?php
				if ( $oceanly_posts['options']['taxonomy'] ) {
					$oceanly_categories = get_the_category( get_the_ID() );
					if ( ! empty( $oceanly_categories ) ) {
						$oceanly_category = $oceanly_categories[0];
						?>
					<div class="ol-card-label"><a href="<?php echo esc_url( get_category_link( $oceanly_category->term_id ) ); ?>"><?php echo esc_html( $oceanly_category->name ); ?></a></div>
						<?php
					} else {
						$oceanly_tags = get_the_tags( get_the_ID() );
						if ( ! empty( $oceanly_tags ) ) {
							$oceanly_tag = $oceanly_tags[0];
							?>
					<div class="ol-card-label"><a href="<?php echo esc_url( get_tag_link( $oceanly_tag->term_id ) ); ?>"><?php echo esc_html( $oceanly_tag->name ); ?></a></div>
							<?php
						}
					}
				}
				if ( '' !== get_the_title() ) {
					?>
					<div class="ol-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					<?php
				}
				if ( $oceanly_posts['options']['date'] ) {
					?>
					<div class="ol-card-date"><?php echo esc_html( get_the_date() ); ?></div>
					<?php
				}
				?>
				</div>
			</div>
		</div>
		<?php
	}

	wp_reset_postdata();
	?>
	</div>
</div>
