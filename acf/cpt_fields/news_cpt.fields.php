<?php
	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action('acf/init', function () {
		$options = new FieldsBuilder('news_info', [
			'title' => 'Новостной баннер',
		]);

		$options
			->addImage('news_banner', [
				'label' => '',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'return_format' => 'array',
				'preview_size' => 'meduim',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			])

			->setLocation('post_type', '==', 'news');

		acf_add_local_field_group($options->build());
	});
