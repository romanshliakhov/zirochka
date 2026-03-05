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
        <section class="section-info">
            <div class="container">
                <div class="section-info__inner">
                    <div class="section-info__box">
                        <?php if (!empty($editor)) : ?>
                            <div class="editor">
                                <?= $editor; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!$media_switcher && !empty($image)) : ?>
                            <?= display_image($image, 991, 557, 'section-info__media') ?>

                            <?php elseif ($media_switcher && !empty($poster) && !empty($video_link)) : ?>
                                <a class="section-info__media" data-fancybox="videos" href="<?= esc_url($video_link); ?>" data-video="true">
                                    <?= display_image($poster, 991, 557, 'section-info__poster') ?>
                                    <button class="section-info__play">
                                        <?php sprite(64, 64, 'Play'); ?>
                                    </button>
                                </a>
                        <?php endif; ?>
                    </div>


                    <?php if ($list) : ?>
                        <ul class="info-list">
                            <?php foreach ($list as $item) :
                                    $icon    = $item['icon'];
                                    $heading = $item['heading'];
                                    $text    = $item['text'];
                                ?>
                                <li class="info-list__box">
                                    <?php if (!empty($icon)) : ?>
                                        <?= display_image($icon, 64, 64); ?>
                                    <?php endif; ?>

                                    <div class="info-list__info">
                                        <?php if ($heading) : ?>
                                            <p class="info-list__heading"><?= esc_html($heading); ?></p>
                                        <?php endif; ?>

                                        <?php if ($text) : ?>
                                            <p class="info-list__text"><?= esc_html($text); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
