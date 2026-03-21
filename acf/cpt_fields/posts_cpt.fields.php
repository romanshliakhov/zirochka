<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

add_action( 'acf/init', function () {

    // ===========  Excerpt Fields =========== //
    $editor = new FieldsBuilder( 'articles_info',[
        'style' => 'seamless',
        'position' => 'acf_after_title',
    ]);

    $editor
        ->addText('info', [
            'label' => 'Image text',
            'wrapper' => [
                'width' => '100',
            ],
        ]);

    $editor->setLocation( 'post_type', '==', 'articles' );
    acf_add_local_field_group( $editor->build() );
} );


