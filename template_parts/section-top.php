<?php
    $shower       = get_sub_field('shower');
    $breadcrumbs  = get_sub_field('breadcrumbs');
    $image        = get_sub_field('image');
    $title        = get_sub_field('title');


    if (!$shower) : ?>
        <section class="section-top">
            <?= display_image($image, 1762, 617, 'section-top__image') ?>

            <div class="container">
                <div class="section-top__wrapp">
                    <?php if ($breadcrumbs) {
                        get_breadcrumbs();
                    } ?>

                    <?php if (!empty($title)) : ?>
                        <h1 class="section-top__title">
                            <?= $title; ?>
                        </h1>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
