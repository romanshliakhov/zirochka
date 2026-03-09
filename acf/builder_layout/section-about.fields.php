<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_about( $layout_name ) {

		$layout = new FieldsBuilder( $layout_name );
		$layout
			->addTrueFalse( 'shower', [
				'label'             => __( 'Hide section?', 'ACF' ),
				'instructions'      => __( 'Activate to hide the block.', 'ACF' ),
				'required'          => 0,
				'conditional_logic' => [],
				'wrapper'           => [
					'width' => 100 / 2,
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'Hide', 'ACF' ),
				'ui_off_text'       => __( 'Show', 'ACF' ),
			] )

            ->addText('title', [
                'label' => 'Section Title',
                'wrapper' => [
                    'width' => '100',
                ],
            ])
            ->addImage('bg', [
                'label' => 'Background image',
                'return_format' => 'array',
                'wrapper' => [
                    'width' => '25',
                ]
            ])
            ->addWysiwyg( 'editor', [
                'label'        => false,
                'media_upload' => 0,
                'delay'        => 0,
                'wrapper' => [
                    'width' => '75',
                ]
            ] )
        ;
		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}
