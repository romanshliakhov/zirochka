<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_tags( $layout_name ) {

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
                    'width' => '50',
                ],
            ])
            ->addLink('link', [
                'label' => 'Section all link',
                'wrapper' => [
                    'width' => '50',
                ],
            ])
        ;

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

