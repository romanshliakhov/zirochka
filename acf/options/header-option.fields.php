<?php
	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action('acf/init', function () {
		if (!function_exists('acf_add_local_field_group')) return;

		if (function_exists('acf_add_options_page')) {
			acf_add_options_sub_page( array(
				'page_title'  => __( 'Header settings', THEME_SLUG ),
				'menu_title'  => __( 'Header', THEME_SLUG ),
				'parent_slug' => 'themes.php',
				'menu_slug'   => 'header',
				'post_id'     => 'header'
			) );
		}

		$options = new FieldsBuilder('header_options');

		$options
			->addGroup('header', [
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => '100',
					'class' => '',
					'id' => '',
				],
				'layout' => 'block'
			])
				->addImage('logo', [
					'label' => 'Site Logo',
					'wrapper' => [
						'width' => '50',
						'class' => '',
						'id' => '',
					],
				])
				->addLink('popup_link', [
					'label' => 'Поп-ап кнопка',
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
				->addGroup('header_contacts', [
					'label' => 'Header contacts',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => [],
					'wrapper' => [
						'width' => '100',
						'class' => '',
						'id' => '',
					],
					'layout' => 'block'
				])
					->addTab('contacts_tab_1', [
						'label' => 'Посилання на WhatsApp',
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
						'placement' => 'top',
					])	
						->addLink('whatsapp_rent', [
                            'label' => 'Оренда WhatsApp',
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
						->addLink('whatsapp_sell', [
                            'label' => 'Продажі WhatsApp',
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
					->addTab('contacts_tab_2', [
						'label' => 'Посилання на Telegram',
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
						'placement' => 'top',
					])	
						->addLink('telegram_rent', [
                            'label' => 'Оренда Telegram',
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
						->addLink('telegram_sell', [
                            'label' => 'Продажі Telegram',
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
					->addTab('contacts_tab_3', [
						'label' => 'Посилання на Viber',
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
						'placement' => 'top',
					])	
						->addText('viber_rent', [
							'label' => 'Оренда Viber',
							'instructions' => '',
							'required' => 0,
							'wrapper' => [
								'width' => '50',
								'class' => '',
								'id' => '',
							],
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						])
						->addText('viber_sell', [
							'label' => 'Продажі Viber',
							'instructions' => '',
							'required' => 0,
							'wrapper' => [
								'width' => '50',
								'class' => '',
								'id' => '',
							],
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						])
				->endGroup()
			->endGroup();

		$options->setLocation('options_page', '==', 'header');

		acf_add_local_field_group($options->build());
	});


