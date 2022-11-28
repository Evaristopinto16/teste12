<?php
/**
 * Template part for displaying the header breadcrumbs section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

if ( ! is_front_page() && Oceanly\Helpers::show_header_breadcrumbs() ) {
	if ( class_exists( 'WooCommerce' ) && function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		// Remove breadcrumb from content.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

		// Make WooCommerce breadcrumb with the theme.
		woocommerce_breadcrumb(
			array(
				'wrap_before' => '<nav class="breadcrumb-trail breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumbs', 'oceanly' ) . '" itemprop="breadcrumb"><ul class="trail-items">',
				'wrap_after'  => '</ul></nav>',
				'before'      => '<li class="trail-item">',
				'after'       => '</li>',
				'delimiter'   => '',
			)
		);
	} else { // Theme breadcrumb.
		/**
		 * Hook - oceanly_action_breadcrumbs
		 *
		 * @hooked TemplateTags::breadcrumbs - 10
		 */
		do_action( 'oceanly_action_breadcrumbs' );
	}
}
