<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PressBook
 */

?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php
		do_action( 'pressbook_after_footer_start' );

		get_template_part( 'template-parts/footer/block-section' );

		get_template_part( 'template-parts/footer/widgets' );

		get_template_part( 'template-parts/footer/copyright-text' );

		do_action( 'pressbook_before_footer_end' );
		?>
	</footer><!-- #colophon -->

	<?php if ( ! PressBook\Options\Footer::get_hide_go_to_top() ) { ?>
	<a href="#" class="go-to-top" aria-label="<?php esc_attr_e( 'Go to top', 'pressbook' ); ?>"></a>
	<?php } ?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
