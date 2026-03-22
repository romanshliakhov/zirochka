<?php
add_action('init', function () {

    // === CPT: Статті ===
    $labels = [
        'name'               => 'Статті',
        'singular_name'      => 'Стаття',
        'menu_name'          => 'Статті',
        'name_admin_bar'     => 'Стаття',
        'add_new'            => 'Додати нову',
        'add_new_item'       => 'Додати нову статтю',
        'new_item'           => 'Нова стаття',
        'edit_item'          => 'Редагувати статтю',
        'view_item'          => 'Переглянути статтю',
        'all_items'          => 'Усі статті',
        'search_items'       => 'Шукати статті',
        'not_found'          => 'Статті не знайдено.',
        'not_found_in_trash' => 'У кошику статей не знайдено.',
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => [
            'slug' => 'article',
            'with_front' => false,
        ],
        'supports'           => ['title', 'thumbnail', 'excerpt'],
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-media-document',
    ];

    register_post_type('articles', $args);


    // === Таксономія: Категорії ===
    $cat_labels = [
        'name'              => 'Категорії',
        'singular_name'     => 'Категорія',
        'search_items'      => 'Шукати категорії',
        'all_items'         => 'Усі категорії',
        'parent_item'       => 'Батьківська категорія',
        'parent_item_colon' => 'Батьківська категорія:',
        'edit_item'         => 'Редагувати категорію',
        'update_item'       => 'Оновити категорію',
        'add_new_item'      => 'Додати нову категорію',
        'new_item_name'     => 'Назва нової категорії',
        'menu_name'         => 'Категорії',
    ];

    register_taxonomy('article_category', ['articles', 'blog', 'books','news'], [
        'labels'            => $cat_labels,
        'hierarchical'      => true,
        'show_admin_column' => true,
        'rewrite'           => [
            'slug'         => false,
        ],
        'show_in_rest'      => true,
    ]);

    // === Таксономія: Теги ===
    $tag_labels = [
        'name'                       => 'Теги',
        'singular_name'              => 'Тег',
        'search_items'               => 'Шукати теги',
        'popular_items'              => 'Популярні теги',
        'all_items'                  => 'Усі теги',
        'edit_item'                  => 'Редагувати тег',
        'update_item'                => 'Оновити тег',
        'add_new_item'               => 'Додати новий тег',
        'new_item_name'              => 'Назва нового тегу',
        'separate_items_with_commas' => 'Розділяйте теги комами',
        'add_or_remove_items'        => 'Додати або видалити теги',
        'choose_from_most_used'      => 'Обрати з популярних',
        'menu_name'                  => 'Теги',
    ];

    register_taxonomy('article_tag', ['articles', 'books','blog'], [
        'labels'            => $tag_labels,
        'hierarchical'      => false,
        'show_admin_column' => true,
        'rewrite'           => [
            'slug' => 'tag',
        ],
        'show_in_rest'      => true,
    ]);

});