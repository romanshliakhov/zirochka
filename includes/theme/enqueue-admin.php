<?php
	function theme_admin_assets() {
		foreach (glob(THEME_DIR . '/assets/css/acf_components/*.css') as $file_path) {
			$handle = 'admin-' . basename($file_path, '.css');
			$relative_path = str_replace(THEME_DIR, '', $file_path);
			wp_enqueue_style($handle, THEME_URI . $relative_path, [], _S_VERSION);
		}


		wp_enqueue_style( 'admin-css', THEME_URI . '/admin/css/theme.css', array(), _S_VERSION );
		wp_enqueue_script( 'admin-js', THEME_URI . '/admin/js/theme.js', array(), _S_VERSION, true );

		$issetPluginACF = class_exists( 'Acf' );

		wp_localize_script(
			'admin-js',
			'theme_js_params',
			array(
				'is_acf_exist' => $issetPluginACF,
				'theme_path'   => get_stylesheet_directory_uri(),
			)
		);
	}

	add_action( 'admin_enqueue_scripts', 'theme_admin_assets' );
