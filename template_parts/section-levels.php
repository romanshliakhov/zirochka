<?php
    $shower         = get_sub_field('shower');
    $editor         = get_sub_field('editor');
    $list           = get_sub_field('list');

    if (!$shower) : ?>
        <section class="section-levels">
            <div class="container">
                <div class="section-levels__inner">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($list) : ?>
                        <div class="section-levels__slider">
                            <div class="swiper-container">
                                <ul class="swiper-wrapper">
                                    <?php foreach ($list as $item) :
                                        $heading   = $item['heading'];
                                        $counter    = $item['counter'];
                                        $price    = $item['price'];
                                    ?>
                                        <li class="swiper-slide">
                                            <div class="level-card">
                                                <span class="level-card__counter"></span>
                                                <div class="level-card__top">
                                                    <?php if ($heading) : ?>
                                                        <span class="level-card__text"><?= esc_html($heading); ?></span>
                                                    <?php endif; ?>

                                                    <?php if ($counter) : ?>
                                                        <span class="level-card__number"><?= esc_html($counter); ?></span>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="level-card__info">
                                                    <p class="level-card__text">Recive up to</p>

                                                    <?php if ($price) : ?>
                                                        <span class="level-card__price"><?= esc_html($price); ?></span>
                                                    <?php endif; ?>

                                                    <p class="level-card__text">per deal</p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
