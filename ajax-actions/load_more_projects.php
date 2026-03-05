<?php
// Загрузка дополнительных проектов
add_action('wp_ajax_get_more_projects', 'ajax_more_projects');
add_action('wp_ajax_nopriv_get_more_projects', 'ajax_more_projects');

function ajax_more_projects() {
	if (empty($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ajax_global')) {
		wp_send_json_error(['message' => 'Invalid nonce']);
	}

	$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;

	$args = [
		'post_type' => 'projects',
		'posts_per_page' => 4,
		'offset' => $offset,
	];

	$tax_query = [];

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

	ob_start();

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			display_projects_card(get_the_ID());
		}
	}

	wp_reset_postdata();

	$html = ob_get_clean();
	wp_send_json_success(['html' => $html]);
}


