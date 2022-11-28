<?php
/**
 * Template part for displaying the social menu.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

if ( ! has_nav_menu( 'social' ) ) {
	return;
}
?>

<nav id="social-navigation" class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links', 'oceanly' ); ?>">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'social',
			'menu_id'        => 'social-menu',
			'depth'          => 1,
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>',
		)
	);
	?>
</nav>
