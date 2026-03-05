<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_additional_colors( $layout_name ) {

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
			->addRepeater( 'colors', [
				'label'        => __( 'Colors Variants', 'ACF' ),
				'button_label' => __( 'Add Colors Vars', 'ACF' ),
				'layout'       => 'block'
			] )
				->addImage('color_image', [
					'label' => 'Color Image',
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
				->addText( 'color_title', [
					'label'        => __( 'Color Title', 'ACF' ),
					'instructions' => '',
					'required'     => 1,
					'wrapper' => [
						'width' => 100 / 3,
						'class' => '',
						'id' => '',
					],
				])
			->endRepeater();

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}