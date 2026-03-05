<?php
	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action('acf/init', function () {
		if (!function_exists('acf_add_local_field_group')) return;

		if (function_exists('acf_add_options_page')) {
			acf_add_options_sub_page( array(
				'page_title'  => __( 'Footer settings', THEME_SLUG ),
				'menu_title'  => __( 'Footer', THEME_SLUG ),
				'parent_slug' => 'themes.php',
				'menu_slug'   => 'footer',
				'post_id'     => 'footer'
			) );
		}

		$options = new FieldsBuilder('footer_options');

		$options
			->addGroup('footer', [
				'label' => 'Footer settings',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'layout' => 'block'
			])
				->addTab('footer_tab_1', [
					'label' => 'Адресна інформація',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => [],
					'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
					],
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'placement' => 'left',
				])
					->addLink('location_link', [
						'label' => 'Адреса',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => [],
						'wrapper' => [
						'width' => '100',
						'class' => '',
						'id' => '',
						],
						'return_format' => 'array',
					])
				->addTab('footer_tab_2', [
					'label' => 'Текст для Політики Конфіденційності',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => [],
					'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
					],
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'placement' => 'left',
				])
					->addWysiwyg('footer_text', [
						'label' => '',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => [],
						'wrapper' => [
							'width' => '100',
							'class' => '',
							'id' => '',
						],
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					])
				->addTab('footer_tab_3', [
					'label' => 'Наші Партнери',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => [],
					'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
					],
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'placement' => 'left',
				])
					->addRepeater( 'partners', [
						'label'        => 'Наші партнери',
						'button_label' => __( 'Додати парнера', 'ACF' ),
						'layout'       => 'block'
					] )
						->addImage('partners_image', [
							'label' => 'Лого партнера',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => [],
							'wrapper' => [
								'width' => '50',
								'class' => '',
								'id' => '',
							],
							'return_format' => 'array',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						])
						->addLink('partners_link', [
							'label' => 'Посилання на партнера',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => [],
							'wrapper' => [
							'width' => '50',
							'class' => '',
							'id' => '',
							],
							'return_format' => 'array',
						])
					->endRepeater()
			->endGroup();

		$options->setLocation('options_page', '==', 'footer');

		acf_add_local_field_group($options->build());
	});
