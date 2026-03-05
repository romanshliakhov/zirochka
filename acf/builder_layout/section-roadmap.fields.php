<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_roadmap( $layout_name ) {

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
			->addTrueFalse( 'background_color', [
				'label'             => __( 'Transparent?', 'ACF' ),
				'instructions'      => __( 'Activate if yes.', 'ACF' ),
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
				'ui_on_text'        => __( 'Tranparent', 'ACF' ),
				'ui_off_text'       => __( 'With lines', 'ACF' ),
			] )
			->addWysiwyg('editor', [
				'label' => 'WYSIWYG Field',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => '100',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1,
				'delay' => 0,
			])
			->addRepeater('items', [
				'label'        => __('Roadmap Timeline', 'ACF'),
				'button_label' => __('Add Timeline Item', 'ACF'),
				'instructions' => '',
        		'required' => 1,
				'min' => '2',
        		'max' => '',
				'layout' => 'block',
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
			])
				->addText('counter', [
					'label' => 'Timeline Counter Field',
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
				->addImage('image', [
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

