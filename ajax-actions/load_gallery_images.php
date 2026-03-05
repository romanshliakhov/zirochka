<?php
	add_action( 'wp_ajax_load_gallery_images', 'ajax_load_gallery_images' );
	add_action( 'wp_ajax_nopriv_load_gallery_images', 'ajax_load_gallery_images' );

	function ajax_load_gallery_images() {

		$post_id = intval( $_POST['post_id'] );
		$post    = get_post( $post_id );
		$offset  = isset( $_POST['offset'] ) ? intval( $_POST['offset'] ) : 0;
		$limit   = 4;

		$gallery = get_field( 'gallery', $post_id );

		if ( ! $gallery ) {
			$builder = get_field( 'builder', $post_id );

			if ( ! $builder || ! is_array( $builder ) ) {
				wp_send_json_error( [ 'message' => 'Builder field is empty or not array' ] );
			}

			$gallery = null;

			foreach ( $builder as $section ) {
				if ( isset( $section['acf_fc_layout'] ) && $section['acf_fc_layout'] === 'section-gallery' ) {
					$gallery = $section['gallery'] ?? null;
					break;
				}
			}
		}

		$items = array_slice( $gallery, $offset, $limit );


		if ( ! $post_id ) {
			wp_send_json_error( [ 'message' => 'Invalid post ID' ] );
		}

		if ( ! $post ) {
			wp_send_json_error( [ 'message' => 'Post not found' ] );
		}
//

		ob_start();
		if ( $gallery ) {
			foreach ( $items as $image ) : ?>
                <li>
                    <a data-fancybox="gallery-<?= $post_id; ?>" href="<?= esc_url( $image['url'] ); ?>"<?php if ( $image['type'] === 'video' ) : ?> data-video="true" <?php endif; ?>>
						<?php if ( $image['type'] === 'video' ) : ?>
                            <img src="<?= esc_url( $image['sizes']['large'] ) ?>"
                                 alt="<?= esc_attr( $image['alt'] ) ?>">
						<?php else : ?>
							<?= display_image( $image, '500', '500' ); ?>
						<?php endif; ?>
                    </a>
                </li>
			<?php endforeach;
		}
		$gallery_html = ob_get_clean();

		wp_send_json_success( [
			'gallery' => $gallery_html,
		] );
	}