<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_additional_default( $layout_name ) {

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
			->addText('label', [
				'label' => 'Label field',
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
			->addImage('image', [
				'label' => __( 'Image', 'ACF' ),
				'instructions' => 'Add image',
				'required' => 1,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => 100/3,
					'class' => 'admin-background-image',
					'id' => '',
				],
				'return_format' => 'array',
				'preview_size' => 'large',
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
			]);


		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

