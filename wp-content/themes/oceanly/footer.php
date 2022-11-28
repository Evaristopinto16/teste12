<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Oceanly
 */

?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php
		do_action( 'oceanly_after_footer_start' );

		get_template_part( 'template-parts/footer/widgets' );
		get_template_part( 'template-parts/footer/navigation' );
		get_template_part( 'template-parts/footer/bottom-area' );

		do_action( 'oceanly_before_footer_end' );
		?>
	</footer>

	<?php get_template_part( 'template-parts/footer/back-to-top' ); ?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
