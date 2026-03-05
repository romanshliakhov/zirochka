<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_additional_info( $layout_name ) {

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
			] )
			->addWysiwyg('editor', [
				'label' => 'WYSIWYG Field',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => '65',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1,
				'delay' => 0,
			])
			->addGroup('media_content', [
				'label' => '',
				'layout' => 'block',
				'wrapper' => [
					'width' => '35',
				],
			])
				->addTrueFalse('media_switcher', [
					'label'         => __('Image or Video?', 'ACF'),
					'ui'            => 1,
					'default_value' => 0,
					'ui_on_text'    => __('Video', 'ACF'),
					'ui_off_text'   => __('Image', 'ACF'),
				])
				->addImage('image', [
					'label'            => 'Image',
					'return_format'    => 'array',
					'preview_size'     => 'large',
					'conditional_logic'=> [
						[
							[
								'field'    => 'media_switcher',
								'operator' => '==',
								'value'    => '0',
							],
						],
					],
				])
				->addImage('poster', [
					'label'            => 'Poster Image',
					'return_format'    => 'array',
					'preview_size'     => 'large',
					'conditional_logic'=> [
						[
							[
								'field'    => 'media_switcher',
								'operator' => '==',
								'value'    => '1',
							],
						],
					],
				])
				->addText('video_link', [
					'label'            => 'Video Youtube link',
					'instructions' => '',
					'required' => 0,
					'wrapper' => [
						'width' => '',
						'class' => '',
						'id' => '',
					],
					'conditional_logic'=> [
						[
							[
								'field'    => 'media_switcher',
								'operator' => '==',
								'value'    => '1',
							],
						],
					],
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				])
			->endGroup();

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}

