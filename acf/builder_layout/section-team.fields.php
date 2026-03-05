<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_team( $layout_name ) {

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
			])
			->addWysiwyg( 'editor', [
				'label'        => '',
				'instructions' => '',
				'wrapper'      => [
					'width' => '100%',
					'class' => '',
					'id'    => '',
				],
				'tabs'         => 'visual',
				'toolbar'      => 'all',
				'media_upload' => 0,
			])
			->addRepeater('team', [
				'label'        => __('Team', 'ACF'),
				'button_label' => __('Add Member', 'ACF'),
				'instructions' => '',
				'required' => 1,
				'min' => 4,
				'max' => '',
				'layout' => 'block',
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
					],
				])
				->addImage('image', [
					'label' => 'Icon Field',
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
				->addText('role', [
					'label' => 'Position Field',
					'instructions' => '',
					'required' => 0,
					'wrapper' => [
						'width' => '35',
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
					'label' => 'Name Field',
					'instructions' => '',
					'required' => 0,
					'wrapper' => [
						'width' => '35',
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

