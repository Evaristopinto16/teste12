<?php
/**
 * Template part for displaying the footer widgets.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

$oceanly_footer_widgets_active = Oceanly\Widget::footer_widgets_active();
if ( $oceanly_footer_widgets_active < 1 ) {
	return;
}
?>

<div class="footer-widgets <?php echo esc_attr( 'footer-widgets--sm-' . Oceanly\Helpers::footer_widgets_per_row_sm() . ' footer-widgets--md-' . Oceanly\Helpers::footer_widgets_per_row_md() . ' footer-widgets--lg-' . Oceanly\Helpers::footer_widgets_per_row_lg() ); ?>">
	<div class="footer-widgets-wrap c-wrap">
	<?php
	for ( $i = 1; $i <= Oceanly\Widget::FOOTER_WIDGETS; $i++ ) {
		if ( is_active_sidebar( 'footer-' . $i ) ) {
			?>
		<aside id="<?php echo esc_attr( 'footer-sidebar-' . $i ); ?>" class="widget-area c-footer-sidebar <?php echo esc_attr( 'c-footer-sidebar-' . $i ); ?>">
			<?php dynamic_sidebar( 'footer-' . $i ); ?>
		</aside><!-- .c-footer-sidebar -->
			<?php
		}
	}
	?>
	</div><!-- .c-wrap -->
</div><!-- .footer-widgets -->
<?php
