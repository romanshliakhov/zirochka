<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

function section_cta( $layout_name ) {

    $layout = new FieldsBuilder( $layout_name );
    $layout
        ->addText( 'section_id', [
            'label'        => __( 'ID fields', 'ACF' ),
            'instructions' => __( 'You can set a unique id for the section (And add them to the navigation)', 'ACF' ),
            'wrapper'      => [
                'width' => '50',
                'class' => '',
                'id'    => '',
            ],
        ] )

        ->addFlexibleContent('cta_section', [
            'label'        => __('Editors', 'ACF'),
            'button_label' => __('Add Section', 'ACF'),
            'max'    => 1,
        ])
        ->addLayout('cta_1', [
            'label'   => __('CTA №1', 'ACF'),
            'display' => 'block',
        ])

        ->addWysiwyg('editor', [
            'label' => false,
            'media_upload' => 0,
            'wrapper' => [
                'class' => 'auto-height-editor',
                'width' => '50',
            ]
        ])

        ->addWysiwyg('editor2', [
            'label' => false,
            'media_upload' => 0,
            'wrapper' => [
                'class' => 'auto-height-editor',
                'width' => '50',
            ]
        ])


        ->addLayout('cta_2', [
            'label'   => __('CTA №2', 'ACF'),
            'display' => 'block',
        ])
        ->addImage('bg', [
            'label' => 'Background image',
            'return_format' => 'array',
            'wrapper' => [
                'width' => '20',
            ]
        ])
        ->addWysiwyg('editor', [
            'label' => false,
            'media_upload' => 0,
            'wrapper' => [
                'class' => 'auto-height-editor',
                'width' => '40',
            ]
        ])

        ->addWysiwyg('editor2', [
            'label' => false,
            'media_upload' => 0,
            'wrapper' => [
                'class' => 'auto-height-editor',
                'width' => '40',
            ]
        ])
        ->endFlexibleContent();


    return [
        'layout'  => $layout,
        'display' => 'block',
    ];
}

