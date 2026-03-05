<?php
	function theme_enqueue_styles() {
		$post_id = get_the_ID();
		$archives = get_option('custom_fake_archives', []);

		wp_enqueue_style( 'vendor', THEME_URI . '/assets/css/vendor.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'critical', THEME_URI . '/assets/css/critical.css', array(), _S_VERSION, 'all' );


		if (is_tax()) {
			$taxonomy = get_queried_object()->taxonomy ?? '';
			$taxonomy_slug = str_replace('_', '-', $taxonomy);

			wp_enqueue_style( $taxonomy_slug, THEME_URI . '/assets/css/taxonomy-pages/'.$taxonomy_slug.'.css', array(), _S_VERSION, 'all' );
		}


		foreach ($archives as $post_type => $archive_id) {
			if ((int)$archive_id === $post_id) {
				$css_path = THEME_URI . "/assets/css/archive-pages/{$post_type}-archive.css";

				wp_enqueue_style($post_type, $css_path, array(), _S_VERSION, 'all' );

				break;
			}
		}


		$loaded_styles = array();

		if ( have_rows( 'post_builder', $post_id ) && is_singular('news') ) {
//			$loaded_styles = array();

			while ( have_rows( 'post_builder', $post_id ) ) {
				the_row();
				$layout = get_row_layout();

				if ( ! in_array( $layout, $loaded_styles ) ) {
					$style_path = THEME_URI . '/assets/css/template_parts/' . str_replace('_', '-', $layout) . '.css';

					if ( file_exists( get_template_directory() . '/assets/css/template_parts/' . str_replace('_', '-', $layout) . '.css' ) ) {
						wp_enqueue_style( $layout, $style_path, array(), _S_VERSION, 'all' );
						$loaded_styles[] = $layout;
					}
				}
			}
		}



		if ( have_rows( 'builder', $post_id ) ) {
			while ( have_rows( 'builder', $post_id ) ) { the_row();
				$layout = get_row_layout();

				if ( ! in_array( $layout, $loaded_styles ) ) {
					$style_path = THEME_URI . '/assets/css/template_parts/' . str_replace('_', '-', $layout) . '.css';

					if ( file_exists( get_template_directory() . '/assets/css/template_parts/' . str_replace('_', '-', $layout) . '.css' ) ) {
						wp_enqueue_style( $layout, $style_path, array(), _S_VERSION, 'all' );
						$loaded_styles[] = $layout;
					}
				}
			}
		}

		wp_enqueue_style( 'main-css', THEME_URI . '/assets/css/style.css', array(), _S_VERSION, 'all' );
	}

	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
