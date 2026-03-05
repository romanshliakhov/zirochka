<?php
    $shower       = get_sub_field('shower');
    $list         = get_sub_field('blocks');

    if (!$shower) : ?>
        <section class="section-blocks">
            <div class="container">
                <?php if ($list) : ?>
                    <ul class="section-blocks__items">
                        <?php foreach ($list as $item) :
                            $item_editor = $item['editor'];
                            $image       = $item['image'];
                        ?>
                            <li class="section-blocks__item">
                                <?php if (!empty($item_editor)) : ?>
                                    <div class="section-blocks__item-editor editor">
                                        <?= wp_kses_post($item_editor); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($image) : ?>
                                    <?= display_image($image, 991, 557, 'section-blocks__item-image'); ?>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
