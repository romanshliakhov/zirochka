<?php
    $shower      = get_sub_field('shower');
    $editor      = get_sub_field('editor');
    $posts       = get_sub_field('slides');

    if (!$shower) : ?>
        <section class="section-financial">
            <div class="decor-lines"></div>

            <div class="container">
                <div class="section-financial__wrapp">
                    <div class="section-financial__inner"><!-- ⬅️ Добавили обертку -->
                        <div class="section-financial__box">
                            <div class="editor"><?= $editor ?></div>

                            <?php if ($posts) : ?>
                                <div class="section-financial__items">
                                    <?php foreach ($posts as $item) :
                                        $icon   = $item['icon'];
                                        $heading = $item['heading'];
                                        $title = $item['name'];
                                        $description = $item['description'];
                                        ?>
                                        <div class="financial-card">
                                            <div class="financial-card__item">
                                                <div class="financial-card__top">
                                                    <?php if ($icon) : ?>
                                                        <div class="financial-card__icon">
                                                            <?= wp_get_attachment_image($icon['ID'], 'full'); ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($heading) : ?>
                                                        <span class="financial-card__heading"><?= esc_html($heading); ?></span>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="financial-card__info items-list__info">
                                                    <?php if ($title) : ?>
                                                        <div class="financial-card__title"><?= $title ?></div>
                                                    <?php endif; ?>

                                                    <?php if ($description) : ?>
                                                        <p class="financial-card__text"><?= esc_html($description); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($posts) : ?>
                            <div class="section-financial__bottom">
                                <ul class="section-financial__counter" style="--col-counter: <?php echo count($posts) ?>;">
                                    <?php foreach ($posts as $item) :
                                        $title = $item['name'];
                                        ?>
                                        <li class="li">
                                            <?php if ($title) : ?>
                                                <span><?= $title ?></span>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <span class="section-financial__progressbar">
                                    <span class="section-financial__progressbar-fill"></span>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
