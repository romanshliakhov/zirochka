<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_team( $layout_name ) {

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
            ->addText('editor', [
                'label' => 'Section Title',
                'wrapper' => [
                    'width' => '100',
                ],
            ])
			->addRepeater('team', [
				'label'        => __('Team', 'ACF'),
				'button_label' => __('Add Member', 'ACF'),
				'required' => 1,
				'layout' => 'block',
				'wrapper' => [
					'width' => '',
					'class' => 'col-2',
					'id' => '',
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
            ->addGroup('team_group', [
                'label' => false,
                'wrapper' => [
                    'width' => '60',
                ],
            ])
            ->addText('name', [
                'label' => 'Name',
                'wrapper' => [
                    'width' => '100',
                ],
            ])
            ->addText('role', [
                'label' => 'Position',
                'wrapper' => [
                    'width' => '100',
                ],
            ])
            ->endGroup()
			->endRepeater();

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

