<?php
add_action('init', function () {
	// === Регистрируем CPT ===
	$labels = [
		'name'               => 'Locations',
		'singular_name'      => 'Location',
		'menu_name'          => 'Locations',
		'name_admin_bar'     => 'Location',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Location',
		'new_item'           => 'New Location',
		'edit_item'          => 'Edit Location',
		'view_item'          => 'View Location',
		'all_items'          => 'All Locations',
		'not_found'          => 'No locations found.',
		'not_found_in_trash' => 'No locations found in Trash.',
	];

	$args = [
		'labels'             => $labels,
		'public'             => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'has_archive'        => false,
		'rewrite'            => [
			'slug' => 'locations',
			'with_front' => false,
		],
		'supports'           => ['title', 'thumbnail', 'custom-fields'],
		'menu_icon'          => 'dashicons-location-alt',
	];

	register_post_type('locations', $args);

	// === Регистрируем таксономию "Provinces" ===
	$tax_labels = [
		'name'              => 'Provinces',
		'singular_name'     => 'Province',
		'edit_item'         => 'Edit Province',
		'update_item'       => 'Update Province',
		'add_new_item'      => 'Add New Province',
		'new_item_name'     => 'New Province Name',
		'all_items'         => 'All Provinces',
		'parent_item'       => 'Parent Province',
		'parent_item_colon' => 'Parent Province:',
		'search_items'      => 'Search Provinces',
		'menu_name'         => 'Provinces',
	];

	$tax_args = [
		'hierarchical'      => true,
		'labels'            => $tax_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => false, // URL будет без /province/
	];

	register_taxonomy('locations_province', ['locations'], $tax_args);
});
