<?php

	add_action('admin_print_footer_scripts', function () {
		?>
		<script type="text/javascript">
            window.ajax_params = {
                ajax_url: "<?php echo admin_url('admin-ajax.php'); ?>"
            };
		</script>
		<?php
	});


	add_filter('mce_buttons', function ($buttons) {
		array_unshift($buttons, 'styleselect', 'cf7_shortcode_button');
		return $buttons;
	});

	add_filter('mce_buttons', function ($buttons) {
		array_push($buttons, 'link_style_selector');
		return $buttons;
	});

	add_filter('mce_buttons', function ($buttons) {
		array_push($buttons, 'link_text_selector');
		return $buttons;
	});

	add_filter('mce_buttons', function ($buttons) {
		array_push($buttons, 'range_selector');
		return $buttons;
	});

	add_filter('mce_buttons', function ($buttons) {
		array_push($buttons, 'frame_selector');
		return $buttons;
	});

	// add_filter('mce_external_plugins', function ($plugins) {
	// 	$plugins['frame_selector'] = get_template_directory_uri() . '/admin/js/custom-description-editor.js';
	// 	return $plugins;
	// });


	// add_filter('mce_external_plugins', function ($plugins) {
	// 	$plugins['range_selector'] = get_template_directory_uri() . '/admin/js/custom-range-editor.js';
	// 	return $plugins;
	// });


	add_filter('mce_external_plugins', function ($plugins) {
		$plugins['link_style_selector'] = get_template_directory_uri() . '/admin/js/custom-link-class.js';
		return $plugins;
	});

	add_filter('mce_external_plugins', function ($plugins) {
		$plugins['link_text_selector'] = get_template_directory_uri() . '/admin/js/custom-text-class.js';
		return $plugins;
	});


// Подключаем кастомный плагин для TinyMCE
	add_filter('mce_external_plugins', function ($plugins) {
		$plugins['cf7_shortcode_button'] = get_template_directory_uri() . '/admin/js/cf7-shortcode-button.js';
		return $plugins;
	});

// Подключаем стили редактора
	add_action('admin_init', function () {
		add_editor_style(get_template_directory_uri() . '/assets/css/for-editor.css');
	});

// Обработка абзацев с кнопками
	function add_row_class_to_paragraphs_global($content) {
		if (empty($content)) return $content;

		$dom = new DOMDocument();
		libxml_use_internal_errors(true);
		$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
		libxml_clear_errors();

		// 1. Добавляем .row в <p> с <a class="...">
		$paragraphs = $dom->getElementsByTagName('p');
		$toRemove = [];

		foreach ($paragraphs as $p) {
			$links = $p->getElementsByTagName('a');
			$hasClass = false;
			foreach ($links as $link) {
				if ($link->hasAttribute('class') && !empty($link->getAttribute('class'))) {
					$hasClass = true;
					break;
				}
			}
			if ($hasClass) {
				$existingClass = $p->getAttribute('class');
				$newClass = trim($existingClass . ' row');
				$p->setAttribute('class', $newClass);
			}

			// 2. Удаляем <p>, если внутри только <label class="range mode">
			if (
				$p->childNodes->length === 1 &&
				$p->firstChild->nodeName === 'label' &&
				$p->firstChild->hasAttributes()
			) {
				$label = $p->firstChild;
				$class = $label->getAttribute('class');
				if (strpos($class, 'range') !== false && strpos($class, 'mode') !== false) {
					$toRemove[] = $p;
				}
			}
		}

		// Заменяем <p><label></label></p> → <label></label>
		foreach ($toRemove as $p) {
			$p->parentNode->insertBefore($p->firstChild, $p);
			$p->parentNode->removeChild($p);
		}

		$html = $dom->saveHTML();
		$html = preg_replace('/^<!DOCTYPE.+?>/', '', $html);
		return $html;
	}

	add_filter('the_content', 'add_row_class_to_paragraphs_global', 20);
	add_filter('acf_the_content', 'add_row_class_to_paragraphs_global', 20);
	add_filter('render_block', function ($block_content, $block) {
		return add_row_class_to_paragraphs_global($block_content);
	}, 10, 2);



// AJAX для получения списка форм
	add_action('wp_ajax_get_cf7_forms', function () {
		$forms = get_posts([
			'post_type'      => 'wpcf7_contact_form',
			'posts_per_page' => -1
		]);

		$result = [];
		foreach ($forms as $form) {
			$result[] = [
				'id'    => $form->ID,
				'title' => $form->post_title
			];
		}
		wp_send_json($result);
	});
