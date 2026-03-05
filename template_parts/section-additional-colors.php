<?php
$shower = get_sub_field('shower');
$editor = get_sub_field('editor');
$colors = get_sub_field('colors');

if (!$shower) : ?>
    <section class="section-additional-colors">
        <div class="decor-lines"></div>
        <div class="container">
            <div class="section-additional-colors__wrapp">
                
                <?php if (!empty($editor)) : ?>
                    <div class="editor">
                        <?= $editor ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($colors)) : ?>
                    <ul class="colors-vars">
                        <?php foreach ($colors as $item) :
                            $color_image = $item['color_image'] ?? '';
                            $color_title = $item['color_title'] ?? '';
                        ?>
                            <li class="colors-vars__item">
                                <div class="color">
                                    <?php if (!empty($color_image)) : ?>
                                        <div class="color-image">
                                            <?= wp_get_attachment_image($color_image['ID'], 'full'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($color_title)) : ?>
                                        <span class="color-title"><?= esc_html($color_title); ?></span>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

            </div>
        </div>
    </section>
<?php endif; ?>
