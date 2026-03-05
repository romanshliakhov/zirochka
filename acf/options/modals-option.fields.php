<?php
	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action('acf/init', function () {
		if (!function_exists('acf_add_local_field_group')) return;

		if (function_exists('acf_add_options_page')) {
			acf_add_options_sub_page( array(
				'page_title'  => __( 'Modals settings', THEME_SLUG ),
				'menu_title'  => __( 'Modals settings', THEME_SLUG ),
				'parent_slug' => 'edit.php?post_type=modals',
				'menu_slug'   => 'modals_options',
				'post_id'     => 'modals_options'
			) );
		}

		$options = new FieldsBuilder('modals_options');

		$options
			->addGroup('modal_box', [
				'label' => 'Header settings',
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
				->addRelationship('success_id', [
					'label' => 'Select your success modal',
					'instructions' => '',
					'post_type' => ['modals'],
					'filters' => ['search'],
					'min' => '1',
					'max' => '1',
					'return_format' => 'id',
					'required' => 1,
					'wrapper' => [
						'width' => '50',
						'class' => '',
						'id' => '',
					],
				])
				->addRelationship('error_id', [
					'label' => 'Select your error modal',
					'instructions' => '',
					'post_type' => ['modals'],
					'filters' => ['search'],
					'min' => '1',
					'max' => '1',
					'required' => 1,
					'return_format' => 'id',
					'wrapper' => [
						'width' => '50',
						'class' => '',
						'id' => '',
					],
				])
			->endGroup();

		$options->setLocation('options_page', '==', 'modals_options');

		acf_add_local_field_group($options->build());
	});


