<?php
	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_map( $layout_name ) {
		$layout = new FieldsBuilder( $layout_name );
		$layout
			->addTrueFalse( 'shower', [
				'label'             => __( 'Hide section?', 'ACF' ),
				'instructions'      => __( 'Activate to hide the block.', 'ACF' ),
				'required'          => 0,
				'conditional_logic' => [],
				'wrapper'           => [
					'width' => 100,
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'Hide', 'ACF' ),
				'ui_off_text'       => __( 'Show', 'ACF' ),
			] )
			->addRepeater('list', [
				'label'        => __('Locations', 'ACF'),
				'button_label' => __('Add New Town Contacts details', 'ACF'),
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
			])
				->addText( 'lat', [
					'label'        => __( 'Latitude' ),
					'instructions' => '',
					'required'     => 0,
					'wrapper' => [
						'width' => '50',
						'class' => '',
						'id' => '',
					],
				])
				->addText( 'lng', [
					'label'        => __( 'Longitude' ),
					'instructions' => '',
					'required'     => 0,
					'wrapper' => [
						'width' => '50',
						'class' => '',
						'id' => '',
					],
				])
				->addText( 'loc', [
					'label'        => __( 'Location' ),
					'instructions' => '',
					'required'     => 0,
					'wrapper' => [
						'width' => '',
						'class' => '',
						'id' => '',
					],
				])
				->addLink('tel', [
					'label' => 'Phone number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => [],
					'wrapper' => [
						'width' => '',
						'class' => '',
						'id' => '',
					],
					'return_format' => 'array',
				])
				->addLink('email', [
					'label' => 'Email',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => [],
					'wrapper' => [
						'width' => '',
						'class' => '',
						'id' => '',
					],
					'return_format' => 'array',
				])
			->endRepeater();

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}
