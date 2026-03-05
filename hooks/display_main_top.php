<?php function display_main_top($title_tag = 'h1', $title, $editor, $class_mode = '') {
		$allowed_tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];

		if (!in_array($title_tag, $allowed_tags)) {
			$title_tag = 'h1';
		} ?>

        <div class="main-top <?= $class_mode;?>">
            <?php if ( $title ) : ?>
                <<?= esc_html($title_tag); ?> class="title"><?php echo $title ?></<?= esc_html($title_tag); ?>>
            <?php endif; ?>

            <?php if ( $editor ) : ?>
                <div class="editor"><?= wp_kses_post($editor); ?></div>
            <?php endif; ?>
        </div>
<?php } ?>
