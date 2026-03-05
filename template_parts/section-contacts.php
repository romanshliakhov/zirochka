<?php
    $shower       = get_sub_field('shower');

    // Получаем содержимое групп
    $left_group   = get_sub_field('left');
    $right_group  = get_sub_field('right');

    $editor       = $left_group['editor'] ?? '';
    $editor_form  = $right_group['editor_form'] ?? '';

    $map_shower       = get_sub_field('map_shower');
    $editor_map       = get_sub_field('editor_map');

    if (!$shower) : ?>
        <section class="section-contacts">
            <div class="container">
                <div class="section-contacts__wrapp">
                    <div class="section-contacts__box">
                        <div class="section-contacts__info">
                            <?php if (!empty($editor)) : ?>
                                <div class="section-contacts__editor editor">
                                    <?= $editor; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($editor_form)) : ?>
                            <div class="section-contacts__right">
                                <div class="editor">
                                    <?= $editor_form; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($map_shower) : ?>
                        <div class="section-contacts__map">
                            <?php if (!empty($editor_map)) : ?>
                                <div class="editor">
                                    <?= $editor_map; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>



   