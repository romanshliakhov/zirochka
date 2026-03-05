<?php
    $shower         = get_sub_field('shower');
    $editor         = get_sub_field('editor');
    $image         = get_sub_field('image');
    $list           = get_sub_field('list');

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

                        <?php if (!empty($image)): ?>
                            <?= display_image($image, 991, 557, 'section-info__media') ?>
                        <?php endif; ?>
                    </div>

                    <?php if ($list) : ?>
                        <ul class="info-list">
                            <?php foreach ($list as $item) :
                                $icon   = $item['icon'];
                                $heading    = $item['heading'];
                                $text    = $item['text'];
                            ?>
                                <li class="info-list__box">
                                    <?php if (!empty($item['icon'])): ?>
                                        <?= display_image($item['icon'], 64, 64);?>
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
