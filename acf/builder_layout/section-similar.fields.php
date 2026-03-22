<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_similar( $layout_name ) {

		$layout = new FieldsBuilder( $layout_name );
		$layout
			->addTrueFalse( 'shower', [
				'label'             => __( 'Hide section?', 'ACF' ),
				'instructions'      => __( 'Activate to hide the block.', 'ACF' ),
				'required'          => 0,
				'conditional_logic' => [],
				'wrapper'           => [
					'width' => '50',
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

            ->addRelationship('selected_articles', [
                'label'         => __('Вибір матеріала', 'ACF'),
                'post_type'     => ['articles','blog'],
                'filters'       => ['search', 'post_type'],
                'elements'      => ['post_type', 'title'],
                'min'           => '3',
                'max'           => '3',
                'return_format' => 'id',
                'wrapper'       => ['width' => '100'],
            ])
			;

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}