<?php
	add_action( 'wp_ajax_get_news_posts', 'ajax_get_news_posts' );
	add_action( 'wp_ajax_nopriv_get_news_posts', 'ajax_get_news_posts' );

	function ajax_get_news_posts() {
		if ( empty( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'ajax_global' ) ) {
			wp_send_json_error( [ 'message' => 'Invalid nonce' ] );
		}

		$page = $_POST['page'] ?? 1;

		$args = [
			'post_type'      => 'news',
			'posts_per_page' => 6,
			'paged'          => $page,
		];

		$query = new WP_Query( $args );

		ob_start();

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				display_news_card( get_the_ID() );
			}
		} else {
			echo '<p>No posts found.</p>';
		}

		$html = ob_get_clean();

		wp_send_json_success( [
			'html' => $html,
			'max'  => $query->max_num_pages,
		] );

		wp_die();
	}
