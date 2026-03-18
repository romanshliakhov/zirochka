<?php
$shower = get_sub_field('shower');

$image = get_sub_field('image');
$editor = get_sub_field('editor');
$title = get_sub_field('title');

if (!$shower) : ?>
    <section class="quote-section">
        <div class="quote-section__bg">
            <img width="317" height="745"
                 src="<?= esc_url(get_template_directory_uri() . '/assets/img/Mazepa_quote_bg.png'); ?>"
                 loading="lazy"/>
        </div>
        <div class="container">
            <div class="quote-section__box">
                    <?= display_image($image, 242, 242, 'quote-section__image') ?>

                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= wp_kses_post($editor); ?>
                        </div>
                    <?php endif; ?>
            </div>
        </div>
    </section>


<?php endif; ?>
