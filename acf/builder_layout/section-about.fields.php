<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_about( $layout_name ) {

		$layout = new FieldsBuilder( $layout_name );
		$layout
			->addTrueFalse( 'shower', [
				'label'             => __( 'Hide section?', 'ACF' ),
				'instructions'      => __( 'Activate to hide the block.', 'ACF' ),
				'required'          => 0,
				'conditional_logic' => [],
				'wrapper'           => [
					'width' => 100 / 2,
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
					'width' => 100 / 2,
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'Show', 'ACF' ),
				'ui_off_text'       => __( 'Hide', 'ACF' ),
			] )

			->addRepeater('slider', [
				'label'        => __('Slide', 'ACF'),
				'button_label' => __('Add Slide Item', 'ACF'),
				'wrapper'       => [ 
					'class' => 'about-slider', // добавим класс
				],
				'required'     => 1,
				'min'          => 2,
				'layout'       => 'block',
			])
				->addGroup('left', [
					'label'    => '',
					'required' => 0,
					'wrapper'  => [
						'width' => '100',
					],
					'layout' => 'block',
					])
					->addImage('image', [
						'label'         => 'Desktop Background Image',
						'required'      => 0,
						'return_format' => 'array',
						'preview_size'  => 'thumbnail',
						'library'       => 'all',
						'wrapper'       => [ 'width' => '30' ],
					])
					->addImage('image_mob', [
						'label'         => 'Mobile Background Image',
						'required'      => 0,
						'return_format' => 'array',
						'preview_size'  => 'thumbnail',
						'library'       => 'all',
						'wrapper'       => [ 'width' => '30' ],
					])
					->addWysiwyg('editor', [
						'label' => '',
						'instructions' => 'Add slide content here.',
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
				->endGroup()

				->addTrueFalse('label', [
					'label'         => __('Show directors label?', 'ACF'),
					'instructions'  => __('Only works on the first slide', 'ACF'),
					'default_value' => 1,
					'ui'            => 1,
					'wrapper'       => [ 
						'width' => '20',
						'class' => 'show-label-toggle',
					],
					'ui_on_text'    => __('Show', 'ACF'),
					'ui_off_text'   => __('Hide', 'ACF'),
				])
				->addText('role', [
					'label'             => 'Role Field',
					'required'          => 0,
					'wrapper'           => [ 'width' => '40' ],
					'conditional_logic' => [
						[
							[
								'field'    => 'label',
								'operator' => '==',
								'value'    => '1',
							]
						]
					],
				])
				->addText('name', [
					'label'             => 'Name Field',
					'required'          => 0,
					'wrapper'           => [ 'width' => '40' ],
					'conditional_logic' => [
						[
							[
								'field'    => 'label',
								'operator' => '==',
								'value'    => '1',
							]
						]
					],
				])
		->endRepeater();


		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}
