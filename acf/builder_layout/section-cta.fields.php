<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_cta( $layout_name ) {

		$layout = new FieldsBuilder( $layout_name );
		$layout
			->addTrueFalse( 'shower', [
				'label'             => __( 'Hide section?', 'ACF' ),
				'instructions'      => __( 'Activate to hide the block.', 'ACF' ),
				'required'          => 0,
				'conditional_logic' => [],
				'wrapper'           => [
					'width' => 100 / 3,
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'Hide', 'ACF' ),
				'ui_off_text'       => __( 'Show', 'ACF' ),
			])
			->addImage('image', [
				'label' => 'Background Image',
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
			->addWysiwyg('editor', [
				'label'        => '',
				'instructions' => 'Add slide content here.',
				'wrapper'      => [
					'width' => '100%',
					'class' => '',
					'id'    => '',
				],
				'tabs'         => 'visual',
				'toolbar'      => 'all',
				'media_upload' => 0,
			])
			->addLink('link', [
				'label' => 'Посилання',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'return_format' => 'array',
			]);

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

