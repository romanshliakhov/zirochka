<?php
	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action('acf/init', function () {
		if (!function_exists('acf_add_local_field_group')) return;

		if (function_exists('acf_add_options_page')) {
			acf_add_options_sub_page( array(
				'page_title'  => __( 'Header settings', THEME_SLUG ),
				'menu_title'  => __( 'Header', THEME_SLUG ),
				'parent_slug' => 'themes.php',
				'menu_slug'   => 'header',
				'post_id'     => 'header'
			) );
		}

		$options = new FieldsBuilder('header_options');

		$options
			->addGroup('header', [
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => [],
				'wrapper' => [
					'width' => '100',
					'class' => '',
					'id' => '',
				],
				'layout' => 'block'
			])
				->addImage('logo', [
					'label' => 'Site Logo',
					'wrapper' => [
						'width' => '50',
						'class' => '',
						'id' => '',
					],
				])
			->endGroup();

		$options->setLocation('options_page', '==', 'header');

		acf_add_local_field_group($options->build());
	});


