<?php
    $shower       = get_sub_field('shower');
    $label       = get_sub_field('label');
    $title       = get_sub_field('title');
    $list       = get_sub_field('list');
    $link       = get_sub_field('link');


    if (!$shower) : ?>
        <section class="section-objects">
            <div class="container">
                <div class="section-objects__wrapp">
                    <?php if (!empty($label) || !empty($title)) : ?>
                        <div class="section-objects__top">

                            <?php if (!empty($label)) : ?>
                                <div class="section-objects__label">
                                    <?= $label; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($title)) : ?>
                                <div class="section-objects__title">
                                    <?= $title; ?>
                                </div>
                            <?php endif; ?>

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

                    <?php if (!empty($link)) :
                        $link_url    = $link['url'];
                        $link_title  = $link['title'];
                        $link_target = $link['target'] ?: '_self';
                    ?>
                        <a class="button button--animated" href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>">
                            <?= esc_html($link_title); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
