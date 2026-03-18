<?php
// Регистрируем CPT "Books"
function register_books_post_type() {
    $labels = [
        'name'               => __('Книги', THEME_SLUG),
        'singular_name'      => __('Книга', THEME_SLUG),
        'menu_name'          => __('Книги', THEME_SLUG),
        'name_admin_bar'     => __('Книга', THEME_SLUG),
        'add_new'            => __('Додати книгу', THEME_SLUG),
        'add_new_item'       => __('Додати нову книгу', THEME_SLUG),
        'new_item'           => __('Нова книга', THEME_SLUG),
        'edit_item'          => __('Редагувати книгу', THEME_SLUG),
        'view_item'          => __('Переглянути книгу', THEME_SLUG),
        'all_items'          => __('Всі книги', THEME_SLUG),
        'not_found'          => __('Книгу не знайдено', THEME_SLUG),
        'not_found_in_trash' => __('Видалених книг не знайдено', THEME_SLUG),
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
            'slug' => 'books',
            'with_front' => false,
        ],
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-book',
        'supports'           => ['title', 'thumbnail', 'custom-fields'],
    ];

    register_post_type('books', $args);
}
add_action('init', 'register_books_post_type');