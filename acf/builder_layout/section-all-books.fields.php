<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

function section_all_books($layout_name) {

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
        ])

        // 🔹 Mode: exclude or normal
        ->addTrueFalse('exclude_mode', [
            'label' => __('Виключити вибрані книги?', 'ACF'),
            'instructions' => __('Якщо увімкнено — ця секція покаже всі книги, окрім вибраних у попередній секції', 'ACF'),
            'default_value' => 0,
            'ui' => 1,
            'ui_on_text' => __('Виключити', 'ACF'),
            'ui_off_text' => __('Звичайний режим', 'ACF'),
        ])

        // 🔹 Books selector
        ->addRelationship('books', [
            'label' => 'Книги',
            'instructions' => 'Оберіть книги (для першої секції). У другій секції вони будуть виключені автоматично.',
            'post_type' => ['books'],
            'filters' => [
                'search',
            ],
            'min' => 0,
            'max' => 10,
            'return_format' => 'id',
        ]);

    return [
        'layout'  => $layout,
        'display' => 'block',
    ];
}