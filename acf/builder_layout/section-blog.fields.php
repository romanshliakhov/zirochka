<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

function section_blog( $layout_name ) {

    $layout = new FieldsBuilder( $layout_name );
    $layout
        ->addTrueFalse( 'shower', [
            'label'             => __( 'Hide section?', 'ACF' ),
            'instructions'      => __( 'Activate to hide the block.', 'ACF' ),
            'required'          => 0,
            'conditional_logic' => [],
            'wrapper'           => [
                'width' => '50',
                'class' => '',
                'id'    => '',
            ],
            'message'           => '',
            'default_value'     => 0,
            'ui'                => 1,
            'ui_on_text'        => __( 'Hide', 'ACF' ),
            'ui_off_text'       => __( 'Show', 'ACF' ),
        ] )

        ->addTrueFalse('exclude_mode', [
            'label' => __('Виключити вибрані книги?', 'ACF'),
            'instructions' => __('Якщо увімкнено — ця секція покаже всі книги, окрім вибраних у попередній секції', 'ACF'),
            'default_value' => 0,
            'ui' => 1,
            'ui_on_text' => __('Виключити', 'ACF'),
            'ui_off_text' => __('Звичайний режим', 'ACF'),
            'wrapper'           => [
                'width' => '50',
                'class' => '',
                'id'    => '',
            ],
        ])

        ->addRelationship('blog', [
            'label' => 'Блоги',
            'instructions' => 'Оберіть за потреби блог зі списку, якщо будуть не вибрані, то просто останні по даті',
            'post_type' => ['blog'],
            'filters' => [
                0 => 'search',
                1 => '',
                2 => '',
            ],
            'min' => '0',
            'max' => '',
            'return_format' => 'id',
        ])
    ;
    ;

    return [
        'layout'  => $layout,
        'display' => 'block',
    ];
}

