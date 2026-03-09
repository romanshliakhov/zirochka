<?php
$shower = get_sub_field('shower');
$bg = get_sub_field('bg');
$editor = get_sub_field('editor');
$title = get_sub_field('title');

if (!$shower) : ?>
    <section class="about-section">
        <?php if ($bg): ?>
            <?= display_image($bg, 1920, 500, 'about-section__bg'); ?>
        <?php endif; ?>
        <div class="container">
            <div class="about-section__box">
                <div class="editor">
                    <?php if (!empty($title)) : ?>
                        <h2 class="h1">
                            <i class="sprite">
                                <?php sprite(29, 28, 'star_icon') ?>
                            </i>
                            <?= esc_html($title); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($editor)) : ?>
                        <?= wp_kses_post($editor); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
