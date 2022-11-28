<?php
/**
 * The sidebar containing the right widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PressBook
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

do_action( 'pressbook_before_right_sidebar' );
?>

<aside id="secondary" class="widget-area c-sidebar c-sidebar-right">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->

<?php
do_action( 'pressbook_after_right_sidebar' );
