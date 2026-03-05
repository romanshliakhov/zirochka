<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_additional_green( $layout_name ) {

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
			->addWysiwyg( 'editor', [
				'label'        => '',
				'instructions' => '',
				'wrapper'      => [
					'width' => '100',
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
				'min' => 1,
        		'max' => '',
				'layout' => 'block',
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
			])		
				->addWysiwyg('editor', [
					'label' => 'WYSIWYG Field',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => [],
					'wrapper' => [
						'width' => '70',
						'class' => '',
						'id' => '',
					],
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
				])
				->addImage('item_image', [
                    'label' => 'Image',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '30',
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
			->endRepeater();

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

