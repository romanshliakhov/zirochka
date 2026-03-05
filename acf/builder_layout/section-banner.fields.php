<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_banner( $layout_name ) {

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
			] )
			->addFile('video_desktop', [
				'label' => 'Desktop Video',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => 100 / 3,
					'class' => '',
					'id' => '',
				],
				'return_format' => 'array',
				'library' => 'all',
				'min_size' => '',
				'max_size' => '',
				'mime_types' => '',
			])
			->addFile('video_mobile', [
				'label' => 'Mobile video',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => 100 / 3,
					'class' => '',
					'id' => '',
				],
				'return_format' => 'array',
				'library' => 'all',
				'min_size' => '',
				'max_size' => '',
				'mime_types' => '',
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
			]);

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

