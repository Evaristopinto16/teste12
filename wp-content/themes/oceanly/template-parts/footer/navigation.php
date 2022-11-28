<?php
/**
 * Template part for displaying the footer navigation section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

if ( ! has_nav_menu( 'footer' ) ) {
	return;
}
?>

<div class="site-footer-navigation">

	<div class="footer-navigation-wrap c-wrap">
		<nav id="footer-navigation" class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Links', 'oceanly' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'footer',
				'menu_id'        => 'footer-menu',
				'depth'          => 1,
			)
		);
		?>
		</nav><!-- #footer-navigation -->
	</div><!-- .footer-navigation-wrap -->

</div><!-- .site-footer-navigation -->
