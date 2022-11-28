<?php
/**
 * The sidebar containing the shop widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PressBook
 */

if ( ! is_active_sidebar( 'sidebar-shop' ) ) {
	return;
}

do_action( 'pressbook_before_shop_sidebar' );
?>

<aside id="secondary" class="widget-area c-sidebar c-sidebar-shop">
	<?php dynamic_sidebar( 'sidebar-shop' ); ?>
</aside><!-- #secondary -->

<?php
do_action( 'pressbook_after_shop_sidebar' );
