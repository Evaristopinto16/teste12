<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Block patterns service.
 *
 * @package PressBook_Masonry_Dark
 */

/**
 * Register block patterns.
 */
class PressBook_Masonry_Dark_Block_Patterns implements PressBook\Serviceable {
	/**
	 * Register service features.
	 */
	public function register() {
		/**
		 * Register block pattern category.
		 */
		if ( function_exists( 'register_block_pattern_category' ) ) {
			register_block_pattern_category(
				'pressbook-masonry-dark',
				array( 'label' => esc_html__( 'PressBook', 'pressbook-masonry-dark' ) )
			);
		}

		/**
		 * Register block patterns.
		 */
		if ( function_exists( 'register_block_pattern' ) ) {
			$this->block_pattern_three_column_content();
			$this->block_pattern_three_column_content_buttons();
			$this->block_pattern_two_column_media_list_button_bg_dark();
			$this->block_pattern_two_column_media_text_button_bg_dark();
			$this->block_pattern_two_column_media_text_button_center();
			$this->block_pattern_two_column_headings_text_bg_dark();
		}
	}

	/**
	 * Block pattern: 3-Column Content.
	 */
	public function block_pattern_three_column_content() {
		register_block_pattern(
			'pressbook/three-column-content',
			array(
				'title'         => esc_html__( '3-Column Content', 'pressbook-masonry-dark' ),
				'categories'    => array( 'pressbook-masonry-dark' ),
				'viewportWidth' => 1440,
				'content'       => ( '<!-- wp:cover {"url":"' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/mountain-sky.jpg","hasParallax":true,"dimRatio":80,"overlayColor":"black","align":"full","className":"pressbook-column-content"} -->
<div class="wp-block-cover alignfull has-parallax pressbook-column-content" style="background-image:url(' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/mountain-sky.jpg)"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"className":"u-wrapper"} -->
<div class="wp-block-group u-wrapper"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"textColor":"white"} -->
<h3 class="has-white-color has-text-color">' . esc_html__( 'Lorem Ipsum', 'pressbook-masonry-dark' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.', 'pressbook-masonry-dark' ) . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"textColor":"white"} -->
<h3 class="has-white-color has-text-color">' . esc_html__( 'Vestibulum auctor', 'pressbook-masonry-dark' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html__( 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.', 'pressbook-masonry-dark' ) . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"textColor":"white"} -->
<h3 class="has-white-color has-text-color">' . esc_html__( 'Aliquam tincidunt', 'pressbook-masonry-dark' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html__( 'Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.', 'pressbook-masonry-dark' ) . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->' ),
			)
		);
	}

	/**
	 * Block pattern: 3-Column Content with Buttons.
	 */
	public function block_pattern_three_column_content_buttons() {
		register_block_pattern(
			'pressbook/three-column-content-buttons',
			array(
				'title'         => esc_html__( '3-Column Content with Buttons', 'pressbook-masonry-dark' ),
				'categories'    => array( 'pressbook-masonry-dark' ),
				'viewportWidth' => 1440,
				'content'       => ( '<!-- wp:cover {"url":"' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/mountain-sky.jpg","hasParallax":true,"dimRatio":80,"overlayColor":"black","align":"full","className":"pressbook-column-content"} -->
<div class="wp-block-cover alignfull has-parallax pressbook-column-content" style="background-image:url(' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/mountain-sky.jpg)"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"className":"u-wrapper"} -->
<div class="wp-block-group u-wrapper"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"textColor":"white"} -->
<h3 class="has-white-color has-text-color">' . esc_html__( 'Lorem Ipsum', 'pressbook-masonry-dark' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.', 'pressbook-masonry-dark' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"vivid-red","textColor":"white","className":"pressbook-column-content-button is-style-fill"} -->
<div class="wp-block-button pressbook-column-content-button is-style-fill"><a class="wp-block-button__link has-white-color has-vivid-red-background-color has-text-color has-background" href="#">' . esc_html__( 'Read More', 'pressbook-masonry-dark' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"textColor":"white"} -->
<h3 class="has-white-color has-text-color">' . esc_html__( 'Vestibulum auctor', 'pressbook-masonry-dark' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html__( 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.', 'pressbook-masonry-dark' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"vivid-red","textColor":"white","className":"pressbook-column-content-button is-style-fill"} -->
<div class="wp-block-button pressbook-column-content-button is-style-fill"><a class="wp-block-button__link has-white-color has-vivid-red-background-color has-text-color has-background" href="#">' . esc_html__( 'Read More', 'pressbook-masonry-dark' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"textColor":"white"} -->
<h3 class="has-white-color has-text-color">' . esc_html__( 'Aliquam tincidunt', 'pressbook-masonry-dark' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html__( 'Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.', 'pressbook-masonry-dark' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"vivid-red","textColor":"white","className":"pressbook-column-content-button is-style-fill"} -->
<div class="wp-block-button pressbook-column-content-button is-style-fill"><a class="wp-block-button__link has-white-color has-vivid-red-background-color has-text-color has-background" href="#">' . esc_html__( 'Read More', 'pressbook-masonry-dark' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->' ),
			)
		);
	}

	/**
	 * Block pattern: 2-Column Media with List and Button (Dark).
	 */
	public function block_pattern_two_column_media_list_button_bg_dark() {
		register_block_pattern(
			'pressbook/two-column-media-list-button-bg-dark',
			array(
				'title'         => esc_html__( '2-Column Media with List and Button (Dark)', 'pressbook-masonry-dark' ),
				'categories'    => array( 'pressbook-masonry-dark' ),
				'viewportWidth' => 1440,
				'content'       => ( '<!-- wp:cover {"customOverlayColor":"#161616","minHeight":450,"minHeightUnit":"px","align":"wide","className":"pressbook-media-text-button pressbook-column-content"} -->
<div class="wp-block-cover alignwide pressbook-media-text-button pressbook-column-content" style="min-height:450px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim" style="background-color:#161616"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":null} -->
<div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"is-style-default"} -->
<figure class="wp-block-image size-large is-style-default"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/office-desk.jpg" alt="Office Desk"/><figcaption><mark style="background-color:rgba(0, 0, 0, 0);color:#979797" class="has-inline-color">' . esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', 'pressbook-masonry-dark' ) . '</mark></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%"><!-- wp:heading {"textColor":"white","className":"no-t-margin"} -->
<h2 class="no-t-margin has-white-color has-text-color">' . esc_html__( 'Praesent dapibus', 'pressbook-masonry-dark' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:list {"style":{"color":{"text":"#cccccc"},"typography":{"fontSize":"1.2em"}}} -->
<ul class="has-text-color" style="color:#cccccc;font-size:1.2em"><li>' . esc_html__( 'Lorem ipsum dolor sit amet.', 'pressbook-masonry-dark' ) . '</li><li>' . esc_html__( 'Aliquam tincidunt mauris eu risus.', 'pressbook-masonry-dark' ) . '</li><li>' . esc_html__( 'Nunc dignissim risus id metus.', 'pressbook-masonry-dark' ) . '</li><li>' . esc_html__( 'Cras ornare tristique elit.', 'pressbook-masonry-dark' ) . '</li></ul>
<!-- /wp:list -->

<!-- wp:buttons {"layout":{"type":"flex"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"black","textColor":"white","style":{"border":{"radius":"0px"},"typography":{"fontSize":"1.05em"}},"className":"pressbook-column-content-button is-style-outline"} -->
<div class="wp-block-button has-custom-font-size pressbook-column-content-button is-style-outline" style="font-size:1.05em"><a class="wp-block-button__link has-white-color has-black-background-color has-text-color has-background" href="#" style="border-radius:0px"><strong>' . esc_html__( 'Read More', 'pressbook-masonry-dark' ) . '</strong></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->' ),
			)
		);
	}

	/**
	 * Block pattern: 2-Column Media with Text and Button (Round Black).
	 */
	public function block_pattern_two_column_media_text_button_bg_dark() {
		register_block_pattern(
			'pressbook/two-column-media-text-button-bg-dark',
			array(
				'title'         => esc_html__( '2-Column Media with Text and Button (Round Black)', 'pressbook-masonry-dark' ),
				'categories'    => array( 'pressbook-masonry-dark' ),
				'viewportWidth' => 1440,
				'content'       => ( '<!-- wp:cover {"overlayColor":"black","minHeight":450,"minHeightUnit":"px","align":"wide","className":"pressbook-media-text-button pressbook-column-content"} -->
<div class="wp-block-cover alignwide pressbook-media-text-button pressbook-column-content" style="min-height:450px"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-style-rounded"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/office-desk.jpg" alt="' . esc_attr__( 'Office Desk', 'pressbook-masonry-dark' ) . '"/><figcaption><mark style="background-color:rgba(0, 0, 0, 0);color:#979797" class="has-inline-color">' . esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', 'pressbook-masonry-dark' ) . '</mark></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"60%"} -->
<div class="wp-block-column" style="flex-basis:60%"><!-- wp:heading {"level":3,"textColor":"white"} -->
<h3 class="has-white-color has-text-color">' . esc_html__( 'Lorem ipsum dolor sit amet', 'pressbook-masonry-dark' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"white"} -->
<p class="has-white-color has-text-color">' . esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'pressbook-masonry-dark' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"vivid-red","textColor":"white","className":"pressbook-column-content-button is-style-fill"} -->
<div class="wp-block-button pressbook-column-content-button is-style-fill"><a class="wp-block-button__link has-white-color has-vivid-red-background-color has-text-color has-background" href="#">' . esc_html__( 'Read More', 'pressbook-masonry-dark' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->' ),
			)
		);
	}

	/**
	 * Block pattern: 2-Column Media with Text and Button (Center).
	 */
	public function block_pattern_two_column_media_text_button_center() {
		register_block_pattern(
			'pressbook/two-column-media-text-button-center',
			array(
				'title'         => esc_html__( '2-Column Media with Text and Button (Center)', 'pressbook-masonry-dark' ),
				'categories'    => array( 'pressbook-masonry-dark' ),
				'viewportWidth' => 1440,
				'content'       => ( '<!-- wp:cover {"url":"' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/mountain-sky.jpg","hasParallax":true,"dimRatio":80,"overlayColor":"black","contentPosition":"center center","align":"full","className":"pressbook-column-content"} -->
<div class="wp-block-cover alignfull has-parallax pressbook-column-content" style="background-image:url(' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/mountain-sky.jpg)"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"className":"u-wrapper"} -->
<div class="wp-block-group u-wrapper"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"align":"center","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image aligncenter size-full"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/office-desk.jpg" alt="' . esc_attr__( 'Office Desk', 'pressbook-masonry-dark' ) . '"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">' . esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi.', 'pressbook-masonry-dark' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"vivid-red","textColor":"white","className":"pressbook-column-content-button is-style-fill"} -->
<div class="wp-block-button pressbook-column-content-button is-style-fill"><a class="wp-block-button__link has-white-color has-vivid-red-background-color has-text-color has-background" href="#">' . esc_html__( 'Read More', 'pressbook-masonry-dark' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"align":"center","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image aligncenter size-full"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/office-desk.jpg" alt="' . esc_attr__( 'Office Desk', 'pressbook-masonry-dark' ) . '"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">' . esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi.', 'pressbook-masonry-dark' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"vivid-red","textColor":"white","className":"pressbook-column-content-button is-style-fill"} -->
<div class="wp-block-button pressbook-column-content-button is-style-fill"><a class="wp-block-button__link has-white-color has-vivid-red-background-color has-text-color has-background" href="#">' . esc_html__( 'Read More', 'pressbook-masonry-dark' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->' ),
			)
		);
	}

	/**
	 * Block pattern: 2-Column Headings with Text (Dark).
	 */
	public function block_pattern_two_column_headings_text_bg_dark() {
		register_block_pattern(
			'pressbook/two-column-headings-text-bg-dark',
			array(
				'title'         => esc_html__( '2-Column Headings with Text (Dark)', 'pressbook-masonry-dark' ),
				'categories'    => array( 'pressbook-masonry-dark' ),
				'viewportWidth' => 1440,
				'content'       => ( '<!-- wp:cover {"customOverlayColor":"#161616"} -->
<div class="wp-block-cover"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim" style="background-color:#161616"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","style":{"color":{"text":"#adb2b5"},"typography":{"fontSize":"2em"}}} -->
<h2 class="has-text-align-center has-text-color" style="color:#adb2b5;font-size:2em">' . esc_html__( 'Aliquam tincidunt mauris eu risus', 'pressbook-masonry-dark' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:columns {"verticalAlignment":null} -->
<div class="wp-block-columns"><!-- wp:column {"style":{"spacing":{"padding":{"top":"1.25em","right":"1.25em","bottom":"1.25em","left":"1.25em"}}},"backgroundColor":"black"} -->
<div class="wp-block-column has-black-background-color has-background" style="padding-top:1.25em;padding-right:1.25em;padding-bottom:1.25em;padding-left:1.25em"><!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#999fa3"}}} -->
<h3 class="has-text-align-center has-text-color" style="color:#999fa3">' . esc_html__( 'Lorem ipsum dolor sit amet', 'pressbook-masonry-dark' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#999fa3"}}} -->
<p class="has-text-color" style="color:#999fa3">' . esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, pede.', 'pressbook-masonry-dark' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:quote {"style":{"color":{"text":"#999fa3"}}} -->
<blockquote class="wp-block-quote has-text-color" style="color:#999fa3"><p>' . esc_html__( 'Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.', 'pressbook-masonry-dark' ) . '</p></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"1.25em","right":"1.25em","bottom":"1.25em","left":"1.25em"}}},"backgroundColor":"black"} -->
<div class="wp-block-column has-black-background-color has-background" style="padding-top:1.25em;padding-right:1.25em;padding-bottom:1.25em;padding-left:1.25em"><!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#999fa3"}}} -->
<h3 class="has-text-align-center has-text-color" style="color:#999fa3">' . esc_html__( 'Lorem ipsum dolor sit amet', 'pressbook-masonry-dark' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#999fa3"}}} -->
<p class="has-text-color" style="color:#999fa3">' . esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, pede.', 'pressbook-masonry-dark' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:quote {"style":{"color":{"text":"#999fa3"}}} -->
<blockquote class="wp-block-quote has-text-color" style="color:#999fa3"><p>' . esc_html__( 'Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.', 'pressbook-masonry-dark' ) . '</p></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->' ),
			)
		);
	}
}
