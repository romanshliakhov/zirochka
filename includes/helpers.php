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

/**
 * Текущий языковой ключ для опций.
 * Если WPML нет — 'default'.
 */
function fa_current_lang(): string {
    if (function_exists('icl_object_id')) {
        $cur = apply_filters('wpml_current_language', null);
        if (is_string($cur) && $cur !== '') {
            return $cur;
        }
    }
    return 'default';
}

/**
 * Эффективная карта архивов с учётом языка, default и legacy.
 * Требует существующую fa_current_lang() из вашего кода.
 */
function fa_get_archives_effective(): array {
    $lang = fa_current_lang();

    $cur    = get_option( 'custom_fake_archives_' . $lang, [] );
    $def    = get_option( 'custom_fake_archives_default', [] );
    $legacy = get_option( 'custom_fake_archives', [] );

    $cur    = is_array( $cur ) ? $cur : [];
    $def    = is_array( $def ) ? $def : [];
    $legacy = is_array( $legacy ) ? $legacy : [];

    // Нормализация: sanitize_key + (int) > 0
    $normalize = static function ( array $map ): array {
        $out = [];
        foreach ( $map as $pt => $id ) {
            $pt = sanitize_key( (string) $pt );
            $id = (int) $id;
            if ( $pt !== '' && $id > 0 ) {
                $out[ $pt ] = $id;
            }
        }

        return $out;
    };

    $cur    = $normalize( $cur );
    $def    = $normalize( $def );
    $legacy = $normalize( $legacy );

    // Приоритет: текущий язык -> default -> legacy
    return $cur + $def + $legacy;
}



function get_archive_by_post( $post_type ) {
        $post_type = sanitize_key( (string) $post_type );
        if ( $post_type === '' ) {
            return null;
        }

        $map     = fa_get_archives_effective();
        $page_id = (int) ( $map[ $post_type ] ?? 0 );
        if ( $page_id <= 0 ) {
            return null;
        }

        $post = get_post( $page_id );

        return ( $post instanceof WP_Post && $post->post_status !== 'trash' ) ? $post : null;
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
