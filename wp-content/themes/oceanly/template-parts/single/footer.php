<?php
/**
 * Template part for displaying the single post footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

if ( ! has_tag() || ( 'post' !== get_post_type() ) ) {
	return;
}
?>

<footer class="entry-footer">
	<?php Oceanly\TemplateTags::post_tags(); ?>
</footer><!-- .entry-footer -->
