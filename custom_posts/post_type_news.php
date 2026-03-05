<?php
	// ==== ПЕРЕМЕННЫЕ ====
	$post_type = 'news';

	// Регистрируем CPT "Blog"
	function register_news_post_type() {
		global $post_type;

		$labels = [
			'name'               => __('Новини', THEME_SLUG),
			'singular_name'      => __('Новина', THEME_SLUG),
			'menu_name'          => __('Новини', THEME_SLUG),
			'name_admin_bar'     => __('Новина', THEME_SLUG),
			'add_new'            => __('Додати новину', THEME_SLUG),
			'add_new_item'       => __('Додати нову новину', THEME_SLUG),
			'new_item'           => __('Нова новина', THEME_SLUG),
			'edit_item'          => __('Редагувати новину', THEME_SLUG),
			'view_item'          => __('Переглянути новину', THEME_SLUG),
			'all_items'          => __('Всі новини', THEME_SLUG),
			'not_found'          => __('Новину не знайдено', THEME_SLUG),
			'not_found_in_trash' => __('Видаленний нових не знайдено', THEME_SLUG),
		];

		$args = [
			'labels'             => $labels,
			'public'             => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'rewrite' => [
				'slug' => 'news',
				'with_front' => false,
			],
			'menu_position'      => 5,
			'menu_icon'          => 'dashicons-edit-page',
			'supports'           => ['title', 'editor', 'thumbnail', 'custom-fields'],
		];

		register_post_type($post_type, $args);
	}

	add_action('init', 'register_news_post_type');