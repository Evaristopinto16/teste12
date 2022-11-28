<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PressBook
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pressbook' ); ?></a>

	<header id="masthead" class="site-header">
		<?php
		do_action( 'pressbook_after_header_start' );

		get_template_part( 'template-parts/header/top-navbar' );

		get_template_part( 'template-parts/header/site-branding' );

		get_template_part( 'template-parts/header/primary-navbar' );

		get_template_part( 'template-parts/header/block-section' );

		do_action( 'pressbook_before_header_end' );
		?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
