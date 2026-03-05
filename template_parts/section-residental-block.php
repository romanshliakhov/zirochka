<?php
    $shower     = get_sub_field('shower');
    $list       = get_sub_field('list');
    $editor     = get_sub_field('editor');
    $image_bg      = get_sub_field('image_bg');
 

    if (!$shower) : ?>
        <section class="section-residental-block">
            <div class="container">
                <div class="section-residental-block__inner">

                    <?php if ($list) : ?>
                        <ul class="residental-list">
                            <?php foreach ($list as $item) :
                                $item_image = $item['image'];
                                $text = $item['title'];
                                $descr = $item['descr'];
                            ?>
                                <li class="residental-list__item">
                                    <div class="residental-list__image">
                                        <?= display_image( $item_image, 602, 203 ) ?>
                                    </div>

                                    <?php if ($text) : ?>
                                        <span class="residental-list__title"><?= $text; ?></span>
                                    <?php endif; ?>

                                    <?php if ($descr) : ?>
                                        <p class="residental-list__descr"><?= $descr; ?></p>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>


                    <div class="section-residental-block__wrapp">
                        <?= display_image($image_bg, 1856, 637, 'section-residental-block__bg') ?>

                        <div class="section-residental-block__box">
                            <div class="editor">
                                <?=$editor?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
