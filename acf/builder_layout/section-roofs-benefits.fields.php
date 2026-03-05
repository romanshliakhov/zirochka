<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_roofs_benefits( $layout_name ) {

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
					'width' => '65',
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
				'label' => 'Media Content',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => '35',
					'class' => '',
					'id' => '',
				],
				'return_format' => 'array',
				'preview_size' => 'large',
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
				->addImage('icon', [
					'label' => 'Icon Field',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => [],
					'wrapper' => [
						'width' => 100 / 3,
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
				->addText('heading', [
					'label' => 'Red Text Field',
					'instructions' => '',
					'required' => 0,
					'wrapper' => [
						'width' => 100 / 3,
						'class' => '',
						'id' => '',
					],
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				])
				->addText('text', [
					'label' => 'Text Field',
					'instructions' => '',
					'required' => 0,
					'wrapper' => [
						'width' => 100 / 3,
						'class' => '',
						'id' => '',
					],
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				])
			->endRepeater();
	

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

