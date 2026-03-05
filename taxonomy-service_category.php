<?php
	get_header();
	$term    = get_queried_object();
	$post_id = $post_id = 'term_' . $term->term_id;

	if ( have_rows( 'builder', $post_id ) ) {
		while ( have_rows( 'builder', $post_id ) ) {
			the_row();
			get_template_part( 'template_parts/' . get_row_layout() );
		}
	}

	get_footer();
