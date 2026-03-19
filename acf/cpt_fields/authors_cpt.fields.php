<?php
	use StoutLogic\AcfBuilder\FieldsBuilder;

	add_action('acf/init', function () {
        $options = new FieldsBuilder('author_info', [
            'title' => 'Author Info',
        ]);

        $options
            ->addNumber('birth_year', [
                'label' => 'Year of Birth',
                'wrapper' => [
                    'width' => '100',
                ],
            ])

            ->addTextarea('description', [
                'label' => 'Description',
                'rows' => 4,
                'wrapper' => [
                    'width' => '100',
                ],
            ])

			->setLocation('post_type', '==', 'authors');

		acf_add_local_field_group($options->build());
	});
