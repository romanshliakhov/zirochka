<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_types( $layout_name ) {

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
			->addRepeater( 'estate_types', [
				'label'        => __( 'Типи Нерухомості', 'ACF' ),
				'button_label' => __( 'Додати Тип Нерухомості', 'ACF' ),
				'instructions' => '',
        		'required' => 1,
				'min' => '1',
        		'max' => '',
				'layout' => 'block',
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
			] )
				->addText( 'heading', [
					'label'        => __( 'Назва Нерухомості', 'ACF' ),
					'instructions' => '',
					'required'     => 0,
					'wrapper' => [
						'width' => '',
						'class' => '',
						'id' => '',
					],
				])
				->addImage('image', [
					'label' => __( 'Фонове зображення', 'ACF' ),
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => [],
					'wrapper' => [
						'width' => '',
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
			->endRepeater();

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}
