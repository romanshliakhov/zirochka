<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_project_type( $layout_name ) {

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
			] )
			->addWysiwyg('editor_top', [
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
			->addRepeater('types', [
				'label'        => __('List', 'ACF'),
				'button_label' => __('Add List Item', 'ACF'),
				'instructions' => '',
        		'required' => 1,
				'min' => 1,
        		'max' => '',
				'layout' => 'block',
				'wrapper' => [
					'width' => '100',
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
						'width' => '60',
						'class' => '',
						'id' => '',
					],
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
				])
				->addFile('type_animation', [
					'label' => 'Insert video animation',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => [],
					'wrapper' => [
						'width' => '40',
						'class' => '',
						'id' => '',
					],
					'return_format' => 'array',
					'library' => 'all',
					'min_size' => '',
					'max_size' => '',
					'mime_types' => '',
				])
			->endRepeater();

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}
