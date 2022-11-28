<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Oceanly
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

do_action( 'oceanly_before_main_sidebar' );
?>

<aside id="secondary" class="widget-area c-sidebar" aria-label="<?php esc_attr_e( 'Sidebar', 'oceanly' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->

<?php
do_action( 'oceanly_after_main_sidebar' );
