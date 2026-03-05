<?php
	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action('acf/init', function () {
		$options = new FieldsBuilder('teams_info', [
			'title' => 'Посада члена команди',
		]);

		$options
			->addText('member_role', [
				'label' => '',
				'instructions' => '',
				'required' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			])

			->setLocation('post_type', '==', 'teams');

		acf_add_local_field_group($options->build());
	});
