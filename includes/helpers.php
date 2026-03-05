<?php
	function pvd( $var ) {
		echo '<pre>';
		var_dump( $var );
		echo '</pre>';
	}

	function show_template() {
		global $template;
		echo '<div style="position:fixed;z-index:99999;left:20px;bottom:20px">Template: ' . basename( $template ) . ' </div>';
	}


	if ( PRINT_TEMPLATE_NAME ) {
		add_action( 'wp_head', 'show_template' );
	}



	function get_archive_by_id($page_id) {
		$archives = get_option('custom_fake_archives', []);

		foreach ($archives as $post_type => $stored_id) {
			if ((int) $stored_id === (int) $page_id) {
				return $post_type;
			}
		}

		return null;
	}

	function get_archive_by_post($post_type) {
		$archives = get_option('custom_fake_archives', []);


		if ( isset($archives[$post_type]) ) {
			$page_id = intval($archives[$post_type]);

			return get_post($page_id);
		}
		return null;
	}



	// 🔧 Хелпер: получить тип поста даже если нет get_current_screen()
	function get_current_post_type_safe() {
		if (defined('DOING_AJAX') && DOING_AJAX && isset($_POST['post_id'])) {
			return get_post_type((int) $_POST['post_id']);
		}

		if (isset($_GET['post'])) {
			return get_post_type((int) $_GET['post']);
		}

		if (isset($_GET['post_type'])) {
			return sanitize_key($_GET['post_type']);
		}

		return null;
	}
