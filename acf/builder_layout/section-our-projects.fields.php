<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_our_projects( $layout_name ) {

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
			])
				->addText( 'tab_name', [
					'label'        => __( 'Tab name', 'ACF' ),
					'instructions' => '',
					'required'     => 1,
					'wrapper' => [
						'width' => '',
						'class' => '',
						'id' => '',
					],
				])
				->addRelationship('posts', [
					'label' => 'Select your projects',
					'instructions' => '',
					'post_type' => ['projects'],
					'filters' => ['search'],
					'min' => '4',
					'max' => '',
					'return_format' => 'id',
				])
			->endRepeater();


		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

