<?php
/**
 * Template part for displaying the top navbar section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook
 */

if ( has_nav_menu( 'social' ) || has_nav_menu( 'menu-2' ) ) {
	?>
	<div class="top-navbar">
		<div class="u-wrapper top-navbar-wrap">
			<div class="<?php echo esc_attr( PressBook\Menu::top_menus_class() ); ?>">
			<?php
			if ( has_nav_menu( 'social' ) ) {
				?>
				<nav id="social-navigation" class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links', 'pressbook' ); ?>">
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
				</nav><!-- #social-navigation -->
				<?php
			}

			if ( has_nav_menu( 'menu-2' ) ) {
				?>
				<nav id="top-navigation" class="top-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'pressbook' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'top-menu',
						'depth'          => 1,
					)
				);
				?>
				</nav><!-- #top-navigation -->
				<?php
			}
			?>
			</div><!-- .top-menus -->
		</div><!-- .top-navbar-wrap -->
	</div><!-- .top-navbar -->
	<?php
}
