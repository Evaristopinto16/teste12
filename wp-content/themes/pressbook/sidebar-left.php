<?php
/**
 * The sidebar containing the left widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PressBook
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}

do_action( 'pressbook_before_left_sidebar' );
?>

<aside id="secondary-left" class="widget-area c-sidebar c-sidebar-left">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside><!-- #secondary-left -->

<?php
do_action( 'pressbook_after_left_sidebar' );
