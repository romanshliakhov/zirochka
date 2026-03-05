<?php function display_services_card( $post_id ) {
	if ( ! $post_id ) {
		return;
	}

	$title   = get_the_title( $post_id );
	$excerpt = get_the_excerpt( $post_id );
	$content = get_the_content( null, false, $post_id );
	$thumb   = get_the_post_thumbnail( $post_id, 'full' ); ?>

    <div class="info-card">
		<?php if ( $thumb ) : ?>
            <div class="info-card__thumb">
				<?php echo $thumb; ?>
            </div>
		<?php endif; ?>

        <div class="info-card__body">
            <span class="info-card__title"><?= $title; ?></span>
            <p><?= $excerpt; ?></p>
            <a href="<?= get_the_permalink() ?>" class="main-button main-button--transparent">
                <?= __('Read More', THEME_SLUG)?>
            </a>
        </div>
    </div>

	<?php
}
