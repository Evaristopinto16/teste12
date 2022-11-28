<?php
/**
 * Template part for displaying the header block area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

$oceanly_header_block_area = Oceanly\Helpers::header_block_area();

if ( empty( $oceanly_header_block_area ) ) {
	return;
}

if ( ( is_front_page() && ! $oceanly_header_block_area['in_front'] ) ||
	( is_home() && ! $oceanly_header_block_area['in_blog'] ) ||
	( is_archive() && ! $oceanly_header_block_area['in_archive'] ) ||
	( is_404() ) ||
	( is_search() && ! $oceanly_header_block_area['in_archive'] ) ||
	( is_single() && ! $oceanly_header_block_area['in_post'] ) ||
	( ( ! is_front_page() && is_page() ) && ! $oceanly_header_block_area['in_page'] ) ) {
	return;
}

$oceanly_header_blocks_query = new \WP_Query(
	array(
		'post_type'     => 'wp_block',
		'no_found_rows' => true,
		'post__in'      => ( empty( $oceanly_header_block_area['id'] ) ? array( 0 ) : array( $oceanly_header_block_area['id'] ) ),
	)
);

if ( $oceanly_header_blocks_query->have_posts() ) {
	if ( $oceanly_header_block_area['b_margin'] ) {
		$oceanly_header_block_area_class = 'header-block-area header-block-area-1';
	} else {
		$oceanly_header_block_area_class = 'header-block-area header-block-area-1 u-b-margin-0';
	}
	?>
	<div class="<?php echo esc_attr( $oceanly_header_block_area_class ); ?>">
	<?php
	if ( ! $oceanly_header_block_area['full_width'] ) {
		?>
		<div class="c-wrap">
		<?php
	}

	while ( $oceanly_header_blocks_query->have_posts() ) {
		$oceanly_header_blocks_query->the_post();
		?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
		<?php
	}

	wp_reset_postdata();

	if ( ! $oceanly_header_block_area['full_width'] ) {
		?>
		</div>
		<?php
	}
	?>
	</div><!-- .header-block-area-1 -->
	<?php
}
