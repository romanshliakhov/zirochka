<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_contacts( $layout_name ) {

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

			->addGroup('left', [
				'label' => '',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [
					[
						'field'    => '',
						'operator' => '==',
						'value'    => '0',
					]
				],
				'wrapper' => [
					'width' => '50',
					'class' => '',
					'id' => '',
				],
				'layout' => 'block'
			])
				->addWysiwyg('editor', [
					'label' => 'Лівий текстовий блок',
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
			->endGroup()

			->addGroup('right', [
				'label' => '',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [
					[
						'field'    => '',
						'operator' => '==',
						'value'    => '0',
					]
				],
				'wrapper' => [
					'width' => '50',
					'class' => '',
					'id' => '',
				],
				'layout' => 'block'
			])
				->addWysiwyg('editor_form', [
					'label' => '',
					'instructions' => 'Оберіть контакту форму',
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

			->addTrueFalse( 'map_shower', [
				'label'             => __( 'Map?', 'ACF' ),
				'instructions'      => __( 'Activate to hide the block.', 'ACF' ),
				'required'          => 0,
				'conditional_logic' => [],
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 1,
				'ui'                => 1,
				'ui_on_text'        => __( 'Active', 'ACF' ),
				'ui_off_text'       => __( 'Hide', 'ACF' ),
			])
			->addWysiwyg('editor_map', [
				'label' => '',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [
					[
						[
							'field'    => 'map_shower',
							'operator' => '==',
							'value'    => '1',
						],
					],
				],
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
