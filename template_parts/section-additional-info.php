<?php
$shower         = get_sub_field('shower');
$editor         = get_sub_field('editor');
$media_content  = get_sub_field('media_content');
$list           = get_sub_field('list');

$media_switcher = $media_content['media_switcher'] ?? false;
$image          = $media_content['image'] ?? null;
$poster         = $media_content['poster'] ?? null;
$video_link     = $media_content['video_link'] ?? null;

    if (!$shower) : ?>
        <section class="section-additional-info">
            <div class="container">
                <div class="section-additional-info__inner">
                    <div class="section-additional-info__box">
                        <?php if (!empty($editor)) : ?>
                            <div class="editor">
                                <?= $editor; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!$media_switcher && !empty($image)) : ?>
                            <?= display_image($image, 991, 557, 'section-additional-info__media') ?>

                            <?php elseif ($media_switcher && !empty($poster) && !empty($video_link)) : ?>
                                <a class="section-additional-info__media" data-fancybox="videos" href="<?= esc_url($video_link); ?>" data-video="true">
                                    <?= display_image($poster, 991, 557, 'section-additional-info__poster') ?>
                                    <button class="section-additional-info__play">
                                        <?php sprite(64, 64, 'Play'); ?>
                                    </button>
                                </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
