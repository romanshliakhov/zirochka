<?php
	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action('acf/init', function () {
		if (!function_exists('acf_add_local_field_group')) return;

		$builder = new FieldsBuilder('Builder');
		$post_builder = new FieldsBuilder('Post_Builder');
		$template_parts_dir = get_template_directory() . '/template_parts';

		$flex = $builder->addFlexibleContent('builder', [
			'button_label' => __('Add section', 'ACF'),
			'instructions' => __('Assemble the page sections', 'ACF'),
		]);

		$flex_post = $post_builder->addFlexibleContent('post_builder', [
			'button_label'   => __('Add post section', 'ACF'),
			'instructions'   => __('Assemble bottom content for posts', 'ACF'),
		]);

		foreach (glob($template_parts_dir . '/section-*.php') as $template_file) {
			$layout_name = basename($template_file, '.php');
			$label = ucwords(str_replace(['section-', '-', '_'], ['', ' ', ' '], $layout_name));

			$custom_fields_path = get_template_directory() . "/acf/builder_layout/{$layout_name}.fields.php";

			if (!file_exists($custom_fields_path)) continue;

			$returned = include $custom_fields_path;
			if (!$returned) continue;

			$layout_name = str_replace('-', '_', $layout_name);
			$fields = call_user_func($layout_name, $layout_name . '_fields');


			if (isset($fields['only'])) {
				$screen_post_type = get_current_post_type_safe();

				if (!in_array($screen_post_type, (array) $fields['only'], true)) {
					continue;
				}
			}

			$flex->addLayout($layout_name, [
				'label'   => $label,
				'display' => $fields['display'],
			])->addFields($fields['layout']);

			$flex_post->addLayout($layout_name, [
				'label'   => $label,
				'display' => $fields['display'],
			])->addFields($fields['layout']);
		}


		$builder
			->setLocation('post_template', '==', 'default')
			->or('post_type', '==', 'services');
			// ->or('post_template', '==', 'blog.php');

		// $post_builder
		// 	->setLocation('post_type', '==', 'news');



		acf_add_local_field_group($builder->build());
		// acf_add_local_field_group($post_builder->build());
	});


