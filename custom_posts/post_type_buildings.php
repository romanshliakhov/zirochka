<?php

	function register_buildings_post_type() {
		$labels = array(
			'name'                  => __('Building Types', THEME_SLUG),
			'singular_name'         => __('Building Type', THEME_SLUG),
			'menu_name'             => __('Building Types', THEME_SLUG),
			'all_items'             => __('All Building Types', THEME_SLUG),
			'add_new'               => __('Add New', THEME_SLUG),
			'add_new_item'          => __('Add New Building', THEME_SLUG),
			'edit_item'             => __('Edit Building', THEME_SLUG),
			'new_item'              => __('New Building', THEME_SLUG),
			'view_item'             => __('View Building', THEME_SLUG),
			'search_items'          => __('Search Buildings', THEME_SLUG),
			'not_found'             => __('No Buildings found', THEME_SLUG),
			'not_found_in_trash'    => __('No Buildings found in Trash', THEME_SLUG),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false, // Отключено публичное отображение
			'exclude_from_search'=> true,   // Не участвуют в поиске
			'publicly_queryable' => false,  // Нет возможности открыть сингл
			'show_in_nav_menus'  => false,  // Не отображается в меню
			'show_ui'            => true,   // Видим в админке
			'menu_icon'          => 'dashicons-admin-home', // Иконка отзывов
			'has_archive'        => false,  // Нет архива
			'rewrite'            => false,  // Без перезаписи URL
			'supports'           => array('title'), // Что поддерживает
			'show_in_rest'       => true,   // Для поддержки Gutenberg
		);

		register_post_type('buildings', $args);
	}
	add_action('init', 'register_buildings_post_type');
