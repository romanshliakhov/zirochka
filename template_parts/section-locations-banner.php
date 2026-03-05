<?php
    $shower       = get_sub_field('shower');
    $breadcrumbs  = get_sub_field('breadcrumbs');
    $image        = get_sub_field('image');
    $editor       = get_sub_field('editor');


    if (!$shower) : ?>
        <section class="section-locations-banner">
            <div class="container">
                <div class="section-locations-banner__wrapp">
                    <?php if ($breadcrumbs) {
                        get_breadcrumbs();
                    } ?>

                    <?= display_image($image, 1856, 909, 'section-locations-banner__image') ?>

                    <div class="section-locations-banner__box">
                        <div class="section-locations-banner__info">
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
