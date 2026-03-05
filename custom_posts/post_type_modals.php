<?php
	function register_modals_post_type() {
		$labels = array(
			'name'               => __( 'Modals', THEME_SLUG ),
			'singular_name'      => __( 'Modal Window', THEME_SLUG ),
			'menu_name'          => __( 'Modals', THEME_SLUG ),
			'name_admin_bar'     => __( 'Modal Window', THEME_SLUG ),
			'add_new'            => __( 'Add New', THEME_SLUG ),
			'add_new_item'       => __( 'Add New Modal Window', THEME_SLUG ),
			'new_item'           => __( 'New Modal Window', THEME_SLUG ),
			'edit_item'          => __( 'Edit Modal Window', THEME_SLUG ),
			'view_item'          => __( 'View Modal Window', THEME_SLUG ),
			'all_items'          => __( 'All Modals', THEME_SLUG ),
			'search_items'       => __( 'Search Modals', THEME_SLUG ),
			'not_found'          => __( 'No modals found.', THEME_SLUG ),
			'not_found_in_trash' => __( 'No modals found in Trash.', THEME_SLUG ),
		);


		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'exclude_from_search' => true, // Исключаем из поиска
			'publicly_queryable'  => false, // Отключаем single page
			'has_archive'         => false, // Отключаем archive page
			'rewrite'             => false, // Отключаем поддержку ЧПУ
			'show_in_rest'        => true, // Для поддержки редактора блоков
			'supports'            => array( 'title', 'thumbnail' ), // Поля, которые поддерживает тип записи
			'show_ui'             => true, // Отображать в админке
			'show_in_menu'        => true, // Отображать в меню
			'menu_position'       => 5,    // Позиция в меню админки
			'menu_icon'           => 'dashicons-align-full-width', // Иконка в меню
		);

		register_post_type( 'modals', $args );
	}

	add_action( 'init', function() {
		register_taxonomy( 'modal_type', ['modals'], [
				'label'        => 'Modal Types',
				'hierarchical' => false,
				'public'       => true,
				'show_ui'      => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
			] );
		} );
		
	add_action( 'init', 'register_modals_post_type' );


	function modify_modal_post_link( $post_link, $post ) {
		if ( $post->post_type == 'modals' ) {
			return '/modal_' . $post->ID;
		}

		return $post_link;
	}

	add_filter( 'post_type_link', 'modify_modal_post_link', 10, 2 );

	function customize_modal_link_results( $results, $query ) {
		foreach ( $results as &$result ) {
			if ( $result['post_type'] == 'modals' ) {
				$result['permalink'] = '/modal_' . $result['ID'];
			}
		}

		return $results;
	}

	add_filter( 'wp_link_query', 'customize_modal_link_results', 10, 2 );

	function remove_http_from_modal_links( $url, $post ) {
		if ( $post->post_type == 'modals' ) {
			return '/modal_' . $post->ID;
		}

		return $url;
	}

	add_filter( 'post_link', 'remove_http_from_modal_links', 10, 2 );

	function modify_modal_shortlink( $shortlink, $id, $context, $allow_slugs ) {
		$post = get_post( $id );
		if ( $post && $post->post_type == 'modals' ) {
			return '/modal_' . $post->ID;
		}

		return $shortlink;
	}

	add_filter( 'pre_get_shortlink', 'modify_modal_shortlink', 10, 4 );

	function strip_protocol_from_links( $url ) {
		if ( strpos( $url, '/modal_' ) !== false ) {
			return preg_replace( '/.*(/modal_\d+)/', '$1', $url );
		}

		return $url;
	}

	add_filter( 'wp_get_attachment_url', 'strip_protocol_from_links', 10, 1 );
	add_filter( 'attachment_link', 'strip_protocol_from_links', 10, 1 );
	add_filter( 'the_permalink', 'strip_protocol_from_links', 10, 1 );