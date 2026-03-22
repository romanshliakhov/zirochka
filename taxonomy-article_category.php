<?php
	get_header();
$term = get_queried_object();

$term_id   = $term->term_id;
$term_name = $term->name;
$term_desc = $term->description;
    // Builder для taxonomy term
    $builder_post_id = 'term_' . $term_id;

    if (have_rows('builder', $builder_post_id)) :
        while (have_rows('builder', $builder_post_id)) :
            the_row();

            $layout = get_row_layout();
            get_template_part('template_parts/' . str_replace('_', '-', $layout));

        endwhile;
    endif;


	get_footer();
