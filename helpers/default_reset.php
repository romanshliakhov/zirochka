<?php
	/**
	 * ====================== Удаление стандартного поста и категорий/таксономий ===========================
	 */
	function remove_default_post_type() {
		remove_menu_page( 'edit.php' );
	}
	function remove_default_taxonomies() {
		unregister_taxonomy_for_object_type( 'category', 'post' );
	}

	function remove_taxonomy_pages() {
		remove_menu_page( 'edit-tags.php?taxonomy=category' );
	}

	add_action( 'admin_menu', 'remove_default_post_type' );
	add_action( 'init', 'remove_default_taxonomies' );
	add_action( 'admin_menu', 'remove_taxonomy_pages' );
	/**
	 * ================================================================================================
	 */


	/**
	 * ====================== Удаление виджетов с панели управления ===========================
	 */
	function remove_dashboard_widgets() {
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Быстрая запись
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' ); // Черновики
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // Активность
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // Новости WordPress
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' ); // Блог WordPress
		remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' ); // Здоровье сайта
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // Обзор сайта
	}
	add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );
	/**
	 * ================================================================================================
	 */


	/**
	 * ====================== Удаление виджетов с панели управления ===========================
	 */

// Отключение обновлений плагинов
	function disable_plugin_updates( $value ) {
		if ( isset( $value ) && is_object( $value ) ) {
			if ( isset( $value->response ) && is_array( $value->response ) ) {
				foreach ( $value->response as $plugin => $data ) {
					unset( $value->response[ $plugin ] );
				}
			}
		}
		return $value;
	}
	add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );

// Отключение обновлений тем
	function disable_theme_updates( $value ) {
		if ( isset( $value ) && is_object( $value ) ) {
			if ( isset( $value->response ) && is_array( $value->response ) ) {
				foreach ( $value->response as $theme => $data ) {
					unset( $value->response[ $theme ] );
				}
			}
		}
		return $value;
	}
	add_filter( 'site_transient_update_themes', 'disable_theme_updates' );

// Отключение автоматических обновлений для WordPress
	add_filter( 'automatic_updater_disabled', '__return_true' );
	add_filter( 'auto_update_core', '__return_false' );
	/**
	 * ================================================================================================
	 */


	/**
	 * ====================== REST API и XML-RPC ===========================
	 */

// Отключение REST API для постов
	function disable_rest_api_posts( $endpoints ) {
		if ( isset( $endpoints['/wp/v2/posts'] ) ) {
			unset( $endpoints['/wp/v2/posts'] );
		}
		return $endpoints;
	}
//	add_filter( 'rest_endpoints', 'disable_rest_api_posts' );

// Полное отключение REST API (по желанию)
	/*
	function disable_rest_api() {
		die( 'REST API disabled.' );
	}
	add_filter( 'rest_authentication_errors', 'disable_rest_api' );
	*/

// Отключение XML-RPC
	add_filter( 'xmlrpc_enabled', '__return_false' );
	/**
	 * ================================================================================================
	 */


	/**
	 * ====================== Удаление ненужных скриптов и ссылок из head ===========================
	 */
	function clean_wp_head() {
		remove_action( 'wp_head', 'wp_generator' ); // Версия WordPress
		remove_action( 'wp_head', 'rsd_link' ); // RSD
		remove_action( 'wp_head', 'wlwmanifest_link' ); // Windows Live Writer
		remove_action( 'wp_head', 'wp_shortlink_wp_head' ); // Shortlink
		remove_action( 'wp_head', 'feed_links', 2 ); // RSS-ленты
		remove_action( 'wp_head', 'feed_links_extra', 3 ); // Дополнительные RSS
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); // Эмодзи
		remove_action( 'wp_print_styles', 'print_emoji_styles' ); // Стили эмодзи
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 ); // REST API link
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' ); // oEmbed link
		remove_action( 'template_redirect', 'rest_output_link_header', 11 ); // REST API link в заголовке
		remove_action( 'wp_head', 'rel_canonical' ); // Каноническая ссылка
		remove_action( 'wp_head', 'wp_resource_hints', 2 ); // Prefetch и preconnect
	}
	add_action( 'after_setup_theme', 'clean_wp_head' );
	/**
	 * ================================================================================================
	 */


	/**
	 * ====================== Отключение редактора блоков (Gutenberg) ===========================
	 */
	add_filter( 'use_block_editor_for_post', '__return_false', 10 );
	add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );
	/**
	 * ================================================================================================
	 */


	/**
	 * ====================== Отключение стилей для неавторизованных пользователей ===========================
	 */

// Отключаем глобальные стили для тем на блоках для неавторизованных пользователей
	function disable_global_theme_styles() {
		if ( !is_user_logged_in() ) {
			remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
			remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
		}
	}
	add_action( 'init', 'disable_global_theme_styles' );

// Отключаем стили блоков Gutenberg для неавторизованных пользователей
	function disable_block_styles_for_guests() {
		if ( !is_user_logged_in() ) {
			remove_action( 'wp_enqueue_scripts', 'wp_enqueue_block_styles' );
		}
	}
	add_action( 'init', 'disable_block_styles_for_guests' );

// Полностью отключаем поддержку стилей блоков и глобальных стилей
	add_action( 'after_setup_theme', function() {
		remove_theme_support( 'wp-block-styles' );
		remove_theme_support( 'wp-global-styles' );
	});


	function disable_wp_block_library_css() {
		// Убираем стандартные стили блоков Gutenberg
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-block-style' ); // Если используете WooCommerce, это тоже можно отключить
	}

	add_action( 'wp_enqueue_scripts', 'disable_wp_block_library_css', 100 );
	/**
	 * ================================================================================================
	 */


	/**
	 * ====================== Отключение комментариев ===========================
	 */
	function disable_comments() {
		add_filter( 'comments_open', '__return_false', 20, 2 );
		add_filter( 'pings_open', '__return_false', 20, 2 );
		if ( is_admin_bar_showing() ) {
			remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
		}
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'commentsdiv', 'post', 'normal' );
		remove_meta_box( 'commentstatusdiv', 'post', 'normal' );
		remove_meta_box( 'trackbacksdiv', 'post', 'normal' );
	}
//	add_action( 'admin_init', 'disable_comments' );
	/**
	 * ================================================================================================
	 */


	/**
	 * ====================== Настройка системы авто-сохранения и корзины ===========================
	 */

	if ( !defined('AUTOSAVE_INTERVAL') ) {
		define('AUTOSAVE_INTERVAL', 300); // Интервал автосохранения (300 секунд = 5 минут)
	}

	if ( !defined('EMPTY_TRASH_DAYS') ) {
		define('EMPTY_TRASH_DAYS', 0); // Отключение корзины
	}

	if ( !defined('WP_POST_REVISIONS') ) {
		define('WP_POST_REVISIONS', false); // Отключение ревизий записей
	}
	/**
	 * ================================================================================================
	 */


	/**
	 * ====================== Отключение oEmbed ===========================
	 */
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
	/**
	 * ================================================================================================
	 */


	/**
	 * ====================== Отключение редактора тем и плагинов в админке ===========================
	 */
	define( 'DISALLOW_FILE_EDIT', true );
	/**
	 * ================================================================================================
	 */
