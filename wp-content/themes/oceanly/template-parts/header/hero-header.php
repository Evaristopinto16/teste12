<?php
/**
 * Template part for displaying the hero header section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

$oceanly_hero_header_enable = Oceanly\Helpers::hero_header_enable();

if ( ! has_nav_menu( 'menu-1' ) && ! $oceanly_hero_header_enable ) {
	return;
}

$oceanly_hero_header_bg_fixed_class = ( Oceanly\Helpers::hero_header_bg_fixed() ? ' site-hero-header-image--fixed' : '' );

if ( $oceanly_hero_header_enable ) {
	?>
<div class="site-hero-header site-hero-header--sm-h-200 site-hero-header--md-h-250 site-hero-header--lg-h-300 site-hero-header--xl-h-350 site-hero-header--breadcrumbs-right">
	<?php
} else {
	?>
<div class="site-hero-header site-hero-header--disabled">
	<?php
}
	do_action( 'oceanly_after_hero_header_start' );

if ( get_header_image() ) {
	?>
	<div class="<?php echo esc_attr( 'site-hero-header-image site-hero-header-image--' . Oceanly\Helpers::hero_header_bg_position() . ' site-hero-header-image--size-' . Oceanly\Helpers::hero_header_bg_size() . $oceanly_hero_header_bg_fixed_class ); ?>" style="background-image: url(<?php header_image(); ?>);"></div>
	<?php
}

	get_template_part( 'template-parts/header/navigation' );

if ( $oceanly_hero_header_enable ) {
	get_template_part( 'template-parts/header/search-form' );
	get_template_part( 'template-parts/header/breadcrumbs' );
}

	do_action( 'oceanly_before_hero_header_end' );
?>
</div><!-- .site-hero-header -->
