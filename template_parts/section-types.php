<?php
    $shower     = get_sub_field('shower');
    $estate_types = get_sub_field('estate_types'); 

    if (!$shower) : ?>
        <section class="section-types">
            <?php if ($estate_types) : ?>
                <ul class="section-types__items">
                    <?php foreach ($estate_types as $item) :
                        $image   = $item['image'];
                        $heading  = $item['heading'];
                    ?>
                        <li class="section-types__item" data-parallax-wrapper>
                            <?php if (!empty($heading)) : ?>
                                <div class="section-types__item-heading">
                                    <?= $heading; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($image)) : ?>
                                <div class="section-types__item-image">
                                    <?= wp_get_attachment_image($image['ID'], 'full', false, [
                                        'data-parallax-target' => '', // Добавляет атрибут к тегу <img>
                                    ]); ?>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    <?php endif; ?>
