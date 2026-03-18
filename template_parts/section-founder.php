<?php
$shower = get_sub_field('shower');

$image = get_sub_field('image');
$editor = get_sub_field('editor');
$title = get_sub_field('title');

if (!$shower) : ?>
    <section class="founder-section">
        <div class="container">
            <div class="founder-section__box">
                <?php if (!empty($title)) : ?>
                    <div class="editor">
                        <h2 class="h1">
                            <i class="sprite">
                                <?php sprite(29, 28, 'star_icon') ?>
                            </i>
                            <?= esc_html($title); ?>
                        </h2>
                    </div>
                <?php endif; ?>

                <div class="founder-section__inner">
                    <?= display_image($image, 242, 242, 'founder-section__image') ?>

                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= wp_kses_post($editor); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>


<?php endif; ?>
