<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_colors( $layout_name ) {

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
			->addRepeater( 'tabs', [
				'label'        => __( 'Tabs', 'ACF' ),
				'button_label' => __( 'Add tab', 'ACF' ),
				'layout'       => 'block'
			] )
				->addText( 'tab_name', [
					'label'        => __( 'Tab name', 'ACF' ),
					'instructions' => '',
					'required'     => 1,
					'wrapper' => [
						'width' => '100',
						'class' => '',
						'id' => '',
					],
				])
				->addRepeater( 'colors_group', [
					'label'        => __( 'Colors Group', 'ACF' ),
					'button_label' => __( 'Add Colors Group', 'ACF' ),
					'layout'       => 'block'
				] )
					->addText( 'colors_group_title', [
						'label'        => __( 'Colors Group Title', 'ACF' ),
						'instructions' => '',
						'required'     => 0,
						'wrapper' => [
							'width' => '80',
							'class' => '',
							'id' => '',
						],
					])
					->addText( 'colors_group_rows', [
						'label'        => __( 'Group rows', 'ACF' ),
						'instructions' => 'Type number for colors rows',
						'required'     => 0,
						'wrapper' => [
							'width' => '20',
							'class' => '',
							'id' => '',
						],
					])
					->addRepeater( 'colors_vars', [
						'label'        => __( 'Colors Variants', 'ACF' ),
						'button_label' => __( 'Add Colors Vars', 'ACF' ),
						'layout'       => 'block'
					] )
						->addText( 'color_label', [
							'label'        => __( 'Color Label', 'ACF' ),
							'instructions' => 'Insert if needed',
							'required'     => 0,
							'wrapper' => [
								'width' => 100 / 3,
								'class' => '',
								'id' => '',
							],
						])
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
					->endRepeater()
				->endRepeater()
			->endRepeater();

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}