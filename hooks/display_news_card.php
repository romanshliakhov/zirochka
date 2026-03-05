<?php
	function display_news_card($post_id) {
		if (!$post_id) return;

		$title     = get_the_title($post_id);
		$excerpt   = get_the_excerpt($post_id);
		$date      = get_the_date('d.m.Y', $post_id);
		$permalink = get_permalink($post_id);

		$thumb_id  = get_post_thumbnail_id($post_id);
		$thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
		$alt       = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
		?>

		<a class="news-card" href="<?= esc_url($permalink); ?>">
			<?php if ($thumb_url): ?>
				<div class="news-card__thumb">
					<div class="news-card__pubtime"><?= esc_html($date); ?></div>
					<img 
						src="<?= esc_url($thumb_url); ?>" 
						alt="<?= esc_attr($alt ?: $title); ?>"
						loading="lazy"
					>
				</div>
			<?php endif; ?>

			<div class="news-card__body">
				<span><?= esc_html($title); ?></span>
				<p><?= esc_html($excerpt); ?></p>
			</div>
		</a>
	<?php }