<?php
/**
 * The sidebar containing the shop widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Oceanly
 */

if ( ! is_active_sidebar( 'sidebar-shop' ) ) {
	return;
}

do_action( 'oceanly_before_shop_sidebar' );
?>

<aside id="secondary" class="widget-area c-sidebar c-sidebar-shop" aria-label="<?php esc_attr_e( 'Shop Sidebar', 'oceanly' ); ?>">
	<?php dynamic_sidebar( 'sidebar-shop' ); ?>
</aside><!-- #secondary -->

<?php
do_action( 'oceanly_after_shop_sidebar' );
