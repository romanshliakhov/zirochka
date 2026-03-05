<?php
	if (function_exists('acf_add_local_field_group')) {

		acf_add_local_field_group(array(
			'key' => 'group_filter_settings',
			'title' => 'Настройки фильтров товаров',
			'fields' => array(
				array(
					'key' => 'field_filters',
					'label' => 'Фильтры',
					'name' => 'filters',
					'type' => 'repeater',
					'instructions' => 'Добавьте фильтры, которые будут использоваться для товаров',
					'required' => 0,
					'collapsed' => 'field_filter_name',
					'min' => 0,
					'max' => 0,
					'layout' => 'table',
					'button_label' => 'Добавить фильтр',
					'sub_fields' => array(
						array(
							'key' => 'field_filter_name',
							'label' => 'Название фильтра',
							'name' => 'filter_name',
							'type' => 'text',
							'instructions' => 'Введите название фильтра',
							'required' => 1,
						),
						array(
							'key' => 'field_filter_type',
							'label' => 'Тип фильтра',
							'name' => 'filter_type',
							'type' => 'select',
							'instructions' => 'Выберите тип фильтра (checkbox)',
							'required' => 1,
							'choices' => array(
								'checkbox' => 'Checkbox',
							),
							'default_value' => 'checkbox',
							'ui' => 1,
						),
						array(
							'key' => 'field_meta_key',
							'label' => 'Мета-ключ',
							'name' => 'meta_key',
							'type' => 'text',
							'instructions' => 'Введите уникальный мета-ключ для фильтра (например, "panel_type")',
							'required' => 1,
						),
						array(
							'key' => 'field_filter_values',
							'label' => 'Значения фильтра',
							'name' => 'filter_values',
							'type' => 'repeater',
							'instructions' => 'Добавьте значения фильтра (например, типы панелей: монокристаллическая, поликристаллическая)',
							'required' => 0,
							'collapsed' => 'field_value',
							'min' => 0,
							'max' => 0,
							'layout' => 'table',
							'button_label' => 'Добавить значение',
							'sub_fields' => array(
								array(
									'key' => 'field_value',
									'label' => 'Значение',
									'name' => 'value',
									'type' => 'text',
									'instructions' => 'Введите значение фильтра (например, монокристаллическая, поликристаллическая)',
									'required' => 1,
								),
							),
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'acf-options-filter-settings', // Уникальный идентификатор страницы опций
					),
				),
			),
		));
	}



//	------


	function create_dynamic_meta_fields() {
		$filters = get_field('filters', 'option');

		if ($filters) {
			acf_add_local_field_group(array(
				'key' => 'group_product_custom_fields',
				'title' => 'Характеристики товаров',
				'fields' => array(),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => ' пост ',
						),
					),
				),
			));

			foreach ($filters as $filter) {
				if ($filter['filter_type'] === 'checkbox') {
					$meta_key = $filter['meta_key'];
					$field_label = $filter['filter_name'];

					$field_config = array(
						'key' => 'field_' . $meta_key,
						'label' => $field_label,
						'name' => $meta_key,
						'type' => 'checkbox',
						'choices' => array(),
						'parent' => 'group_product_custom_fields',
					);

					if (isset($filter['filter_values']) && is_array($filter['filter_values'])) {
						foreach ($filter['filter_values'] as $value) {
							$field_config['choices'][$value['value']] = $value['value'];
						}
					}

					if (function_exists('acf_add_local_field')) {
						acf_add_local_field($field_config);
					}
				}
			}
		}
	}
	add_action('acf/init', 'create_dynamic_meta_fields');

	