<?php
    $shower     = get_sub_field('shower');
    $left_group = get_sub_field('left');
    $image      = get_sub_field('image');

    $icon   = $left_group['icon'] ?? '';
    $editor = $left_group['editor'] ?? '';
    $link   = $left_group['link'] ?? '';

    if (!$shower) : ?>
        <section class="section-gift">
            <div class="container">
                <div class="section-gift__wrapp">
                    <div class="section-gift__info">
                        <?= display_image($icon, 32, 32, 'section-gift__icon') ?>

                        <?php if (!empty($editor)) : ?>
                            <div class="editor">
                                <?= $editor; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($left_group['list'])) : ?>
                            <ul class="gift-list">
                                <?php foreach ($left_group['list'] as $item) :
                                    $item_icon = $item['icon'];
                                    $item_text = $item['text'];
                                ?>
                                    <li class="gift-list__item">
                                        <?php if ($item_icon) : ?>
                                            <?= display_image($item_icon, 35, 35, 'gift-list__icon'); ?>
                                        <?php endif; ?>

                                        <?php if ($item_text) : ?>
                                            <span class="gift-list__text"><?= esc_html($item_text); ?></span>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>


                        <?php if (!empty($link)) :
                            $link_url    = $link['url'];
                            $link_title  = $link['title'];
                            $link_target = $link['target'] ?: '_self';
                        ?>
                            <a class="button button--red" href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>">
                                <?= esc_html($link_title); ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <?= display_image($image, 460, 500, 'section-gift__image') ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
