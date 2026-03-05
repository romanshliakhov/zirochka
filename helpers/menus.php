<?php
	function register_my_menus() {
		register_nav_menus(
			array(
				'header_nav' => 'Header Navigation',
				'footer_nav' => 'Footer Navigation'
			)
		);
	}

	add_action( 'after_setup_theme', 'register_my_menus' );

	class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
		private $current_item_id = '';

		public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
			$indent       = str_repeat("\t", $depth);
			$classes      = empty($item->classes) ? [] : (array) $item->classes;
			$class_names  = esc_attr(join(' ', array_filter($classes)));
			$id_attr      = 'menu-item-' . $item->ID;
			$this->current_item_id = $item->ID;

			// === ACF иконка
			$icon = get_field('icon', $item->ID);
			$icon_html = '';
			if ($icon) {
				ob_start();
				display_image($icon, 20, 20);
				$icon_html = ob_get_clean();
			}

			$svg_icon = '<i class="icon-arrow-down"></i>';
			$text_html = '<span class="menu-text">' . esc_html($item->title) . '</span>';


			if (!empty($item->url)) {
				$link = '<a href="' . esc_url($item->url) . '" class="menu-link">' . $icon_html . $text_html . '</a>';
			} else {
				$link = '<span class="menu-link">' . $icon_html . $text_html . '</span>';
			}


			$button = '';
			if (in_array('menu-item-has-children', $classes)) {
				$button = '<button type="button" aria-label="Sub menu" data-id="' . esc_attr($item->ID) . '" class="menu-button">' . $svg_icon . '</button>';
			}

			// === Обёртка li
			$output .= $indent . '<li id="' . esc_attr($id_attr) . '" class="' . $class_names . '">' . $link . $button;
		}

		public function start_lvl( &$output, $depth = 0, $args = [] ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n" . $indent . '<ul class="sub-menu" data-content="' . esc_attr($this->current_item_id) . '">' . "\n";
		}
	}


	function add_custom_walker_nav_menu( $args ) {
		$args['walker'] = new Custom_Walker_Nav_Menu();

		return $args;
	}

	add_filter( 'wp_nav_menu_args', 'add_custom_walker_nav_menu' );


	function custom_admin_css() {
		echo '<style>
        #add-category, #add-post-type-modals {
            display: none !important;
        }
        
       	#add-post-type-post,
        #add-post-type-product {
        	display: block !important;
        }
    </style>';
	}

	add_action( 'admin_head', 'custom_admin_css' );


