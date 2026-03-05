<?php

	function register_teams_post_type() {
		$labels = array(
			'name'                  => __('Наша Команда', THEME_SLUG),
			'singular_name'         => __('Наша Команда', THEME_SLUG),
			'menu_name'             => __('Наша Команда', THEME_SLUG),
			'all_items'             => __('Додати члена команди', THEME_SLUG),
			'add_new'               => __('Додати члена', THEME_SLUG),
			'add_new_item'          => __('Додати нового члена', THEME_SLUG),
			'edit_item'             => __('Редагувати члена', THEME_SLUG),
			'new_item'              => __('Новий член', THEME_SLUG),
			'view_item'             => __('Переглянути члена', THEME_SLUG),
			'search_items'          => __('Пошук члена команди', THEME_SLUG),
			'not_found'             => __('Член команди не знайдений', THEME_SLUG),
			'not_found_in_trash'    => __('Корзина порожня', THEME_SLUG),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false, // Отключено публичное отображение
			'exclude_from_search'=> true,   // Не участвуют в поиске
			'publicly_queryable' => true,  // Нет возможности открыть сингл
			'show_in_nav_menus'  => true,  // Не отображается в меню
			'show_ui'            => true,   // Видим в админке
			'menu_icon'          => 'dashicons-groups', // Иконка отзывов
			'has_archive'        => true,  // Нет архива
			'rewrite'            => true,  // Без перезаписи URL
			'supports'           => ['title','thumbnail','custom-fields'], // Что поддерживает
			'show_in_rest'       => true,   // Для поддержки Gutenberg
		);

		register_post_type('teams', $args);
	}
	add_action('init', 'register_teams_post_type');
