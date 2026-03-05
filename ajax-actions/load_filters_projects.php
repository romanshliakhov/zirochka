<?php
// Фильтрация проектов по выбранным фильтрам
add_action('wp_ajax_get_filters_projects', 'ajax_get_filters_projects');
add_action('wp_ajax_nopriv_get_filters_projects', 'ajax_get_filters_projects');

function ajax_get_filters_projects() {
    if (empty($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ajax_global')) {
        wp_send_json_error(['message' => 'Invalid nonce']);
    }

    $args = [
        'post_type' => 'projects',
        'posts_per_page' => 4,  // Лимит на количество проектов, которые мы возвращаем
        'paged' => isset($_POST['paged']) ? intval($_POST['paged']) : 1,  // Текущая страница
    ];

    $tax_query = [];

    // Фильтры
    if (!empty($_POST['types']) && $_POST['types'] !== 'all') {
        $tax_query[] = [
            'taxonomy' => 'roofing_type',
            'field'    => 'slug',
            'terms'    => sanitize_text_field($_POST['types']),
        ];
    }

    if (!empty($_POST['locations']) && $_POST['locations'] !== 'all') {
        $tax_query[] = [
            'taxonomy' => 'project_location',
            'field'    => 'slug',
            'terms'    => sanitize_text_field($_POST['locations']),
        ];
    }

    if (!empty($_POST['colors']) && $_POST['colors'] !== 'all') {
        $tax_query[] = [
            'taxonomy' => 'roof_color',
            'field'    => 'slug',
            'terms'    => sanitize_text_field($_POST['colors']),
        ];
    }

    if ($tax_query) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);

    // Общее количество проектов
    $total_projects_query = new WP_Query([
        'post_type' => 'projects',
        'posts_per_page' => -1,  // Без пагинации, чтобы получить все проекты
        'tax_query' => $tax_query,
    ]);

    $total_projects_count = $total_projects_query->found_posts;

    ob_start();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            display_projects_card(get_the_ID());
        }
    } else {
        echo '<p>No projects found.</p>';
    }

    wp_reset_postdata();

    $html = ob_get_clean();
    wp_send_json_success(['html' => $html, 'total_projects_count' => $total_projects_count]);
}





