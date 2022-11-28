<?php
/**
 * Template part for displaying the header navigation section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

if ( ! has_nav_menu( 'menu-1' ) ) {
	return;
}
?>

<div class="site-navigation-wrap c-wrap">

	<nav id="site-navigation" class="<?php echo esc_attr( 'main-navigation main-navigation--sm-' . Oceanly\Helpers::menu_alignment_sm() . ' main-navigation--md-' . Oceanly\Helpers::menu_alignment_md() . ' submenu--md-open-' . Oceanly\Helpers::submenu_direction_md() . ' submenu--lg-open-' . Oceanly\Helpers::submenu_direction_lg() ); ?>" aria-label="<?php esc_attr_e( 'Primary Menu', 'oceanly' ); ?>">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<?php
			Oceanly\IconsHelper::the_theme_svg( 'menu' );
			Oceanly\IconsHelper::the_theme_svg( 'close' );
			?>
		</button>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			)
		);
		?>
	</nav><!-- #site-navigation -->

</div><!-- .site-navigation-wrap -->
