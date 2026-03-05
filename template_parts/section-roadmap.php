<?php
    $shower       = get_sub_field('shower');
    $bg           = get_sub_field('background_color');
    $editor       = get_sub_field('editor');
    $list         = get_sub_field('items');
    ?>

    <?php if (!$shower) : ?>
        <section class="section-roadmap <?php echo $bg ? 'transparent' : ''; ?>">
            <div class="decor-lines"></div>
            <div class="container">
                <div class="section-roadmap__wrapp">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($list) : ?>
                        <ul class="section-roadmap__items">
                            <?php foreach ($list as $item) :
                                $counter = $item['counter'];
                                $image   = $item['image'];
                                $editor  = $item['editor'];
                            ?>
                                <li class="section-roadmap__item">
                                    <?php if (!empty($editor)) : ?>
                                        <div class="section-roadmap__item-editor editor">
                                            <?= $editor; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($counter)) : ?>
                                        <div class="section-roadmap__item-counter"><span><?= esc_html($counter); ?></span></div>
                                    <?php endif; ?>

                                    <?php if (!empty($image)) : ?>
                                        <div class="section-roadmap__item-image">
                                            <?= wp_get_attachment_image($image['ID'], 'full'); ?>
                                        </div>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
