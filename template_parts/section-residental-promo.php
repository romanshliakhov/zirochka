<?php
    $shower     = get_sub_field('shower');
    $left_group = get_sub_field('left');
    $image      = get_sub_field('image');

    $icon   = $left_group['icon'] ?? '';
    $editor = $left_group['editor'] ?? '';

    if (!$shower) : ?>
        <section class="section-promo">
            <div class="container">
                <div class="section-promo__wrapp">
                    <div class="section-promo__info">
                        <?= display_image($icon, 32, 32, 'section-promo__icon') ?>

                        <?php if (!empty($editor)) : ?>
                            <div class="editor">
                                <?= $editor; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?= display_image($image, 460, 500, 'section-promo__image') ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
