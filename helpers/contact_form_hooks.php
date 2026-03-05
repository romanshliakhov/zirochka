<?php

	add_filter( 'wpcf7_autop_or_not', '__return_false' );

	// Replace the shortcode [theme-url] with the URL of the theme's assets directory in Contact Form 7 forms
	add_filter( 'wpcf7_form_elements', function ( $content ) {
		$theme_url = get_template_directory_uri() . '/assets/';
		$content   = str_replace( '[theme-url]', $theme_url, $content );

		return $content;
	});

	// Set default HTML class for Contact Form 7 forms if html_class attribute is not explicitly defined in the shortcode
	add_filter( 'shortcode_atts_wpcf7', function ( $out, $pairs, $atts ) {
		if ( ! isset( $atts['html_class'] ) ) {
			$out['html_class'] = 'main-form';
		}

		return $out;
	}, 10, 3 );

	function custom_wpcf7_form_elements( $content ) {
		global $form_btn;

		if ( $form_btn ) {
			$content = str_replace( 'form_btn', $form_btn, $content );
		}

		return $content;
	}

	add_filter( 'wpcf7_form_elements', 'custom_wpcf7_form_elements' );


	function acf_load_cf7_forms( $field ) {
		$field['choices'] = array();

		$args  = array(
			'post_type'      => 'wpcf7_contact_form',
			'posts_per_page' => - 1,
		);
		$forms = get_posts( $args );

		if ( $forms ) {
			foreach ( $forms as $form ) {
				$field['choices'][ $form->ID ] = $form->post_title;
			}
		}

		return $field;
	}

	add_filter( 'acf/load_field/name=form_select', 'acf_load_cf7_forms' );


	add_filter('wpcf7_posted_data', function($posted_data) {
		if (!empty($posted_data['quiz_data'])) {
			$quizData = json_decode($posted_data['quiz_data'], true);

			if (is_array($quizData)) {
				$formatted = '';

				foreach ($quizData as $section => $fields) {
					$formatted .= "=== " . $section . " ===\n";
					foreach ($fields as $name => $value) {
						$label = ucfirst(str_replace(['-', '_'], ' ', $name));

						if (is_array($value)) {
							$value = implode(', ', array_map('sanitize_text_field', $value));
						} else {
							$value = sanitize_text_field($value);
						}

						$formatted .= "{$label}: {$value}\n";
					}
					$formatted .= "\n";
				}

				$posted_data['quiz_data'] = $formatted;
			}
		}

		return $posted_data;
	});