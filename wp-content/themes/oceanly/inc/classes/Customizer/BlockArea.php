<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer block area base class.
 *
 * @package Oceanly
 */

namespace Oceanly\Customizer;

use Oceanly\Customizer;

/**
 * Base class for block area service classes.
 */
abstract class BlockArea extends Customizer {
	/**
	 * Get an array of reusable-blocks formatted as [ ID => Title ].
	 *
	 * @return array
	 */
	public function reusable_blocks_choices() {
		$reusable_blocks = get_posts(
			array(
				'post_type'   => 'wp_block',
				'numberposts' => 100,
			)
		);

		$reusable_blocks_choices = array( 0 => esc_html__( 'Select a block', 'oceanly' ) );
		foreach ( $reusable_blocks as $block ) {
			$reusable_blocks_choices[ $block->ID ] = $block->post_title;
		}

		return $reusable_blocks_choices;
	}

	/**
	 * Block area description.
	 *
	 * @return string
	 */
	public function block_area_description() {
		return wp_kses(
			sprintf(
				/* translators: %s: URL to the reusable-blocks admin page. */
				__( 'This is the content of the block area. You can create or edit the block area in the <a href="%s" target="_blank">Reusable Blocks Manager (opens in a new window)</a>.<br>After creating the reusable block, you may need to refresh this customizer page and then select the newly created block.<br>The selected block content will appear on the block area.', 'oceanly' ),
				esc_url( admin_url( 'edit.php?post_type=wp_block' ) )
			),
			array(
				'a'  => array(
					'href'   => array(),
					'target' => array(),
				),
				'br' => array(),
			)
		);
	}
}
