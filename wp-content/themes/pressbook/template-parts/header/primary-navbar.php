<?php
/**
 * Template part for displaying the primary navbar section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook
 */

if ( has_nav_menu( 'menu-1' ) ) {
	?>
	<div class="primary-navbar">
		<div class="u-wrapper primary-navbar-wrap">
			<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'pressbook' ); ?>">
				<button class="primary-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<?php
					PressBook\IconsHelper::the_theme_svg( 'menu' );
					PressBook\IconsHelper::the_theme_svg( 'close' );
					?>
				</button>
				<?php PressBook\Menu::primary_menu(); ?>
			</nav><!-- #site-navigation -->
		</div><!-- .primary-navbar-wrap -->
	</div><!-- .primary-navbar -->
	<?php
}
