<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function stars_select(string $width = '100', array $choices = []): FieldsBuilder {
		$field = new FieldsBuilder('stars_field');

		$field
			->addSelect('stars', [
				'label' => 'Select stars',
				'allow_null'     => 0,
				'wrapper'           => [
					'width' => $width,
					'class' => '',
					'id'    => '',
				]
			]);

		return $field;
	}

	add_filter('acf/load_field/name=stars', function ($field) {
		$field['choices'] = [
			'1' => '★',
			'2' => '★★',
			'3' => '★★★',
			'4' => '★★★★',
			'5' => '★★★★★',
		];
		$field['return_format'] = 'value';

		return $field;
	});
