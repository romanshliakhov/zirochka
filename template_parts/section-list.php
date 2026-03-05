<?php
    $shower         = get_sub_field('shower');
    $heading_block  = get_sub_field('heading-block');
    $editor         = get_sub_field('editor');
    $list           = get_sub_field('list');

    if (!$shower) : ?>
        <section class="section-list">
            <div class="container">
                <div class="section-list__inner">
                    <?php if (!empty($editor) && !$heading_block) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($list) : ?>
                        <ul class="items-list">
                            <?php foreach ($list as $item) :
                                $icon   = $item['icon'];
                                $heading = $item['heading'];
                                $title   = $item['title'];
                                $text    = $item['description'];
                            ?>
                                <li class="items-list__box">
                                    <div class="items-list__top">
                                        <?php if ($icon) : ?>
                                            <div class="items-list__icon">
                                                <?= wp_get_attachment_image($icon['ID'], 'full'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($heading) : ?>
                                            <span class="items-list__heading"><?= esc_html($heading); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="items-list__info">
                                        <?php if ($title) : ?>
                                            <div class="items-list__title"><?= esc_html($title); ?></div>
                                        <?php endif; ?>

                                        <?php if ($text) : ?>
                                            <p class="items-list__text"><?= esc_html($text); ?></p>
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
