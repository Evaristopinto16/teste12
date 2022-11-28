<?php
/**
 * Template part for displaying the footer block.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook
 */

$pressbook_footer_block = PressBook\Options\FooterBlock::get_footer_block();

if ( empty( $pressbook_footer_block ) ) {
	return;
}

if ( ( is_front_page() && ! $pressbook_footer_block['in_front'] ) ||
	( is_home() && ! $pressbook_footer_block['in_blog'] ) ||
	( is_archive() && ! $pressbook_footer_block['in_archive'] ) ||
	( is_404() ) ||
	( is_search() && ! $pressbook_footer_block['in_archive'] ) ||
	( is_single() && ! $pressbook_footer_block['in_post'] ) ||
	( ( ! is_front_page() && is_page() ) && ! $pressbook_footer_block['in_page'] ) ) {
	return;
}

$pressbook_footer_block_query = new \WP_Query(
	array(
		'post_type'     => 'wp_block',
		'no_found_rows' => true,
		'post__in'      => ( empty( $pressbook_footer_block['id'] ) ? array( 0 ) : array( $pressbook_footer_block['id'] ) ),
	)
);

if ( $pressbook_footer_block_query->have_posts() ) {
	if ( $pressbook_footer_block['b_margin'] ) {
		$pressbook_footer_block_class = 'block-section footer-block footer-block-1 b-margin';
	} else {
		$pressbook_footer_block_class = 'block-section footer-block footer-block-1';
	}
	?>
	<div class="<?php echo esc_attr( $pressbook_footer_block_class ); ?>">
	<?php
	if ( ! $pressbook_footer_block['full_width'] ) {
		?>
		<div class="u-wrapper">
		<?php
	}

	while ( $pressbook_footer_block_query->have_posts() ) {
		$pressbook_footer_block_query->the_post();
		?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
		<?php
	}

	wp_reset_postdata();

	if ( ! $pressbook_footer_block['full_width'] ) {
		?>
		</div><!-- .u-wrapper -->
		<?php
	}
	?>
	</div><!-- .footer-block-1 -->
	<?php
}
