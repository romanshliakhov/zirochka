<?php
    $shower         = get_sub_field('shower');
    $editor         = get_sub_field('editor');
    $list           = get_sub_field('list');

    if (!$shower) : ?>
        <section class="section-options">
            <div class="decor-lines"></div>
            <div class="container">
                <div class="section-options__inner">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($list) : ?>
                        <ul class="options-list">
                            <?php foreach ($list as $item) :
                                $icon   = $item['icon'];
                                $title   = $item['title'];
                                $text    = $item['text'];
                            ?>
                                <li class="options-list__box">
                                    <?php if ($icon) : ?>
                                        <div class="options-list__icon">
                                            <?= wp_get_attachment_image($icon['ID'], 'full'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="options-list__info">
                                        <?php if ($title) : ?>
                                            <div class="options-list__title"><?= esc_html($title); ?></div>
                                        <?php endif; ?>

                                        <?php if ($text) : ?>
                                            <p class="options-list__text"><?= esc_html($text); ?></p>
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
