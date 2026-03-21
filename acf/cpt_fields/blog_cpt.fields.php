<?php

	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action( 'acf/init', function () {

		// ===========  Excerpt Fields =========== //
		$editor = new FieldsBuilder( 'excerpt',[
			'style' => 'seamless',
			'position' => 'acf_after_title',
		]);

		$editor
            ->addText('info', [
                'label' => 'Image text',
                'wrapper' => [
                    'width' => '100',
                ],
            ])
			->addWysiwyg('excerpt', [
				'label' => false,
				'instructions' => 'Excerpt',
				'toolbar' => 'basic',
				'media_upload' => 0,
				'delay' => 0,
				'wrapper' => [
					'class' => 'mini-editor'
				]
			]);

		$editor->setLocation( 'post_type', '==', 'blog' );
		acf_add_local_field_group( $editor->build() );
	} );


