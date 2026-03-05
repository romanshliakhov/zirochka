<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action( 'acf/init', function () {
		$banner_info = new FieldsBuilder( 'banner_info', [
			'label' => 'Banner Info'
		] );

		$project_service = new FieldsBuilder( 'project_service', [
			'label' => 'Project Services'
		] );

		$location_block = new FieldsBuilder( 'location_block', [
			'label' => 'Location Block'
		] );

		$banner_info
			->addWysiwyg('post_editor', [
			    'label' => '',
			    'instructions' => '',
			    'required' => 0,
			    'conditional_logic' => [],
			    'wrapper' => [
			        'width' => '60',
			        'class' => '',
			        'id' => '',
			    ],
			    'default_value' => '',
			    'tabs' => 'full', // text or visual
			    'toolbar' => 'all', // all or basic
			    'media_upload' => 1,
			    'delay' => 0,
			])
			->addGallery('gallery', [
				'label' => 'Gallery Images',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => '40',
					'class' => '',
					'id' => '',
				],
				'return_format' => 'array',
				'min' => '',
				'max' => '',
				'insert' => 'append',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			]);

		$project_service
			->addPostObject('services_bind', [
				'label' => 'Select Services',
				'instructions' => 'Choose the services this project belongs to.',
				'required' => 1,
				'post_type' => ['services'], // CPT to select from
				'return_format' => 'id', // or 'object' if you prefer
				'multiple' => 0,
				'allow_null' => 0,
				'ui' => 1,
			]);

		$location_block
			->addPostObject('related_location', [
				'label' => 'Select Location',
				'instructions' => 'Choose the location this project belongs to.',
				'required' => 1,
				'post_type' => ['locations'], // CPT to select from
				'return_format' => 'id', // or 'object' if you prefer
				'multiple' => 0,
				'allow_null' => 0,
				'ui' => 1,
			])
			->addGroup('coordinates', [
				'label' => 'Insert lat long coordinates.',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => '100',
					'class' => '',
					'id' => '',
				],
				'layout' => 'block'
			])
				->addText('lat', [
					'label' => 'Latitude',
					'instructions' => '',
					'required' => 1,
					'wrapper' => [
						'width' => '50',
						'class' => '',
						'id' => '',
					],
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				])
				->addText('lng', [
					'label' => 'Longitude',
					'instructions' => '',
					'required' => 1,
					'wrapper' => [
						'width' => '50',
						'class' => '',
						'id' => '',
					],
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				])
			->endGroup()
			->addWysiwyg('map_editor', [
			    'label' => '',
			    'instructions' => '',
			    'required' => 0,
			    'conditional_logic' => [],
			    'wrapper' => [
			        'width' => '100',
			        'class' => '',
			        'id' => '',
			    ],
			    'default_value' => '',
			    'tabs' => 'full', // text or visual
			    'toolbar' => 'all', // all or basic
			    'media_upload' => 1,
			    'delay' => 0,
			]);

		$banner_info->setLocation( 'post_type', '==', 'projects' );
		$project_service->setLocation( 'post_type', '==', 'projects' );
		$location_block->setLocation( 'post_type', '==', 'projects' );


		acf_add_local_field_group( $banner_info->build() ); 
		acf_add_local_field_group( $project_service->build() ); 
		acf_add_local_field_group( $location_block->build() ); 
	} );