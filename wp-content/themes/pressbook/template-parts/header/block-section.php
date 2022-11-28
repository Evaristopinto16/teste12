<?php
/**
 * Template part for displaying the header block.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook
 */

$pressbook_header_block = PressBook\Options\HeaderBlock::get_header_block();

if ( empty( $pressbook_header_block ) ) {
	return;
}

if ( ( is_front_page() && ! $pressbook_header_block['in_front'] ) ||
	( is_home() && ! $pressbook_header_block['in_blog'] ) ||
	( is_archive() && ! $pressbook_header_block['in_archive'] ) ||
	( is_404() ) ||
	( is_search() && ! $pressbook_header_block['in_archive'] ) ||
	( is_single() && ! $pressbook_header_block['in_post'] ) ||
	( ( ! is_front_page() && is_page() ) && ! $pressbook_header_block['in_page'] ) ) {
	return;
}

$pressbook_header_block_query = new \WP_Query(
	array(
		'post_type'     => 'wp_block',
		'no_found_rows' => true,
		'post__in'      => ( empty( $pressbook_header_block['id'] ) ? array( 0 ) : array( $pressbook_header_block['id'] ) ),
	)
);

if ( $pressbook_header_block_query->have_posts() ) {
	if ( $pressbook_header_block['t_margin'] ) {
		$pressbook_header_block_class = 'block-section header-block header-block-1 t-margin';
	} else {
		$pressbook_header_block_class = 'block-section header-block header-block-1';
	}
	?>
	<div class="<?php echo esc_attr( $pressbook_header_block_class ); ?>">
	<?php
	if ( ! $pressbook_header_block['full_width'] ) {
		?>
		<div class="u-wrapper">
		<?php
	}

	while ( $pressbook_header_block_query->have_posts() ) {
		$pressbook_header_block_query->the_post();
		?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
		<?php
	}

	wp_reset_postdata();

	if ( ! $pressbook_header_block['full_width'] ) {
		?>
		</div><!-- .u-wrapper -->
		<?php
	}
	?>
	</div><!-- .header-block-1 -->
	<?php
}
