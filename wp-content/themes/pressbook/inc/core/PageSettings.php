<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Design related page settings.
 *
 * @package PressBook
 */

namespace PressBook;

/**
 * Register design related page settings.
 */
class PageSettings implements Serviceable {
	const META_KEY = 'pressbook_settings';

	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 10, 2 );
	}

	/**
	 * Add meta boxes for design related page settings.
	 */
	public function add_meta_boxes() {
		add_meta_box( 'pressbook-page-settings', esc_html__( 'PressBook Page Settings', 'pressbook' ), array( $this, 'metabox_html' ), array( 'page' ), 'side', 'default' );
	}

	/**
	 * Save metabox fields.
	 *
	 * @param int     $post_id post id.
	 * @param WP_Post $post post object.
	 */
	public function save_meta_boxes( $post_id, $post ) {
		$nonce_key = ( 'pressbook_settings_nonce_' . $post_id );

		if ( ! array_key_exists( $nonce_key, $_POST ) ||
			! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ $nonce_key ] ) ), $nonce_key ) ) {
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

		$hide_title = array_key_exists( 'pressbook_hide_title', $_POST ) ? (bool) $_POST['pressbook_hide_title'] : self::get_meta_default( 'hide_title' );

		$no_t_margin = array_key_exists( 'pressbook_no_t_margin', $_POST ) ? (bool) $_POST['pressbook_no_t_margin'] : self::get_meta_default( 'no_t_margin' );

		$no_b_margin = array_key_exists( 'pressbook_no_b_margin', $_POST ) ? (bool) $_POST['pressbook_no_b_margin'] : self::get_meta_default( 'no_b_margin' );

		$no_t_padding = array_key_exists( 'pressbook_no_t_padding', $_POST ) ? (bool) $_POST['pressbook_no_t_padding'] : self::get_meta_default( 'no_t_padding' );

		$no_b_padding = array_key_exists( 'pressbook_no_b_padding', $_POST ) ? (bool) $_POST['pressbook_no_b_padding'] : self::get_meta_default( 'no_b_padding' );

		$no_x_padding = array_key_exists( 'pressbook_no_x_padding', $_POST ) ? (bool) $_POST['pressbook_no_x_padding'] : self::get_meta_default( 'no_x_padding' );

		$transparent_bg = array_key_exists( 'pressbook_transparent_bg', $_POST ) ? (bool) $_POST['pressbook_transparent_bg'] : self::get_meta_default( 'transparent_bg' );

		if ( metadata_exists( 'post', $post_id, self::META_KEY ) ||
			// Add meta key only if any of the setting is not same as the default setting.
			( ( self::get_meta_default( 'hide_title' ) !== $hide_title ) ||
				( self::get_meta_default( 'no_t_margin' ) !== $no_t_margin ) ||
				( self::get_meta_default( 'no_b_margin' ) !== $no_b_margin ) ||
				( self::get_meta_default( 'no_t_padding' ) !== $no_t_padding ) ||
				( self::get_meta_default( 'no_b_padding' ) !== $no_b_padding ) ||
				( self::get_meta_default( 'no_x_padding' ) !== $no_x_padding ) ||
				( self::get_meta_default( 'transparent_bg' ) !== $transparent_bg )
			)
		) {
			update_post_meta(
				$post_id,
				self::META_KEY,
				array(
					'hide_title'     => $hide_title,
					'no_t_margin'    => $no_t_margin,
					'no_b_margin'    => $no_b_margin,
					'no_t_padding'   => $no_t_padding,
					'no_b_padding'   => $no_b_padding,
					'no_x_padding'   => $no_x_padding,
					'transparent_bg' => $transparent_bg,
				)
			);
		}
	}

	/**
	 * Metabox HTML output.
	 *
	 * @param WP_Post $post post object.
	 */
	public function metabox_html( $post ) {
		$settings = self::get_meta( $post->ID );

		$nonce_key = ( 'pressbook_settings_nonce_' . $post->ID );
		?>
		<input type="hidden" name="<?php echo esc_attr( $nonce_key ); ?>" value="<?php echo esc_attr( wp_create_nonce( $nonce_key ) ); ?>">

		<p class="pressbook-metabox-field">
			<input <?php checked( ( (bool) $settings['hide_title'] ), true, true ); ?> id="pressbook_hide_title" type="checkbox" name="pressbook_hide_title" value="1">
			<label for="pressbook_hide_title"><?php esc_html_e( 'Disable Header Title', 'pressbook' ); ?></label>
		</p>

		<p class="pressbook-metabox-field">
			<input <?php checked( ( (bool) $settings['no_t_margin'] ), true, true ); ?> id="pressbook_no_t_margin" type="checkbox" name="pressbook_no_t_margin" value="1">
			<label for="pressbook_no_t_margin"><?php esc_html_e( 'Remove Top Margin', 'pressbook' ); ?></label>
		</p>

		<p class="pressbook-metabox-field">
			<input <?php checked( ( (bool) $settings['no_b_margin'] ), true, true ); ?> id="pressbook_no_b_margin" type="checkbox" name="pressbook_no_b_margin" value="1">
			<label for="pressbook_no_b_margin"><?php esc_html_e( 'Remove Bottom Margin', 'pressbook' ); ?></label>
		</p>

		<p><?php esc_html_e( 'Below settings override customizer settings for page content layout (only if checked).', 'pressbook' ); ?></p>

		<p class="pressbook-metabox-field">
			<input <?php checked( ( (bool) $settings['no_t_padding'] ), true, true ); ?> id="pressbook_no_t_padding" type="checkbox" name="pressbook_no_t_padding" value="1">
			<label for="pressbook_no_t_padding"><?php esc_html_e( 'Force Remove Top Padding', 'pressbook' ); ?></label>
		</p>

		<p class="pressbook-metabox-field">
			<input <?php checked( ( (bool) $settings['no_b_padding'] ), true, true ); ?> id="pressbook_no_b_padding" type="checkbox" name="pressbook_no_b_padding" value="1">
			<label for="pressbook_no_b_padding"><?php esc_html_e( 'Force Remove Bottom Padding', 'pressbook' ); ?></label>
		</p>

		<p class="pressbook-metabox-field">
			<input <?php checked( ( (bool) $settings['no_x_padding'] ), true, true ); ?> id="pressbook_no_x_padding" type="checkbox" name="pressbook_no_x_padding" value="1">
			<label for="pressbook_no_x_padding"><?php esc_html_e( 'Force Remove Horizontal Padding', 'pressbook' ); ?></label>
		</p>

		<p class="pressbook-metabox-field">
			<input <?php checked( ( (bool) $settings['transparent_bg'] ), true, true ); ?> id="pressbook_transparent_bg" type="checkbox" name="pressbook_transparent_bg" value="1">
			<label for="pressbook_transparent_bg"><?php esc_html_e( 'Force Transparent Background', 'pressbook' ); ?></label>
		</p>
		<?php
	}

	/**
	 * Get meta settings.
	 *
	 * @param int $id Post ID.
	 * @return array
	 */
	public static function get_meta( $id ) {
		return wp_parse_args(
			( is_array( get_post_meta( $id, self::META_KEY, true ) ) ? get_post_meta( $id, self::META_KEY, true ) : array() ),
			self::get_meta_default()
		);
	}

	/**
	 * Get default meta settings.
	 *
	 * @param string $key Setting key.
	 * @return mixed|array
	 */
	public static function get_meta_default( $key = '' ) {
		$default = apply_filters(
			'pressbook_settings',
			array(
				'hide_title'     => false,
				'no_t_margin'    => false,
				'no_b_margin'    => false,
				'no_t_padding'   => false,
				'no_b_padding'   => false,
				'no_x_padding'   => false,
				'transparent_bg' => false,
			)
		);

		if ( array_key_exists( $key, $default ) ) {
			return $default[ $key ];
		}

		return $default;
	}

	/**
	 * Get meta settings for template parts.
	 *
	 * @param int $id Post ID.
	 * @return array
	 */
	public static function get_meta_config( $id ) {
		$meta = self::get_meta( $id );

		if ( $meta['no_t_margin'] ) {
			$wrapper_class = ' no-t-margin';
		} else {
			$wrapper_class = '';
		}

		$site_main_class = '';
		if ( $meta['no_b_margin'] ) {
			$site_main_class .= ' no-b-margin';
		}
		if ( $meta['no_t_padding'] ) {
			$site_main_class .= ' no-t-padding';
		}
		if ( $meta['no_b_padding'] ) {
			$site_main_class .= ' no-b-padding';
		}
		if ( $meta['no_x_padding'] ) {
			$site_main_class .= ' no-x-padding';
		}
		if ( $meta['transparent_bg'] ) {
			$site_main_class .= ' u-transparent-bg';
		}

		return array(
			'page_content'    => ( $meta['hide_title'] ? 'page-no-title' : 'page' ),
			'wrapper_class'   => $wrapper_class,
			'site_main_class' => $site_main_class,
		);
	}
}
