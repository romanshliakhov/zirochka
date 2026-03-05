<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_premium_materials( $layout_name ) {

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
			->addRepeater('list', [
				'label'        => __('List', 'ACF'),
				'button_label' => __('Add List Item', 'ACF'),
				'instructions' => '',
        		'required' => 1,
				'min' => 3,
        		'max' => '',
				'layout' => 'block',
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
			])
				->addFile('model_file', [
					'label' => '3D Model',
					'instructions' => '',
					'required' => 0,
					'wrapper' => ['width' => '50'],
					'return_format' => 'array',
					'library' => 'all',
					'mime_types' => 'glb', // ✅ добавлено
				])
				->addText('model_scale', [
					'label' => 'Model Scale',
					'instructions' => 'Введите одно число, например 1.5',
					'required' => 0,
					'wrapper' => [
						'width' => '50',
					],
					'default_value' => '1',
					'placeholder' => '1',
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
			->endRepeater();
	

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

