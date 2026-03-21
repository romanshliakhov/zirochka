<?php

// ======== Кастомный пост-тип "blog" ========
add_action( 'init', function () {
    $post_type = 'blog';
    $rewrite   = function_exists('get_archive_by_post')
        ? ( get_archive_by_post($post_type) ? mb_strtolower(get_archive_by_post($post_type)?->post_name ?? '', 'UTF-8') : $post_type )
        : $post_type;

    $labels = [
        'name'               => __( 'Блог', 'ACF Fields' ),
        'singular_name'      => __( 'Блог', 'ACF Fields' ),
        'menu_name'          => __( 'Блог', 'ACF Fields' ),
        'name_admin_bar'     => __( 'Блог', 'ACF Fields' ),
        'add_new'            => __( 'Додати новий', 'ACF Fields' ),
        'add_new_item'       => __( 'Додати новий запис блогу', 'ACF Fields' ),
        'new_item'           => __( 'Новий запис блогу', 'ACF Fields' ),
        'edit_item'          => __( 'Редагувати запис блогу', 'ACF Fields' ),
        'view_item'          => __( 'Переглянути запис блогу', 'ACF Fields' ),
        'all_items'          => __( 'Усі записи блогу', 'ACF Fields' ),
        'not_found'          => __( 'Записів блогу не знайдено.', 'ACF Fields' ),
        'not_found_in_trash' => __( 'У кошику записів блогу не знайдено.', 'ACF Fields' ),
    ];

    $args = [
        'labels'            => $labels,
        'public'            => true,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menus' => true,
        'has_archive'       => false,
        'rewrite'           => [ 'slug' => $rewrite ],
        'supports'          => [ 'title','thumbnail'],
        'menu_icon'         => 'dashicons-welcome-write-blog',
    ];

    register_post_type( $post_type, $args );
} );