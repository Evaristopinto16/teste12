<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Design related metabox.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Register design related metabox.
 */
class Metabox implements Serviceable {
	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 10, 2 );
	}

	/**
	 * Add design meta boxes.
	 */
	public function add_meta_boxes() {
		add_meta_box( 'oceanly-design-metabox', esc_html__( 'Oceanly Settings', 'oceanly' ), array( $this, 'metabox_html' ), array( 'page' ), 'side', 'default' );
	}

	/**
	 * Save metabox fields.
	 *
	 * @param int     $post_id post id.
	 * @param WP_Post $post post object.
	 */
	public function save_meta_boxes( $post_id, $post ) {
		$nonce_key = ( 'oceanly_design_metabox_nonce_' . $post_id );

		if ( ! array_key_exists( $nonce_key, $_POST ) ||
			! wp_verify_nonce( $_POST[ $nonce_key ], $nonce_key ) ) { // phpcs:ignore
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! in_array( $post->post_type, array( 'page' ), true ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		if ( wp_is_post_revision( $post ) ) {
			return;
		}

		$hide_header_title = array_key_exists( 'oceanly_hide_header_title', $_POST ) ? (bool) $_POST['oceanly_hide_header_title'] : false;

		update_post_meta(
			$post_id,
			'oceanly_settings',
			array(
				'hide_header_title' => $hide_header_title,
			)
		);
	}

	/**
	 * Metabox HTML output.
	 *
	 * @param WP_Post $post post object.
	 */
	public function metabox_html( $post ) {
		$settings = get_post_meta( $post->ID, 'oceanly_settings', true );

		if ( ! is_array( $settings ) ) {
			$settings = array();
		}

		$hide_header_title = array_key_exists( 'hide_header_title', $settings ) ? (bool) $settings['hide_header_title'] : false;

		$nonce_key = 'oceanly_design_metabox_nonce_' . $post->ID;
		?>
		<input type="hidden" name="<?php echo esc_attr( $nonce_key ); ?>" value="<?php echo esc_attr( wp_create_nonce( $nonce_key ) ); ?>">

		<p class="oceanly-metabox-field">
			<input <?php checked( $hide_header_title, true, true ); ?> id="oceanly-hide-title" type="checkbox" name="oceanly_hide_header_title" value="1">
			<label for="oceanly-hide-title"><?php esc_html_e( 'Hide Header Title', 'oceanly' ); ?></label>
		</p>
		<?php
	}
}
