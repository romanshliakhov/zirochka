<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_donate( $layout_name ) {

		$layout = new FieldsBuilder( $layout_name );
		$layout
			->addTrueFalse( 'shower', [
				'label'             => __( 'Hide section?', 'ACF' ),
				'instructions'      => __( 'Activate to hide the block.', 'ACF' ),
				'required'          => 0,
				'conditional_logic' => [],
				'wrapper'           => [
					'width' => '100',
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'Hide', 'ACF' ),
				'ui_off_text'       => __( 'Show', 'ACF' ),
			] )

            ->addText('editor', [
                'label' => 'Section Title',
                'wrapper' => [
                    'width' => '100',
                ],
            ])

			->addRepeater('list', [
                'label' => false,
                'wrapper' => [
                    'class' => 'col-3'
                ],
                'layout' => 'block',
                'button_label' => 'Add item',
			])
                ->addImage('image', [
                    'label'   => __('Image', 'ACF'),
                    'wrapper' => [
                        'width' => '100',
                        'class' => '',
                        'id' => '',
                    ],
                ])
				->addText('title', [
					'label' => 'Title',
					'instructions' => '',
					'required' => 0,
					'wrapper' => [
						'width' => '100',
						'class' => '',
						'id' => '',
					],
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				])
				->addTextarea('description', [
					'label' => 'Description',
					'instructions' => '',
					'required' => 0,
					'wrapper' => [
						'width' => '',
						'class' => '',
						'id' => '',
					],
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '4',
					'new_lines' => '', // Possible values are 'wpautop', 'br', or ''.
				])
                ->addLink('link', [
                    'label' => 'Card Link',
                    'return_format' => 'array',
                ])
			->endRepeater();

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

