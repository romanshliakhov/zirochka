<?php
    $shower       = get_sub_field('shower');
    $breadcrumbs  = get_sub_field('breadcrumbs');
    $image        = get_sub_field('image');
    $editor       = get_sub_field('editor');


    if (!$shower) : ?>
        <section class="section-projects-banner">
            <div class="container">
                <div class="section-projects-banner__wrapp">
                    <?php if ($breadcrumbs) {
                        get_breadcrumbs();
                    } ?>

                    <?= display_image($image, 460, 500, 'section-projects-banner__image') ?>

                    <div class="section-projects-banner__box">
                        <div class="section-projects-banner__info">
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
