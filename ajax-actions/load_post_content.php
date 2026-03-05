<?php
	add_action( 'wp_ajax_load_post_content', 'ajax_load_post_content' );
	add_action( 'wp_ajax_nopriv_load_post_content', 'ajax_load_post_content' );

	function ajax_load_post_content() {
		$post_id = intval( $_POST['post_id'] );
		$post = get_post( $post_id );

		if ( ! $post_id ) {
			wp_send_json_error( [ 'message' => 'Invalid post ID' ] );
		}

		if ( ! $post ) {
			wp_send_json_error( [ 'message' => 'Post not found' ] );
		}


		$editors = get_field( 'editors', $post_id );
		ob_start();
		if ( $editors ) : ?>
			<?= display_editor_blocks($editors, 'editors')?>
		<?php endif;
		$editors = ob_get_clean();

//        редактор
		ob_start();
		if ( $post->post_content ) : ?>
			<?= display_post_content($post_id,'editor')?>
		<?php endif;
		$content = ob_get_clean();

//      табы
		$tabs = get_field( 'tabs', $post_id );
		ob_start();
		if ( $tabs ) : ?>
			<?= display_tabs($tabs,'')?>
		<?php endif;
		$tabs_html = ob_get_clean();

//      галерея
		$gallery = get_field( 'gallery', $post_id );
		ob_start();
		if ( $gallery ) {
			display_gallery( $gallery, 500, 500, $post_id );
		}
		$gallery_html = ob_get_clean();

//      ссылка
		$link = get_field( 'link', $post_id );

		wp_send_json_success( [
			'editors' => $editors,
			'content' => $content,
			'tabs'    => $tabs_html,
			'gallery' => $gallery_html,
			'link'    => $link,
		] );
	}