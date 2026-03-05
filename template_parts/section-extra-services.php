<?php
    $shower       = get_sub_field('shower');
    $editor       = get_sub_field('editor');
    $list         = get_sub_field('services');


    if (!$shower) : ?>
        <section class="section-extra">
            <div class="container">
                <div class="section-extra__wrapp">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($list) : ?>
                        <ul class="section-extra__items">
                            <?php foreach ($list as $item) :
                                $item_editor = $item['editor'];
                                $image       = $item['image'];
                            ?>
                                <li class="section-extra__item">
                                    <?php if (!empty($item_editor)) : ?>
                                        <div class="section-extra__item-editor editor">
                                            <?= wp_kses_post($item_editor); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($image) : ?>
                                        <?= display_image($image, 991, 557, 'section-extra__item-image'); ?>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
