<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action( 'acf/init', function () {

		$options = new FieldsBuilder( 'modals' );

		$options
			->addFlexibleContent( 'modals_layout', [
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => [],
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'button_label'      => 'Add Banner',
				'min'               => '1',
				'max'               => '1',
			] )
			->addLayout( 'editors', [
				'label'   => 'Modal',
				'display' => 'block',
				'min'     => '',
				'max'     => '',
			])
				->addFields(editors(1))

			->addLayout( 'custom', [
				'label'   => 'СTA №1',
				'display' => 'table',
				'min'     => '',
				'max'     => '',
			])
				->addFields(editors(1))
			->endFlexibleContent();


		$options->setLocation( 'post_type', '==', 'modals' );

		acf_add_local_field_group( $options->build() );
	} );


