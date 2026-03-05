<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	function shortcode_select(string $width = '100', array $choices = []): FieldsBuilder {
		$field = new FieldsBuilder('get_shortcode_field');

		$field
			->addSelect('get_shortcode', [
				'label'        => __('Add shortcode', 'ACF'),
				'instructions' => '',
				'required'     => 0,
				'choices'      => $choices,
				'default_value' => [],
				'wrapper'      => [
					'width' => $width,
					'class' => '',
					'id'    => '',
				],
			]);

		return $field;
	}
