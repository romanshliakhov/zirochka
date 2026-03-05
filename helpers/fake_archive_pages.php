<?php
// 🔧 1. Specify supported CPTs
	add_filter('fake_archive_supported_post_types', function () {
		return ['services', 'news'];
	});

// 🧩 2. Option and UI
	add_action('admin_menu', function () {
		add_options_page(
			'Post Type Archives',
			'CPT Archives',
			'manage_options',
			'fake_archives',
			'render_fake_archives_settings_page'
		);
	});

// ✅ 3. Helper: get supported CPTs
	function get_supported_fake_archive_post_types() {
		return array_filter(apply_filters('fake_archive_supported_post_types', []));
	}

// ✅ 4. Settings UI
	function render_fake_archives_settings_page() {
		if ( ! current_user_can('manage_options') ) return;

		if (
			isset($_POST['fake_archives_nonce']) &&
			wp_verify_nonce($_POST['fake_archives_nonce'], 'save_fake_archives')
		) {
			update_option('custom_fake_archives', $_POST['fake_archives'] ?? []);
			echo '<div class="updated"><p>Saved successfully.</p></div>';
		}

		$fake_archives = get_option('custom_fake_archives', []);
		$supported_types = get_supported_fake_archive_post_types();
		$post_types = get_post_types([], 'objects');
		$pages = get_pages();
		?>

        <div class="wrap">
            <h1>CPT Archive Pages</h1>
            <form method="post">
				<?php wp_nonce_field('save_fake_archives', 'fake_archives_nonce'); ?>
                <table class="form-table">
					<?php foreach ($supported_types as $pt_name) :
						if ( ! isset($post_types[$pt_name]) ) continue;
						$pt = $post_types[$pt_name]; ?>
                        <tr>
                            <th scope="row"><?= esc_html($pt->label); ?></th>
                            <td>
                                <select name="fake_archives[<?= esc_attr($pt_name); ?>]">
                                    <option value="">— Not selected —</option>
									<?php foreach ($pages as $page) : ?>
                                        <option value="<?= esc_attr($page->ID); ?>" <?= selected($fake_archives[$pt_name] ?? '', $page->ID); ?>>
											<?= esc_html($page->post_title); ?>
                                        </option>
									<?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
					<?php endforeach; ?>
                </table>
				<?php submit_button(); ?>
            </form>
        </div>
		<?php
	}

// 🔐 5. Prevent deleting archive pages (even from Trash)
	add_action('before_delete_post', 'prevent_deletion_of_fake_archive_pages');
	add_action('wp_trash_post', 'prevent_deletion_of_fake_archive_pages');

	function prevent_deletion_of_fake_archive_pages($post_id) {
		if ( get_post_type($post_id) !== 'page' ) return;

		$archives = get_option('custom_fake_archives', []);
		if ( ! is_array($archives) ) return;

		if ( in_array($post_id, $archives) ) {
			wp_die(
				'This page is assigned as an archive for one of the post types. Please remove the assignment in the "CPT Archives" settings first.',
				'Deletion Forbidden',
				[
					'response' => 403,
					'back_link' => true
				]
			);
		}
	}

	function get_fake_archive_page($post_type) {
		$archives = get_option('custom_fake_archives', []);
		if ( isset($archives[$post_type]) ) {
			$page_id = intval($archives[$post_type]);
			return get_post($page_id);
		}
		return null;
	}

	add_filter('display_post_states', function($post_states, $post) {
		if ($post->post_type !== 'page') return $post_states;

		$fake_archives = get_option('custom_fake_archives', []);
		if (is_array($fake_archives)) {
			$post_types = get_post_types([], 'objects');

			foreach ($fake_archives as $cpt => $page_id) {
				if ((int) $page_id === $post->ID && isset($post_types[$cpt])) {
					$post_states["fake_archive_{$cpt}"] = 'Archive Page, ' . $post_types[$cpt]->labels->name;
				}
			}
		}

		return $post_states;
	}, 10, 2);


