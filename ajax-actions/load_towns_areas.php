<?php
add_action('wp_ajax_get_towns_areas', 'ajax_get_towns_areas');
add_action('wp_ajax_nopriv_get_towns_areas', 'ajax_get_towns_areas');

function ajax_get_towns_areas() {
	if (empty($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ajax_global')) {
		wp_send_json_error(['message' => 'Invalid nonce']);
	}

	$post_id = intval($_POST['post_id']);
	if (!$post_id) {
		wp_send_json_error(['message' => 'Invalid city ID']);
	}

	$projects_raw = get_posts([
		'post_type' => 'projects',
		'posts_per_page' => -1,
		'meta_query' => [
			[
				'key' => 'related_location',
				'value' => $post_id,
				'compare' => '=',
			],
		],
	]);

	$projects = [];

	foreach ($projects_raw as $project) {
		$coords = get_field('coordinates', $project->ID);
		$gallery = get_field('gallery', $project->ID);
		$image = get_field('image', $project->ID);

		// Таксономии
		$roofing_types = get_the_terms($project->ID, 'roofing_type');
		$project_locations = get_the_terms($project->ID, 'project_location');
		$roof_colors = get_the_terms($project->ID, 'roof_color');

		$get_term_names = function($terms) {
			$names = [];
			if ($terms && !is_wp_error($terms)) {
				foreach ($terms as $term) {
					$names[] = $term->name;
				}
			}
			return $names;
		};

		$gallery_arr = [];
		if ($gallery && is_array($gallery)) {
			foreach ($gallery as $img) {
				$gallery_arr[] = [
					'url' => $img['url'],
					'alt' => $img['alt'] ?? '',
				];
			}
		}

		$projects[] = [
			'id' => $project->ID,
			'title' => get_the_title($project->ID),
			'coordinates' => [
				'lat' => $coords['lat'] ?? '',
				'lng' => $coords['lng'] ?? '',
			],
			'gallery' => $gallery_arr,
			'permalink' => get_permalink($project->ID),
			'thumbnail' => get_the_post_thumbnail_url($project->ID, 'thumbnail'),
			'image' => $image ? $image['url'] : '',
			'tags' => [
				'roofing_type' => $get_term_names($roofing_types),
				'project_location' => $get_term_names($project_locations),
				'roof_color' => $get_term_names($roof_colors),
			],
		];
	}

	wp_send_json_success(['projects' => $projects]);
	wp_die();
}
