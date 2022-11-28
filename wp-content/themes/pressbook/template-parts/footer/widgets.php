<?php
/**
 * Template part for displaying the footer widgets section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook
 */

$pressbook_active_footer_widgets = PressBook\Widget::get_active_footer_widgets();

if ( $pressbook_active_footer_widgets > 0 ) {
	?>
	<div class="footer-widgets footer-widgets-<?php echo esc_attr( $pressbook_active_footer_widgets ); ?>">
		<div class="u-wrapper footer-widgets-wrap">
		<?php
		for ( $i = 1; $i <= PressBook\Widget::FOOTER_WIDGETS_COUNT; $i++ ) {
			if ( is_active_sidebar( 'footer-' . $i ) ) {
				?>
			<aside id="<?php echo esc_attr( 'sidebar-footer-' . $i ); ?>" class="widget-area c-sidebar-footer <?php echo esc_attr( 'c-sidebar-footer-' . $i ); ?>">
				<?php dynamic_sidebar( 'footer-' . $i ); ?>
			</aside><!-- .c-sidebar-footer -->
				<?php
			}
		}
		?>
		</div><!-- .footer-widgets-wrap -->
	</div><!-- .footer-widgets -->
	<?php
}
