<?php
$shower = get_sub_field('shower');
$label  = get_sub_field('label');
$image  = get_sub_field('image');
$editor = get_sub_field('editor');

if (!$shower) : ?>
    <section class="section-additional-default">
        <div class="container">
            <div class="section-additional-default__box">
                <?php if (!empty($label)) : ?>
                    <div class="section-additional-default__label">
                        <?= esc_html($label); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($image)) : ?>
                    <div class="section-additional-default__image">
                        <?= display_image($image, 1856, 696); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($editor)) : ?>
                    <div class="section-additional-default__editor editor">
                        <?= $editor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
