<?php
// Регистрируем CPT "News"
function register_news_post_type() {
    $labels = [
        'name' => 'Наші публікації',
        'singular_name' => 'Публікація',
        'menu_name' => 'Наші публікації',
        'all_items' => 'Всі публікації',
        'add_new_item' => 'Додати публікацію',
        'edit_item' => 'Редагувати публікацію',
        'new_item' => 'Нова публікація',
        'view_item' => 'Переглянути публікацію',
        'search_items' => 'Пошук публікацій',
        'not_found' => 'Публікацій не знайдено',
        'not_found_in_trash' => 'У кошику публікацій не знайдено',
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'has_archive'        => false,
        'hierarchical'       => false,
        'rewrite' => [
            'slug' => 'news',
            'with_front' => false,
        ],
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-edit-page',
        'supports'           => ['title', 'editor', 'thumbnail', 'custom-fields'],
    ];

    register_post_type('news', $args);
}
add_action('init', 'register_news_post_type');