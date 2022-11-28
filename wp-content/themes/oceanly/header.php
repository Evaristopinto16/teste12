<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Oceanly
 */

$oceanly_site_header_class = ( Oceanly\Helpers::site_header_b_margin() ? 'site-header u-b-margin' : 'site-header' );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); /* Fallback defined in inc/helpers.php */ ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'oceanly' ); ?></a>

	<header id="masthead" class="<?php echo esc_attr( $oceanly_site_header_class ); ?>">
		<?php
		do_action( 'oceanly_after_header_start' );

		get_template_part( 'template-parts/header/branding' );
		get_template_part( 'template-parts/header/hero-header' );
		get_template_part( 'template-parts/header/block-area' );

		do_action( 'oceanly_before_header_end' );
		?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
