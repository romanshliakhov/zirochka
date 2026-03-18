<?php
	/**
	 * Использование (минимум):
	 * post_relationships([
	 *     'teacher' => 'subject',
	 *     'blog'    => 'services',
	 * ]);
	 *
	 * Расширенный вариант (кастомные имена полей/лейблы):
	 * post_relationships([
	 *     [
	 *         'from'        => 'teacher',
	 *         'to'          => 'subject',
	 *         'field_from'  => 'linked_subjects',   // имя поля в "teacher" (по умолч. linked_{to})
	 *         'field_to'    => 'linked_teachers',   // имя поля в "subject" (по умолч. linked_{from})
	 *         'label_from'  => 'Subjects',          // подпись поля/колонки в "teacher"
	 *         'label_to'    => 'Teachers',          // подпись поля/колонки в "subject"
	 *         'group_title' => 'Relations',         // заголовок группы полей
	 *         'menu_order'  => 20,                  // порядок группы
	 *     ],
	 *     ['from' => 'blog', 'to' => 'services'],
	 * ]);
	 */

	if (!function_exists('post_relationships')) {
		function post_relationships(array $defs): void
		{
			$pairs = [];
			foreach ($defs as $k => $v) {
				if (is_string($k) && is_string($v)) {
					$pairs[] = ['from' => $k, 'to' => $v];
				} elseif (is_array($v) && isset($v['from'], $v['to'])) {
					$pairs[] = $v;
				}
			}
			if (!$pairs) return;

			add_action('acf/init', function () use ($pairs) {
				foreach ($pairs as $cfg) {
					$from        = sanitize_key($cfg['from']);
					$to          = sanitize_key($cfg['to']);

					$pt_from_obj = get_post_type_object($from);
					$pt_to_obj   = get_post_type_object($to);

					$label_from_default = $pt_to_obj && $pt_to_obj->labels->name ? $pt_to_obj->labels->name : ucfirst($to);
					$label_to_default   = $pt_from_obj && $pt_from_obj->labels->name ? $pt_from_obj->labels->name : ucfirst($from);

					$field_from = isset($cfg['field_from']) ? sanitize_key($cfg['field_from']) : 'linked_' . $to;
					$field_to   = isset($cfg['field_to'])   ? sanitize_key($cfg['field_to'])   : 'linked_' . $from;

					$label_from = isset($cfg['label_from']) ? (string)$cfg['label_from'] : $label_from_default;
					$label_to   = isset($cfg['label_to'])   ? (string)$cfg['label_to']   : $label_to_default;

					$group_title = isset($cfg['group_title']) ? (string)$cfg['group_title'] : __('Relations', 'ACF Fields');
					$menu_order  = isset($cfg['menu_order']) ? (int)$cfg['menu_order'] : 20;

					acf_add_local_field_group([
						'key'                   => 'grp_rel_' . $from . '_to_' . $to,
						'title'                 => $group_title,
						'position'              => 'normal',
						'style'                 => 'default',
						'menu_order'            => $menu_order,
						'fields' => [[
							'key'           => 'fld_' . $from . '_' . $field_from,
							'name'          => $field_from,
							'label'         => $label_from,
							'type'          => 'relationship',
							'post_type'     => [$to],
							'filters'       => ['','',''],
							'elements'      => ['post_type'],
							'return_format' => 'id',
						]],
						'location' => [[[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => $from,
						]]],
						'active' => true,
					]);

					acf_add_local_field_group([
						'key'                   => 'grp_rel_' . $to . '_to_' . $from,
						'title'                 => $group_title,
						'position'              => 'normal',
						'style'                 => 'default',
						'menu_order'            => $menu_order,
						'fields' => [[
							'key'           => 'fld_' . $to . '_' . $field_to,
							'name'          => $field_to,
							'label'         => $label_to,
							'type'          => 'relationship',
							'post_type'     => [$from],
							'filters'       => ['','',''],
							'elements'      => ['post_type'],
							'return_format' => 'id',
						]],
						'location' => [[[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => $to,
						]]],
						'active' => true,
					]);

					add_filter('acf/update_value/name=' . $field_from, function ($value, $post_id) use ($field_from, $field_to) {
						return _pr_sync_bidirectional($value, $post_id, $field_from, $field_to);
					}, 10, 2);


					add_filter('acf/update_value/name=' . $field_to, function ($value, $post_id) use ($field_from, $field_to) {
						return _pr_sync_bidirectional($value, $post_id, $field_to, $field_from);
					}, 10, 2);

					$add_after_title = function(array $cols, string $key, string $label): array {
						$out = [];
						foreach ($cols as $k => $v) {
							$out[$k] = $v;
							if ($k === 'title') $out[$key] = $label;
						}
						if (!isset($out[$key])) $out[$key] = $label;
						return $out;
					};

					add_filter("manage_{$from}_posts_columns", function($cols) use ($field_from, $label_from, $add_after_title){
						return $add_after_title($cols, $field_from, $label_from);
					});
					add_action("manage_{$from}_posts_custom_column", function($column, $post_id) use ($field_from){
						if ($column !== $field_from) return;
						$ids = (array) get_field($field_from, $post_id, false);
						$ids = array_values(array_filter(array_map('intval', $ids)));
						echo _pr_admin_rel_links($ids);
					}, 10, 2);

					add_filter("manage_{$to}_posts_columns", function($cols) use ($field_to, $label_to, $add_after_title){
						return $add_after_title($cols, $field_to, $label_to);
					});
					add_action("manage_{$to}_posts_custom_column", function($column, $post_id) use ($field_to){
						if ($column !== $field_to) return;
						$ids = (array) get_field($field_to, $post_id, false);
						$ids = array_values(array_filter(array_map('intval', $ids)));
						echo _pr_admin_rel_links($ids);
					}, 10, 2);
				}

				add_action('admin_head-edit.php', function () {
					$screen = get_current_screen();
					if (!$screen) return;
					echo '<style>
                .wp-list-table .column-linked_subjects,
                .wp-list-table .column-linked_teachers,
                .wp-list-table [class^="column-linked_"]{
                    width:40%;
                    max-width:640px;
                    white-space:normal;
                    word-break:break-word;
                    line-height:1.35;
                }
                </style>';
				});
			});
		}
	}

	if (!function_exists('_pr_sync_bidirectional')) {
		function _pr_sync_bidirectional($value, $post_id, string $this_field, string $other_field)
		{
			static $guard = false;
			if ($guard) return $value;
			$guard = true;

			$new_ids  = array_filter(array_map('intval', is_array($value) ? $value : []));
			$prev_ids = get_post_meta($post_id, $this_field, true);
			$prev_ids = is_array($prev_ids) ? array_filter(array_map('intval', $prev_ids)) : [];

			$to_add    = array_diff($new_ids, $prev_ids);
			$to_remove = array_diff($prev_ids, $new_ids);

			foreach ($to_add as $other_id) {
				$list = get_post_meta($other_id, $other_field, true);
				$list = is_array($list) ? array_map('intval', $list) : [];
				if (!in_array((int)$post_id, $list, true)) {
					$list[] = (int)$post_id;
					update_post_meta($other_id, $other_field, array_values(array_unique($list)));
				}
			}


			foreach ($to_remove as $other_id) {
				$list = get_post_meta($other_id, $other_field, true);
				$list = is_array($list) ? array_map('intval', $list) : [];
				$new  = array_values(array_diff($list, [(int)$post_id]));
				update_post_meta($other_id, $other_field, $new);
			}

			$guard = false;
			return $new_ids;
		}
	}

	if (!function_exists('_pr_admin_rel_links')) {
		function _pr_admin_rel_links(array $ids): string
		{
			if (!$ids) return '—';
			$links = [];
			foreach ($ids as $id) {
				$t = get_the_title($id);
				if ($t === '') $t = 'ID ' . $id;
				$links[] = '<a href="' . esc_url(get_edit_post_link($id)) . '">' . esc_html($t) . '</a>';
			}
			return implode(', ', $links);
		}
	}
