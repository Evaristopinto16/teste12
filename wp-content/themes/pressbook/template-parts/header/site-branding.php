<?php
/**
 * Template part for displaying the site branding section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook
 */

if ( get_header_image() ) {
	?>
<div class="site-branding" style="background-image: url(<?php header_image(); ?>);">
	<?php
} else {
	?>
<div class="site-branding">
	<?php
}
?>
	<div class="u-wrapper site-branding-wrap">
		<div class="<?php echo esc_attr( PressBook\Options\SiteIdentity::logo_title_class() ); ?>">
			<?php the_custom_logo(); ?>

			<div class="site-title-tagline">
			<?php
			if ( is_front_page() && is_home() ) {
				?>
				<h1 class="<?php echo esc_attr( PressBook\Options\SiteIdentity::title_class() ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			} else {
				?>
				<p class="<?php echo esc_attr( PressBook\Options\SiteIdentity::title_class() ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			}
			?>
				<p class="<?php echo esc_attr( PressBook\Options\SiteIdentity::tagline_class() ); ?>"><?php bloginfo( 'description' ); ?></p>
			</div><!-- .site-title-tagline -->
		</div><!-- .site-logo-title -->

		<?php get_template_part( 'template-parts/header/top-banner' ); ?>
	</div><!-- .site-branding-wrap -->
</div><!-- .site-branding -->
