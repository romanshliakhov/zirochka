<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_gift( $layout_name ) {

		$layout = new FieldsBuilder( $layout_name );

		$layout
			->addTrueFalse( 'shower', [
				'label'             => __( 'Hide section?', 'ACF' ),
				'instructions'      => __( 'Activate to hide the block.', 'ACF' ),
				'required'          => 0,
				'conditional_logic' => [],
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'Hide', 'ACF' ),
				'ui_off_text'       => __( 'Show', 'ACF' ),
			])

            ->addGroup('left', [
				'label' => '',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [
					[
						'field'    => '',
						'operator' => '==',
						'value'    => '0',
					]
				],
				'wrapper' => [
					'width' => '60',
					'class' => '',
					'id' => '',
				],
				'layout' => 'block'
			])			
                ->addImage('icon', [
                    'label' => 'Icon Image',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '',
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
				->addWysiwyg( 'editor', [
					'label'        => '',
					'instructions' => '',
					'wrapper'      => [
						'width' => '100%',
						'class' => '',
						'id'    => '',
					],
					'tabs'         => 'visual',
					'toolbar'      => 'all',
					'media_upload' => 0,
				])
                ->addRepeater('list', [
                    'label'        => __('List', 'ACF'),
                    'button_label' => __('Add List Item', 'ACF'),
                    'instructions' => '',
                    'required' => 0,
                    'min' => 3,
                    'max' => '',
                    'layout' => 'block',
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                        ],
                    ])
                    ->addImage('icon', [
                        'label' => 'Icon Field',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => [],
                        'wrapper' => [
                            'width' => '20',
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
                    ->addText('text', [
                        'label' => 'Text Field',
                        'instructions' => '',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '80',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ])
			    ->endRepeater()

				->addLink('link', [
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
				])
			->endGroup()

			->addImage('image', [
				'label' => 'Desktop Background Image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => '40',
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
			]);

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

