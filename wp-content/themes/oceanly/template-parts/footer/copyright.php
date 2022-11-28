<?php
/**
 * Template part for displaying the footer copyright text.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

$oceanly_copyright = Oceanly\Helpers::copyright();
?>

<div class="footer-copyright">

	<?php if ( '' !== $oceanly_copyright ) { ?>
	<p class="copyright-text">
		<?php echo wp_kses( $oceanly_copyright, Oceanly\Helpers::copyright_allowed_tags() ); ?>
	</p><!-- .copyright-text -->
	<?php } ?>

	<p class="oceanly-credit">
		<?php
		printf(
			/* translators: 1: theme name, 2: theme shop URL */
			esc_html__( 'Theme: %1$s by %2$s', 'oceanly' ),
			'Oceanly',
			'<a href="' . esc_url( Oceanly\Helpers::get_author_url() ) . '" itemprop="url">ScriptsTown</a>'
		);
		?>
	</p><!-- .oceanly-credit -->

</div><!-- .footer-copyright -->
