<?php
    $shower       = get_sub_field('shower');
    $editor       = get_sub_field('editor');
    $title = get_the_title();
    $date = get_the_modified_date('d.m.y');

    if (!$shower) : ?>
        <section class="policy-section">
            <div class="container">
                <div class="policy-section__top">
                    <h1><?= esc_html($title); ?></h1>

                     <span class="policy-section__info">
                        <i class="sprite"><?php sprite(16, 16, 'calendar') ?></i>
                        <?= esc_html($date); ?>
                    </span>
                </div>
                <?php if (!empty($editor)) : ?>
                    <div class="editor">
                        <?= $editor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
