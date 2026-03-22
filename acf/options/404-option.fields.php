<?php
	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action('acf/init', function () {
		if (!function_exists('acf_add_local_field_group')) return;

		if (function_exists('acf_add_options_page')) {
			acf_add_options_sub_page( array(
				'page_title'  => __( '404 page settings', 'ACF Fields' ),
				'menu_title'  => __( '404 page settings', 'ACF Fields' ),
				'parent_slug' => 'options-general.php',
				'menu_slug'   => 'sp-404-options', // <= БУКВЕННЫЙ слаг
				'post_id'     => 'sp_404',
			) );
		}

		$options = new FieldsBuilder('404_options', [
			 'style' => 'seamless',
		]);

		$options
			->addGroup('404', [
				'label' =>  false,
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'class' => '',
					'id' => '',
				],
				'layout' => 'block'
			])
//
				->addGallery('gallery', [
					'label' => false,
					'preview_size' => 'large',
					'max' => 1,
					'wrapper' => [
						'class' => 'admin-background-image'
					]
				])
				->addWysiwyg('editor', [
					'label' => false,
					'media_upload' => 0,
					'wrapper'=> [
						'class' => 'mini-editor',
						'width' => '100'
					]
				])

			->endGroup();

		$options->setLocation('options_page', '==', 'sp-404-options');

		acf_add_local_field_group($options->build());
	});


