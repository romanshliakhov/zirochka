<?php
	get_header();
	
	$post_id = get_the_ID();

	if (have_rows('builder', $post_id)) {
		while (have_rows('builder', $post_id)) { the_row();
			get_template_part('template_parts/' . str_replace('_', '-', get_row_layout()));
		}
	}

	get_footer();

