<?php
	/* ====================== Доступные инструменты  ======================

	CORE (TinyMCE / WP):
	- formatselect      - дефолтный format
	- bold              - жирный (<strong>)
	- italic            - курсив (<em>)
	- strikethrough     - зачеркнутый
	- blockquote        - цитата (<blockquote>)
	- alignleft         - выравнивание влево
	- aligncenter       - выравнивание по центру
	- alignright        - выравнивание вправо
	- alignjustify      - выравнивание по ширине
	- bullist           - маркированный список (<ul>)
	- numlist           - нумерованный список (<ol>)
	- outdent           - уменьшить отступ (сдвиг влево)
	- indent            - увеличить отступ (сдвиг вправо)
	- link              - вставить/редактировать ссылку
	- unlink            - убрать ссылку
	- removeformat      - очистить форматирование (span/inline-стили)
	- charmap           - спецсимволы
	- hr                - горизонтальная линия (<hr>)
	- undo              - отменить
	- redo              - повторить
	- forecolor         - цвет текста (палитра)
	- table             - таблица (вставка/редактирование)

	ДОПОЛНИТЕЛЬНЫЕ (если используешь отдельно):
	- font_family_select    - назначение FontFamily
	- tag_style_selector  	- назначение типографического класса на блок
	- textcase_elem       	- смена регистра текста (UPPER/lower/Capitalize)
	- underline_toggle_elem - переключатель подчеркивания (твой плагин)
	- small_toggle        	- переключатель <small> / класс small
	- icon_list           	- кастомный список span + icon
	- label_list         	- кастомный список span + icon + (модификаторы)
	- shortcode_button    	- вставка выбранного шорткода
	- table       			- генератор таблиц 2×2/3×3 и т.п. (если вместо core table)
	- aosanimate          	- диалог AOS: пишет data-aos*, duration/delay/offset/once/easing/anchor-placement на блок
	- smart_lists          	- диалог AOS: пишет data-aos*, duration/delay/offset/once/easing/anchor-placement на блок

	============================================================================================= */


	if (!function_exists('tools')) {
		function tools(array $buttons, ?string $name = null): string
		{
			static $registry = [];
			static $hooked   = false;

			$rows = [];
			$isMultiRow = !empty($buttons) && is_array(reset($buttons));
			if ($isMultiRow) {
				foreach ($buttons as $row) {
					$rows[] = array_values(array_unique(array_filter(array_map('strval', (array)$row))));
				}
			} else {
				$rows[] = array_values(array_unique(array_filter(array_map('strval', $buttons))));
			}

			$normalized = [];
			$i = 1;
			foreach ($rows as $row) {
				if ($row) {
					$normalized[$i++] = $row;
				}
			}

			if (!$normalized) {
				return '_empty_';
			}

			if ($name === null || $name === '') {
				$name = 'tb_' . substr(md5(wp_json_encode($normalized)), 0, 8);
			}

			$registry[$name] = $normalized;

			if (!$hooked) {
				add_filter('acf/fields/wysiwyg/toolbars', function ($toolbars) use (&$registry) {
					foreach ($registry as $key => $rows) {
						$toolbars[$key] = $rows;
					}
					return $toolbars;
				}, 10);
				$hooked = true;
			}

			return $name;
		}
	}
