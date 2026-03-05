<?php
	add_action('init', function () {
		$post_type = 'roofs';

		$labels = [
			'name'               => __('Roofs', THEME_SLUG),
			'singular_name'      => __('Roof', THEME_SLUG),
			'menu_name'          => __('Roofs', THEME_SLUG),
			'name_admin_bar'     => __('Roof', THEME_SLUG),
			'add_new'            => __('Add New', THEME_SLUG),
			'add_new_item'       => __('Add New Roof', THEME_SLUG),
			'new_item'           => __('New Roof', THEME_SLUG),
			'edit_item'          => __('Edit Roof', THEME_SLUG),
			'view_item'          => __('View Roof', THEME_SLUG),
			'all_items'          => __('All Roofs', THEME_SLUG),
			'not_found'          => __('No roofs found.', THEME_SLUG),
			'not_found_in_trash' => __('No roofs found in Trash.', THEME_SLUG),
		];

		$args = [
			'labels'             => $labels,
			'public'             => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'has_archive'        => false,
			'rewrite'            => ['slug' => 'roofs'],
			'supports'           => ['title', 'thumbnail'],
			'taxonomies'         => ['roofs_category'],
			'menu_icon'          => 'dashicons-admin-home',
			'show_in_rest'       => true,
		];

		register_post_type($post_type, $args);
	});
