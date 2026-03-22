<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    if (function_exists('acf_add_options_page')) {
        acf_add_options_sub_page(array(
            'page_title' => __('Глобальні налаштування', 'ACF'),
            'menu_title' => __('Global settings', 'ACF'),
            'parent_slug' => 'themes.php',
            'menu_slug' => 'settings',
            'post_id' => 'settings'
        ));
    }

    $options = new FieldsBuilder('theme_options');

    $options
        ->addGroup('global_contacts', [
            'label' => '',
            'layout' => 'block'
        ])

        ->addTab('contact_tab_1', [
            'label' => __('Соціальні мережі', 'ACF'),
            'placement' => 'left',
        ])

        ->addRepeater('social', [
            'label'        => __('Наші соцмережі', 'ACF'),
            'button_label' => __('Додати соцмережу', 'ACF'),
            'layout'       => 'block'
        ])

        ->addImage('social_image', [
            'label' => __('Лого соцмережі', 'ACF'),
            'wrapper' => [
                'width' => '50',
            ],
            'return_format' => 'array',
            'preview_size' => 'thumbnail',
        ])

        ->addLink('social_link', [
            'label' => __('Посилання на соцмережу', 'ACF'),
            'wrapper' => [
                'width' => '50',
            ],
            'return_format' => 'array',
        ])

        ->endRepeater()

        ->addTab('contact_tab_404', [
            'label' => __('404 сторінка', 'ACF'),
            'placement' => 'left',
        ])

        ->addGroup('page_404', [
            'label' => '',
            'layout' => 'block'
        ])

        ->addImage('image', [
            'label' => __('Зображення', 'ACF'),
            'return_format' => 'array',
            'preview_size' => 'large',
            'wrapper' => ['width' => '50'],
        ])

        ->addWysiwyg('editor', [
            'label' => __('Текст', 'ACF'),
            'media_upload' => 0,
            'wrapper' => ['width' => '50'],
        ])

        ->endGroup()

        ->endGroup();

    $options->setLocation('options_page', '==', 'settings');

    acf_add_local_field_group($options->build());
});