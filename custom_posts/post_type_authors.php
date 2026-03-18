<?php
// Регистрируем CPT "Authors"
function register_authors_post_type() {
    $labels = [
        'name'               => __('Автори', THEME_SLUG),
        'singular_name'      => __('Автор', THEME_SLUG),
        'menu_name'          => __('Автори', THEME_SLUG),
        'name_admin_bar'     => __('Автор', THEME_SLUG),
        'add_new'            => __('Додати автора', THEME_SLUG),
        'add_new_item'       => __('Додати нового автора', THEME_SLUG),
        'new_item'           => __('Новий автор', THEME_SLUG),
        'edit_item'          => __('Редагувати автора', THEME_SLUG),
        'view_item'          => __('Переглянути автора', THEME_SLUG),
        'all_items'          => __('Всі автори', THEME_SLUG),
        'not_found'          => __('Автора не знайдено', THEME_SLUG),
        'not_found_in_trash' => __('Видаленний нових не знайдено', THEME_SLUG),
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
            'slug' => 'authors',
            'with_front' => false,
        ],
        'menu_position'      => 5,
        'menu_icon' => 'dashicons-admin-users',
        'supports'           => ['title', 'thumbnail', 'custom-fields'],
    ];

    register_post_type('authors', $args);
}
add_action('init', 'register_authors_post_type');