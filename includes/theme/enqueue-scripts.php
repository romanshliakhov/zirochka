<?php
function theme_enqueue_scripts() {
    $manifest_path = THEME_DIR . '/assets/assets-manifest.json';

    if ( file_exists( $manifest_path ) ) {
        $manifest = json_decode( file_get_contents( $manifest_path ), true );

        if ( $manifest && isset( $manifest['js'] ) ) {

            // 1. Подключаем vendors, если есть
            if ( isset( $manifest['js']['vendors'] ) && !empty($manifest['js']['vendors']['file']) ) {
                wp_register_script(
                    'vendors',
                    THEME_URI . '/assets/' . $manifest['js']['vendors']['file'],
                    array(),
                    _S_VERSION,
                    true
                );
                wp_enqueue_script( 'vendors' );
            }

            // 2. Получаем ID модальных окон из ACF
            $modal_box = get_field('modal_box', 'modals_options');

            $modal_done  = isset($modal_box['success_id']) ? $modal_box['success_id'] : [];
            $modal_error = isset($modal_box['error_id']) ? $modal_box['error_id'] : [];

            // 3. AJAX параметры
            wp_register_script( 'ajax_params', '', array(), null, false );
            wp_add_inline_script( 'ajax_params', 'window.ajax_params = ' . json_encode( array(
                    'ajax_url'       => admin_url( 'admin-ajax.php' ),
                    'once'           => wp_create_nonce('ajax_global'),
                    'themeUrl'       => THEME_URI,
                    'modalSuccessId' => isset($modal_done[0]) ? $modal_done[0] : '',
                    'modalErrorId'   => isset($modal_error[0]) ? $modal_error[0] : '',
                ) ) . ';' );
            wp_enqueue_script( 'ajax_params' );

            // 4. Подключаем main, с зависимостями
            if ( isset( $manifest['js']['main'] ) && !empty($manifest['js']['main']['file']) ) {
                $main_deps = array( 'ajax_params' );

                if ( isset( $manifest['js']['vendors'] ) && !empty($manifest['js']['vendors']['file']) ) {
                    $main_deps[] = 'vendors';
                }

                wp_register_script(
                    'main',
                    THEME_URI . '/assets/' . $manifest['js']['main']['file'],
                    $main_deps,
                    _S_VERSION,
                    true
                );
                wp_enqueue_script( 'main' );
            }
        }
    }
}

// Добавление атрибута defer для main и vendors
function add_defer_attribute( $tag, $handle ) {
    if ( in_array($handle, array('main', 'vendors')) ) {
        return str_replace( ' src', ' defer="defer" src', $tag );
    }
    return $tag;
}

add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 3 );
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );