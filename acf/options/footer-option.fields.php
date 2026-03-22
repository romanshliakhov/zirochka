<?php
	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action('acf/init', function () {
		if (!function_exists('acf_add_local_field_group')) return;

		if (function_exists('acf_add_options_page')) {
			acf_add_options_sub_page( array(
				'page_title'  => __( 'Footer settings', THEME_SLUG ),
				'menu_title'  => __( 'Footer', THEME_SLUG ),
				'parent_slug' => 'themes.php',
				'menu_slug'   => 'footer',
				'post_id'     => 'footer'
			) );
		}

		$options = new FieldsBuilder('footer_options');

		$options
            ->addImage('logo', [
                'label' => 'Site Logo',
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
            ]);

		$options->setLocation('options_page', '==', 'footer');

		acf_add_local_field_group($options->build());
	});
