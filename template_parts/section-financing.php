<?php
    $shower       = get_sub_field('shower');
    $breadcrumbs  = get_sub_field('breadcrumbs');
    $image        = get_sub_field('image');
    $editor       = get_sub_field('editor');


    if (!$shower) : ?>
        <section class="section-financing">
            <div class="container">
                <div class="section-financing__wrapp">
                    <?php if ($breadcrumbs) {
                        get_breadcrumbs();
                    } ?>

                    <?= display_image($image, 460, 500, 'section-financing__image') ?>

                    <div class="section-financing__box">
                        <div class="section-financing__info">
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
