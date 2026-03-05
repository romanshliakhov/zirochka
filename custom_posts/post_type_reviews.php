<?php
	function register_review_post_type() {
		$labels = array(
			'name'                  => __('Testimonials', THEME_SLUG),
			'singular_name'         => __('Testimonial', THEME_SLUG),
			'menu_name'             => __('Testimonials', THEME_SLUG),
			'all_items'             => __('All Testimonials', THEME_SLUG),
			'add_new'               => __('Add New', THEME_SLUG),
			'add_new_item'          => __('Add New Testimonial', THEME_SLUG),
			'edit_item'             => __('Edit Testimonial', THEME_SLUG),
			'new_item'              => __('New Testimonial', THEME_SLUG),
			'view_item'             => __('View Testimonial', THEME_SLUG),
			'search_items'          => __('Search Testimonials', THEME_SLUG),
			'not_found'             => __('No Reviews found', THEME_SLUG),
			'not_found_in_trash'    => __('No Reviews found in Trash', THEME_SLUG),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false, // Отключено публичное отображение
			'exclude_from_search'=> true,   // Не участвуют в поиске
			'publicly_queryable' => false,  // Нет возможности открыть сингл
			'show_in_nav_menus'  => false,  // Не отображается в меню
			'show_ui'            => true,   // Видим в админке
			'menu_icon'          => 'dashicons-format-quote', // Иконка отзывов
			'has_archive'        => false,  // Нет архива
			'rewrite'            => false,  // Без перезаписи URL
			'supports'           => array('title', 'editor', 'thumbnail'), // Что поддерживает
			'show_in_rest'       => true,   // Для поддержки Gutenberg
		);

		register_post_type('review', $args);
	}
	add_action('init', 'register_review_post_type');