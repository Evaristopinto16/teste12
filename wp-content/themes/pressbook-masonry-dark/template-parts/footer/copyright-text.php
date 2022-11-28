<?php
/**
 * Template part for displaying the footer copyright text.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook_Masonry_Dark
 */

$pressbook_copyright_text = PressBook\Options\Footer::get_copyright_text();
?>

<div class="copyright-text">
	<div class="u-wrapper copyright-text-wrap">
	<?php
	if ( '' !== $pressbook_copyright_text ) {
		?>
		<p><?php echo wp_kses( $pressbook_copyright_text, PressBook\Options\Footer::copyright_text_allowed_tags() ); ?></p>
		<?php
	}
	?>
		<p class="pressbook-credit">
		<?php
		printf(
			/* translators: %s: theme name with URL */
			esc_html_x( 'Powered by %s', 'footer credit', 'pressbook-masonry-dark' ),
			'<a href="' . esc_url( PressBook\Helpers::get_theme_url() ) . '" itemprop="url">' . esc_html( PressBook\Helpers::get_theme_name() ) . '</a>'
		);
		?>
		</p><!-- .pressbook-credit -->
	</div><!-- .copyright-text-wrap -->
</div><!-- .copyright-text -->
