<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_financial( $layout_name ) {

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
			->addRepeater('slides', [
				'label'        => __('Slides', 'ACF'),
				'button_label' => __('Add Slide Item', 'ACF'),
				'instructions' => '',
        		'required' => 1,
				'min' => '3',
        		'max' => '',
				'layout' => 'block',
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
			])
				->addImage('icon', [
					'label' => 'Icon',
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
					'label' => 'Heading Field',
					'instructions' => '',
					'required' => 0,
					'wrapper' => [
						'width' => '50',
						'class' => '',
						'id' => '',
					],
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				])
				->addText('name', [
					'label' => 'Slide Title',
					'instructions' => '',
					'required' => 0,
					'wrapper' => [
						'width' => '50',
						'class' => '',
						'id' => '',
					],
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				])
				->addTextarea('description', [
					'label' => 'Description Field',
					'instructions' => '',
					'required' => 0,
					'wrapper' => [
						'width' => '50',
						'class' => '',
						'id' => '',
					],
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '2',
					'new_lines' => '', // Possible values are 'wpautop', 'br', or ''.
				])
			->endRepeater();

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

