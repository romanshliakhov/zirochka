<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_socials( $layout_name ) {

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
			])
            ->addTrueFalse( 'shower_2', [
                'label'             => __( 'Public organization ?', 'ACF' ),
                'instructions'      => __( 'Activate to Public organization the block.', 'ACF' ),
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
                'ui_on_text'        => __( 'False', 'ACF' ),
                'ui_off_text'       => __( 'True', 'ACF' ),
            ])
            ->addText('editor', [
                'label' => 'Section Title',
                'wrapper' => [
                    'width' => '100',
                ],
            ])
			;
		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

