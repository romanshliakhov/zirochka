<?php
function display_post_card($post_id) {
	if (!$post_id) return;

	$title     = get_the_title($post_id);
	$excerpt   = get_the_excerpt($post_id);
	$thumb     = get_the_post_thumbnail($post_id, 'full');
	$date      = get_the_date('d.m.Y', $post_id);
	$permalink = get_permalink($post_id);
	?>

	<a class="post-card" href="<?= esc_url($permalink); ?>">
		<?php if ($thumb): ?>
			<div class="post-card__thumb">
				<div class="post-card__pubtime"><?= esc_html($date); ?></div>
				<?= $thumb; ?>
			</div>
		<?php endif; ?>

		<div class="post-card__body">
			<span><?= esc_html($title); ?></span>
			<p><?= esc_html($excerpt); ?></p>
		</div>
	</a>
<?php }