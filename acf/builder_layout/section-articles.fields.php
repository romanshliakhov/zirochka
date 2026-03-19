<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

function section_articles($layout_name) {

    $layout = new FieldsBuilder($layout_name);

    $layout
        // 🔹 Hide section
        ->addTrueFalse('shower', [
            'label' => __('Приховати секцію?', 'ACF'),
            'instructions' => __('Увімкніть, щоб приховати цей блок.', 'ACF'),
            'default_value' => 0,
            'ui' => 1,
            'ui_on_text' => __('Приховати', 'ACF'),
            'ui_off_text' => __('Показати', 'ACF'),
            'wrapper' => [
                'width' => '50',
            ],
        ])

        // 🔹 Mode: exclude or normal
        ->addTrueFalse('exclude_mode', [
            'label' => __('Виключити вибрані статті?', 'ACF'),
            'instructions' => __('Якщо увімкнено — ця секція покаже всі статті, окрім вибраних у попередній секції', 'ACF'),
            'default_value' => 0,
            'ui' => 1,
            'ui_on_text' => __('Виключити', 'ACF'),
            'ui_off_text' => __('Звичайний режим', 'ACF'),
            'wrapper' => [
                'width' => '50',
            ],
        ])
        ->addText('editor', [
            'label' => 'Section Title',
            'wrapper' => [
                'width' => '100',
            ],
        ])

        ->addRelationship('articles', [
            'label' => 'Статті',
            'instructions' => 'Оберіть статті (для першої секції). У другій секції вони будуть виключені автоматично.',
            'post_type' => ['articles'],
            'filters' => [
                'search',
            ],
            'min' => 0,
            'max' => 5,
            'return_format' => 'id',
        ]);

    return [
        'layout'  => $layout,
        'display' => 'block',
    ];
}