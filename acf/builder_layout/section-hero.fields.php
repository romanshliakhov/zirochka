<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_hero( $layout_name ) {

		$layout = new FieldsBuilder( $layout_name );
		$layout
			->addTrueFalse( 'shower', [
				'label'             => __( 'Hide section?', 'ACF' ),
				'instructions'      => __( 'Activate to hide the block.', 'ACF' ),
				'required'          => 0,
				'conditional_logic' => [],
				'wrapper'           => [
					'width' => 50,
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'Hide', 'ACF' ),
				'ui_off_text'       => __( 'Show', 'ACF' ),
			] )

            ->addFlexibleContent('hero_section', [
                'label'        => __('Editors', 'ACF'),
                'button_label' => __('Add Section', 'ACF'),
                'max'    => 1,
            ])
            ->addLayout('hero_1', [
                'label'   => __('HERO №1', 'ACF'),
                'display' => 'block',
            ])
            ->addText('editor', [
                'label' => 'Section Title',
                'wrapper' => [
                    'width' => '100',
                ],
            ])
            ->addRelationship('selected_articles', [
                'label'         => __('Вибір редакції', 'ACF'),
                'post_type'     => ['articles', 'books','blog'],        // здесь выбираем только CPT
                'filters'       => ['search', 'post_type'],
                'elements'      => ['post_type', 'title'],
                'max'           => 1,
                'return_format' => 'id',
                'wrapper'       => ['width' => '100'],
            ])

            ->addLayout('hero_2', [
                'label'   => __('HERO №2', 'ACF'),
                'display' => 'block',
            ])

            ->addWysiwyg('editor', [
                'label' => false,
                'media_upload' => 0,
                'toolbar' => 'based',
                'wrapper' => [
                    'width' => '60',
                ],
            ])

            ->addImage('image', [
                'label'   => __('Image', 'ACF'),
                'wrapper' => [
                    'width' => '40',
                    'class' => '',
                    'id' => '',
                ],
            ])

            ->addLayout('hero_3', [
                'label'   => __('HERO №3 Small', 'ACF'),
                'display' => 'block',
            ])

            ->addWysiwyg('editor', [
                'label' => false,
                'media_upload' => 0,
                'toolbar' => 'based',
                'wrapper' => [
                    'width' => '60',
                ],
            ])

            ->addImage('image', [
                'label'   => __('Image', 'ACF'),
                'wrapper' => [
                    'width' => '40',
                    'class' => '',
                    'id' => '',
                ],
            ])

            ->addLayout('hero_4', [
                'label'   => __('HERO №4 Organization', 'ACF'),
                'display' => 'block',
            ])

            ->addWysiwyg('editor', [
                'label' => false,
                'media_upload' => 0,
                'toolbar' => 'based',
                'wrapper' => [
                    'width' => '60',
                ],
            ])

            ->addImage('image', [
                'label'   => __('Image', 'ACF'),
                'wrapper' => [
                    'width' => '40',
                    'class' => '',
                    'id' => '',
                ],
            ])

            ->endFlexibleContent()
        ;
		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

