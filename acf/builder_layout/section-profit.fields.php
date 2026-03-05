<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_profit( $layout_name ) {

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
			->addWysiwyg('editor_top', [
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
			->addGroup('timeline_top', [
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
					'width' => '100',
					'class' => '',
					'id' => '',
				],
				'layout' => 'block'
			])
				->addText('tml_top_start',[
					'label'             => '',
					'instructions'      => __( 'Metal Number', 'ACF' ),
					'wrapper'           => [
						'width' => 100 / 2,
						'class' => '',
						'id'    => '',
					],
				])
				->addText('tml_top_end',[
					'label'             => '',
					'instructions'      => __( 'After 50 years', 'ACF' ),
					'wrapper'           => [
						'width' => 100 / 2,
						'class' => '',
						'id'    => '',
					],
				])
			->endGroup()
			->addWysiwyg('editor_bot', [
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
			->addGroup('timeline_bot', [
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
					'width' => '100',
					'class' => '',
					'id' => '',
				],
				'layout' => 'block'
			])
				->addText('tml_bot_start',[
					'label'             => '',
					'instructions'      => __( 'No Metal', 'ACF' ),
					'wrapper'           => [
						'width' => 100 / 5,
						'class' => '',
						'id'    => '',
					],
				])
				->addText('tml_bot_step1',[
					'label'             => '',
					'instructions'      => __( 'Step 1', 'ACF' ),
					'wrapper'           => [
						'width' => 100 / 5,
						'class' => '',
						'id'    => '',
					],
				])
				->addText('tml_bot_step2',[
					'label'             => '',
					'instructions'      => __( 'Step 2', 'ACF' ),
					'wrapper'           => [
						'width' => 100 / 5,
						'class' => '',
						'id'    => '',
					],
				])
				->addText('tml_bot_step3',[
					'label'             => '',
					'instructions'      => __( 'Step 3', 'ACF' ),
					'wrapper'           => [
						'width' => 100 / 5,
						'class' => '',
						'id'    => '',
					],
				])
				->addText('tml_bot_end',[
					'label'             => '',
					'instructions'      => __( 'After 50 years', 'ACF' ),
					'wrapper'           => [
						'width' => 100 / 5,
						'class' => '',
						'id'    => '',
					],
				])
			->endGroup();

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

