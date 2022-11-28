<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Jetpack compatibility.
 *
 * @package PressBook_Masonry_Dark
 */

/**
 * Setup Jetpack for the theme.
 */
class PressBook_Masonry_Dark_Jetpack extends PressBook\Jetpack {
	/**
	 * Custom render function for Infinite Scroll.
	 */
	public function infinite_scroll_render() {
		?>
		<div class="<?php echo esc_attr( PressBook_Masonry_Dark_Options::grid_post_row_class() ); ?>">
		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content-masonry' );
		}
		?>
		</div>
		<?php
	}
}
