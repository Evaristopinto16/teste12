<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) {
		?>

		<h2 class="comments-title">
			<?php
			$pressbook_comment_count = get_comments_number();
			printf(
				wp_kses(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'Comment <span class="comments-title-count">(%1$s)</span><span class="screen-reader-text"> on &ldquo;%2$s&rdquo;</span>',
						'Comments <span class="comments-title-count">(%1$s)</span><span class="screen-reader-text"> on &ldquo;%2$s&rdquo;</span>',
						$pressbook_comment_count,
						'comments title',
						'pressbook'
					),
					array( 'span' => array( 'class' => array() ) )
				),
				esc_html( number_format_i18n( $pressbook_comment_count ) ),
				wp_kses_post( get_the_title() )
			);
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 32,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) {
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'pressbook' ); ?></p>
			<?php
		}
	} // Check for have_comments().

	comment_form();
	?>

</div><!-- #comments -->
