<?php
	add_action('init', function () {
		$post_type = 'projects';

		$labels = [
			'name'               => __('Projects', THEME_SLUG),
			'singular_name'      => __('Project', THEME_SLUG),
			'menu_name'          => __('Projects', THEME_SLUG),
			'name_admin_bar'     => __('Project', THEME_SLUG),
			'add_new'            => __('Add New', THEME_SLUG),
			'add_new_item'       => __('Add New Project', THEME_SLUG),
			'new_item'           => __('New Project', THEME_SLUG),
			'edit_item'          => __('Edit Project', THEME_SLUG),
			'view_item'          => __('View Project', THEME_SLUG),
			'all_items'          => __('All Projects', THEME_SLUG),
			'not_found'          => __('No projects found.', THEME_SLUG),
			'not_found_in_trash' => __('No projects found in Trash.', THEME_SLUG),
		];

		$args = [
			'labels'             => $labels,
			'public'             => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'has_archive'        => false,
			'rewrite'            => ['slug' => 'projects'],
			'supports'           => ['title', 'thumbnail', 'custom-fields'],
			'taxonomies'         => ['projects_category'],
			'menu_icon'          => 'dashicons-portfolio',
			'show_in_rest'       => true,
		];

		register_post_type($post_type, $args);

		// === Register Project Taxonomies ===
		register_taxonomy('roofing_type', 'projects', [
			'label' => __('Type of Roofing', THEME_SLUG),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
		]);

		register_taxonomy('project_location', 'projects', [
			'label' => __('Location', THEME_SLUG),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
		]);

		register_taxonomy('roof_color', 'projects', [
			'label' => __('Roof Color', THEME_SLUG),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
		]);

		// Добавим новые колонки
		add_filter('manage_projects_posts_columns', function($columns) {
			$columns['roofing_type'] = __('Type of Roofing', THEME_SLUG);
			$columns['project_location'] = __('Location', THEME_SLUG);
			$columns['roof_color'] = __('Roof Color', THEME_SLUG);
			return $columns;
		});

		// Выведем значения таксономий
		add_action('manage_projects_posts_custom_column', function($column, $post_id) {
			if (in_array($column, ['roofing_type', 'project_location', 'roof_color'])) {
				$terms = get_the_terms($post_id, $column);
				if (!empty($terms) && !is_wp_error($terms)) {
					echo join(', ', wp_list_pluck($terms, 'name'));
				} else {
					echo '—';
				}
			}
		}, 10, 2);
	});
