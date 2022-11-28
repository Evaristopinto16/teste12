<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Template tags.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Theme template tags.
 */
class TemplateTags {
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	public static function post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) {
			?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->
			<?php
		} else {
			?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail(
				'post-thumbnail',
				array(
					'alt' => the_title_attribute(
						array(
							'echo' => false,
						)
					),
				)
			);
			?>
			</a><!-- .post-thumbnail -->
			<?php
		}
	}

	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	public static function posted_on() {
		?>
		<span class="posted-on">
			<?php IconsHelper::the_theme_svg( 'calendar' ); ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php
				printf(
					wp_kses(
						/* translators: %s: post date. */
						_x( '<span class="screen-reader-text">Posted on </span>%s', 'post date', 'oceanly' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					sprintf(
						( ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) ? '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>' : '<time class="entry-date published updated" datetime="%1$s">%2$s</time>' ),
						esc_attr( get_the_date( DATE_W3C ) ),
						esc_html( get_the_date() ),
						esc_attr( get_the_modified_date( DATE_W3C ) ),
						esc_html( get_the_modified_date() )
					)
				)
				?>
			</a>
		</span>
		<?php
	}

	/**
	 * Prints HTML with meta information for the current author.
	 */
	public static function posted_by() {
		?>
		<span class="posted-by byline">
			<?php IconsHelper::the_theme_svg( 'user' ); ?>
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
				<?php
				printf(
					wp_kses(
						/* translators: %s: post author */
						_x( '<span class="screen-reader-text">By </span>%s', 'post author', 'oceanly' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					esc_html( get_the_author() )
				)
				?>
			</a>
		</span>
		<?php
	}

	/**
	 * Prints HTML with meta information for comments.
	 */
	public static function comments() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			?>
			<span class="comments-link">
				<?php
				IconsHelper::the_theme_svg( 'comment' );
				comments_popup_link();
				?>
			</span>
			<?php
		}
	}

	/**
	 * Prints HTML for the edit post link.
	 */
	public static function edit_post_link() {
		edit_post_link( null, '<span class="post-edit-link-container">', '</span>' );
	}

	/**
	 * Prints HTML with meta information for the categories.
	 */
	public static function post_categories() {
		if ( 'post' === get_post_type() && has_category() ) {
			?>
			<span class="cat-links">
				<?php
				IconsHelper::the_theme_svg( 'tags' );
				the_category( ', ' );
				?>
			</span>
			<?php
		}
	}

	/**
	 * Prints HTML with meta information for the tags.
	 */
	public static function post_tags() {
		if ( 'post' === get_post_type() && has_tag() ) {
			?>
			<span class="tag-links"><?php the_tags( null, ' ' ); ?></span>
			<?php
		}
	}

	/**
	 * Output the breadcrumbs HTML.
	 */
	public static function breadcrumbs() {
		Helpers::breadcrumb_trail(
			array(
				'show_browse' => false,
			)
		);
	}
}
