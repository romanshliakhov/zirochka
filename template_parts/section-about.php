<?php
    $shower      = get_sub_field('shower');
    $breadcrumbs = get_sub_field('breadcrumbs');
    $slider      = get_sub_field('slider');

    if (!$shower) : ?>
        <section class="section-about">
            <div class="container">
                <div class="section-about__wrapp">
                    <?php if ($breadcrumbs) {
                        get_breadcrumbs();
                    } ?>

                    <?php if ($slider) : ?>
                        <div class="section-about__slider">
                            <div class="swiper-container">
                                <ul class="swiper-wrapper">
                                    <?php foreach ($slider as $index => $item) :
                                        $left     = $item['left'] ?? [];
                                        $image    = $left['image'] ?? null;
                                        $image_mob    = $left['image_mob'] ?? null;
                                        $editor   = $left['editor'] ?? '';
                                        $show_label = $item['label'] ?? false;
                                        $role     = $item['role'] ?? '';
                                        $name     = $item['name'] ?? '';
                                    ?>
                                        <li class="swiper-slide">
                                            <div class="slider-card">
                                                <?php if ($image) : ?>
                                                    <div class="slider-card__image img-desk">
                                                        <?= wp_get_attachment_image($image['ID'], 'full'); ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($image_mob) : ?>
                                                    <div class="slider-card__image img-mob">
                                                        <?= wp_get_attachment_image($image_mob['ID'], 'full'); ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($editor) : ?>
                                                    <div class="slider-card__editor editor">
                                                        <?= $editor; ?>
                                                    </div>
                                                <?php endif; ?>

                                                    <?php if ($index === 0 && $show_label) : ?>
                                                        <div class="slider-card__right">
                                                            <div class="slider-card__box">
                                                                <div class="slider-card__info">
                                                                    <?php if ($role) : ?>
                                                                        <p class="slider-card__role"><?= esc_html($role); ?></p>
                                                                    <?php endif; ?>
                                                                    <?php if ($name) : ?>
                                                                        <span class="slider-card__name"><?= esc_html($name); ?></span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                                <div class="section-about__controls">
                                    <div class="slider-btn prev">
                                        <?php sprite(32, 32, 'ArrowLeft'); ?>
                                    </div>
                                    <div class="slider-btn next">
                                        <?php sprite(32, 32, 'ArrowRight'); ?>
                                    </div>
                                </div>

                                <span class="swiper-pagination"></span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
