<?php
	if ( ! defined( '_S_VERSION' ) ) {
		define( '_S_VERSION', '1.0.1' );
	}

	define('PRINT_TEMPLATE_NAME',  true); // Set true to show the template used

	define('BUILD', 	 get_template_directory_uri() . '/assets/');
	define('THEME_SLUG', basename(get_template_directory()));
	define('THEME_URI',  get_template_directory_uri());
	define('THEME_DIR',  get_template_directory());

	add_theme_support( 'title-tag' );

	require_once THEME_DIR . '/vendor/autoload.php';
	require_once THEME_DIR . '/acf/index.php';

	require_once THEME_DIR . '/includes/helpers.php';

	// ====================== Styles && Scripts ======================
	require_once THEME_DIR . '/includes/theme/enqueue-admin.php';
	require_once THEME_DIR . '/includes/theme/enqueue-styles.php';
	require_once THEME_DIR . '/includes/theme/enqueue-scripts.php';

	function theme_setup() {
		add_theme_support( 'post-thumbnails' );
	}

	add_action( 'after_setup_theme', 'theme_setup' );


	// Добавление lazy loading ко всем изображениям
	function add_lazy_loading_to_all_images( $content ) {
		if ( is_admin() || empty( $content ) ) {
			return $content;
		}

		$content = preg_replace_callback(
			'/<img(?![^>]*loading=["\']?(?:lazy|eager|auto)["\']?)[^>]+>/i',
			function ( $matches ) {
				return str_replace( '<img', '<img loading="lazy"', $matches[0] );
			},
			$content
		);

		return $content;
	}

	add_filter( 'the_content', 'add_lazy_loading_to_all_images' );

	// Счетчик просмотров
	function update_post_views($postID) {
		$count_key = 'post_views_count';
		$count = (int) get_post_meta($postID, $count_key, true);
		update_post_meta($postID, $count_key, $count + 1);
	}

	function get_post_views($postID) {
		return (int) get_post_meta($postID, 'post_views_count', true) ?: 0;
	}

	add_action('wp', function () {
		if (is_single() && !is_admin()) {
			update_post_views(get_the_ID());
		}
	});

	// Подключение дополнительных файлов
	$helpers = array(
		// '/ajax-actions/load_news_pagination.php',

		'/helpers/shortcodes_fields.php',
		'/helpers/fake_archive_pages.php',
		'/helpers/clean_the_content.php',
		'/helpers/default_reset.php',
		'/helpers/allow_svg_upload.php',
		'/helpers/contact_form_hooks.php',
		'/helpers/menus.php',
		'/helpers/share_socials.php',
		'/helpers/custom-editor.php',
		'/helpers/remove_post_slug.php',

		'/custom_posts/post_type_modals.php',


		'/hooks/display_breadcrumbs.php',
		'/hooks/display_editors_blocks.php',
		'/hooks/display_image.php',
		'/hooks/display_sprite.php',

		'/shortcodes/index.php',
	);

	foreach ( $helpers as $helper ) {
		require_once THEME_DIR . $helper;
	}

	add_filter('upload_mimes', 'allow_glb_uploads');
	function allow_glb_uploads($mimes) {
		$mimes['glb'] = 'model/gltf-binary';
		return $mimes;
	}

	// add_filter('tiny_mce_before_init', function ($init) {
	// 	$map = [
	// 		"FBFBFB", "White",        // --bg-a
	// 		"000000", "Black",        // --bg-b
	// 		"292929", "Dark Gray",    // --bg-c
	// 		"1C1C1C", "Graphite",     // --bg-d
	// 		"A41C35", "Burgundy",     // --bg-e
	// 		"2E7BB2", "Blue",         // --bg-f
	// 		"C23A53", "Red",          // --bg-g
	// 		"900821", "Dark Red",     // --bg-h
	// 		"56A3DA", "Light Blue",   // --bg-i
	// 		"2471A8", "Dark Blue",    // --bg-j
	// 	];
		
	// 	$pairs = [];
	// 	foreach (array_chunk($map, 2) as [$hex, $name]) {
	// 		$pairs[] = '"' . ltrim($hex, '#') . '","' . $name . '"';
	// 	}

	// 	$init['textcolor_map']  = '[' . implode(',', $pairs) . ']';
	// 	$init['textcolor_rows'] = 5; // 10 colors → 5 rows x 2

	// 	return $init;
	// });