<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_top( $layout_name ) {

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
			->addTrueFalse( 'breadcrumbs', [
				'label'             => __( 'Show breadcrumbs?', 'ACF' ),
				'instructions'      => __( 'Activate to show the breadcrumbs.', 'ACF' ),
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
				'ui_on_text'        => __( 'Show', 'ACF' ),
				'ui_off_text'       => __( 'Hide', 'ACF' ),
			] )
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
			->addText('title', [
				'label'             => 'Title',
				'required'          => 0,
				'wrapper'           => [ 'width' => '100', ],
				'conditional_logic' => [
					[
						[
							'field'    => 'label',
							'operator' => '==',
							'value'    => '1',
						]
					]
				],
			]);

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}
