<?php
	$shower  = get_sub_field( 'shower' );
    $image   = get_sub_field('image');
	$editor  = get_sub_field( 'editor' );
	$video_link  = get_sub_field( 'video_link' );
	
	if ( ! $shower ) : ?>
        <section class="section-approach" >
            <?= display_image($image, 460, 500, 'section-approach__bg') ?>

            <div class="container">
                <div class="section-approach__wrapp">
                    <div class="section-approach__box">
                        <div class="editor">
                            <?=$editor?>
                        </div>

                        <?php if (!empty($video_link)) : ?>
                            <a class="main-button main-button--red" data-fancybox="videos" href="<?= esc_url($video_link); ?>" data-video="true">Watch Video</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

	<?php endif; ?>