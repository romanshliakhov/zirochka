<?php
    $shower       = get_sub_field('shower');
    $breadcrumbs  = get_sub_field('breadcrumbs');
    $image        = get_sub_field('image');
    $editor       = get_sub_field('editor');


    if (!$shower) : ?>
        <section class="section-vizualization">
            <div class="container">
                <div class="section-vizualization__wrapp">
                    <?php if ($breadcrumbs) {
                        get_breadcrumbs();
                    } ?>

                    <?= display_image($image, 460, 500, 'section-vizualization__image') ?>

                    <div class="section-vizualization__box">
                        <div class="section-vizualization__info">
                            <?php if (!empty($editor)) : ?>
                                <div class="editor">
                                    <?= $editor; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
