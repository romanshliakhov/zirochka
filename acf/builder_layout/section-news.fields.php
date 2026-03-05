<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function section_news( $layout_name ) {

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
			] )
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
			->addRelationship('news', [
				'label' => 'Найбільш актуальні новини',
				'instructions' => 'Оберіть за потрепи новину зі списку, якщо будуть не вибрані, то просто останні по даті новини',
				'post_type' => ['news'],
				'filters' => [
					0 => 'search',
					1 => '',
					2 => '',
				],
				'min' => '0',
				'max' => '',
				'return_format' => 'id',
			])
			->addLink('link', [
				'label' => 'Посилання',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'return_format' => 'array',
			]);

		return [
			'layout'  => $layout,
			'display' => 'block',
		];
	}