<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_selected( $layout_name ) {

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

            ->addRelationship('selected_articles', [
                'label'         => __('Вибір редакції', 'ACF'),
                'post_type'     => ['articles'],
                'filters'       => ['search', 'post_type'],
                'elements'      => ['post_type', 'title'],
                'max'           => '4',
                'min'           => '4',
                'return_format' => 'id',
                'wrapper'       => ['width' => '100'],
            ])
        ;

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

