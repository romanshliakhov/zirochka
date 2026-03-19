<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_books( $layout_name ) {

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
                'label' => 'Section link',
                'wrapper' => [
                    'width' => '50',
                ],
            ])
            ->addRelationship('books', [
                'label' => 'Книги',
                'instructions' => 'Оберіть за потреби книгу зі списку, якщо будуть не вибрані, то просто останні по даті',
                'post_type' => ['books'],
                'filters' => [
                    0 => 'search',
                    1 => '',
                    2 => '',
                ],
                'min' => '0',
                'max' => '',
                'return_format' => 'id',
            ])
        ;
        ;

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

