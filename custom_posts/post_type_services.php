<?php
	add_action('init', function () {
		$post_type = 'services';

		$labels = [
			'name'               => __('Наші послуги', THEME_SLUG),
			'singular_name'      => __('Наші послуги', THEME_SLUG),
			'menu_name'          => __('Послуги', THEME_SLUG),
			'name_admin_bar'     => __('Послуга', THEME_SLUG),
			'add_new'            => __('Додати послугу', THEME_SLUG),
			'add_new_item'       => __('Додати нову послугу', THEME_SLUG),
			'new_item'           => __('Нова послуга', THEME_SLUG),
			'edit_item'          => __('Редагувати послугу', THEME_SLUG),
			'view_item'          => __('Переглянути послугу', THEME_SLUG),
			'all_items'          => __('Всі послуги', THEME_SLUG),
			'not_found'          => __('Послугу не знайдено.', THEME_SLUG),
			'not_found_in_trash' => __('Немає видаленних послуг.', THEME_SLUG),
		];

		$args = [
			'labels'             => $labels,
			'public'             => true, // Отключено публичное отображение
			'show_ui'            => true, // Видим в админке
			'show_in_menu'       => true, // Нет возможности открыть сингл
			'show_in_nav_menus'  => true, // Не отображается в меню
			'has_archive'        => false, // Нет архива
			'rewrite'            => ['slug' => 'services'], // Без перезаписи URL
			'supports'           => ['title', 'excerpt', 'editor', 'thumbnail','custom-fields'], // Что поддерживает
			'menu_icon'          => 'dashicons-admin-multisite',
			'show_in_rest'       => true, // Для поддержки Gutenberg
		];

		register_post_type($post_type, $args);
	});
