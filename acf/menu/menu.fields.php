<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action( 'acf/init', function () {

		$options = new FieldsBuilder( 'navigation', [
			'style' => 'seamless',
		] );

		$options
			->addImage( 'icon', [
				'label'        => 'Menu Icon',
				'instructions' => 'Select menu icon',
				'required'     => 0,
			] );


		$options->setLocation( 'nav_menu_item', '==', 'all' );

		acf_add_local_field_group( $options->build() );
	} );


