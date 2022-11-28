<?php
/**
 * Displays footer site info
 *
 * @subpackage Yoga Meditation
 * @since 1.0
 * @version 1.0
 */

?>
<div class="site-info py-4 text-center">
	<?php
		echo esc_html( get_theme_mod( 'yoga_studio_footer_text' ) );
		printf(
			/* translators: %s: Yoga WordPress Theme. */
            '<p class="mb-0"> %s</p>',
            esc_html__( 'Yoga WordPress Theme', 'yoga-meditation' )
        );
	?>
</div>