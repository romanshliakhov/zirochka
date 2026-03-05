<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    if (function_exists('acf_add_options_page')) {
        acf_add_options_sub_page(array(
            'page_title' => __('Глобальні налаштування', THEME_SLUG),
            'menu_title' => __('Global settings', THEME_SLUG),
            'parent_slug' => 'themes.php',
            'menu_slug' => 'settings',
            'post_id' => 'settings'
        ));
    }

    $options = new FieldsBuilder('theme_options');

    $options
        ->addGroup('global_contacts', [
            'label' => '',
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
            ->addTab('contact_tab_1', [
                'label' => 'Контактна інформація',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'placement' => 'left',
            ])
                ->addLink('tel_rent', [
                    'label' => 'Основний номер Оренди',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                    ],
                    'return_format' => 'array',
                ])
                ->addLink('tel_sell', [
                    'label' => 'Основний номер Продажів',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                    ],
                    'return_format' => 'array',
                ])
            ->addTab('contact_tab_2', [
                'label' => 'Режим роботи',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'placement' => 'left',
            ])
                ->addText('worktime', [
                    'label' => 'Робочий графік',
                    'instructions' => '',
                    'required' => 0,
                    'wrapper' => [
                        'width' => '100',
                        'class' => '',
                        'id' => '',
                    ],
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ])
            ->addTab('contact_tab_3', [
                'label' => 'Соціальні мережі',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'placement' => 'left',
            ])
                ->addLink('instagram', [
                    'label' => 'Instagram',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                    'width' => 100 / 2,
                    'class' => '',
                    'id' => '',
                    ],
                    'return_format' => 'array',
                ])
                ->addLink('facebook', [
                    'label' => 'Facebook',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                    'width' => 100 / 2,
                    'class' => '',
                    'id' => '',
                    ],
                    'return_format' => 'array',
                ])
                ->addLink('youtube', [
                    'label' => 'YouTube',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                    'width' => 100 / 2,
                    'class' => '',
                    'id' => '',
                    ],
                    'return_format' => 'array',
                ])
                ->addLink('tiktok', [
                    'label' => 'Tiktok',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                    'width' => 100 / 2,
                    'class' => '',
                    'id' => '',
                    ],
                    'return_format' => 'array',
                ])
        ->endGroup();

    $options->setLocation('options_page', '==', 'settings');

    acf_add_local_field_group($options->build());
});