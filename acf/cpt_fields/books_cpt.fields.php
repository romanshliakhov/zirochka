<?php
use StoutLogic\AcfBuilder\FieldsBuilder;

add_action('acf/init', function () {
    // === Excerpt ===
    $editor = new FieldsBuilder('book_excerpt', [
        'style' => 'seamless',
        'position' => 'acf_after_title',
    ]);

    $editor
        ->addText('info', [
            'label' => 'Image text',
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
        ])
        ->setLocation('post_type', '==', 'books');

    acf_add_local_field_group($editor->build());

    $options = new FieldsBuilder('book_info', [
        'title' => 'Info',
    ]);

    $options
        ->addText('release', [
            'label' => 'Release date',
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

        ->setLocation('post_type', '==', 'books');

    acf_add_local_field_group($options->build());


    // ===========  Excerpt Fields =========== //
    $editor2 = new FieldsBuilder('articles_info', [
        'style' => 'seamless',
        'position' => 'acf_after_title',
    ]);

    $editor2
        ->addText('info', [
            'label' => 'Image text',
            'wrapper' => [
                'width' => '100',
            ],
        ])
    ;

    $editor2->setLocation('post_type', '==', 'articles');
    acf_add_local_field_group($editor2->build());
});
