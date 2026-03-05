<?php
    $shower = get_sub_field('shower');
    $editor = get_sub_field('editor');

    // Получаем все посты CPT `buildings`
    $args = array(
        'post_type'      => 'buildings',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    );
    $postsSlider = get_posts($args);

    if (!$shower): ?>
        <section class="section-building">
            <div class="container">
                <div class="section-building__wrapp">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($postsSlider): ?>
                        <div class="section-building__slider">
                            <div class="swiper-container">
                                <ul class="swiper-wrapper">
                                    <?php foreach ($postsSlider as $post):
                                        $post_id     = $post->ID;
                                        $image       = get_field('image', $post_id);
                                        $left        = get_field('left', $post_id);
                                        $title       = $left['title'] ?? '';
                                        $description = $left['description'] ?? '';
                                        ?>
                                        <li class="swiper-slide">
                                            <div class="building-card">
                                                <div class="building-card__info">
                                                    <div class="building-card__box">
                                                        <?php if ($title): ?>
                                                            <div class="building-card__title"><?= esc_html($title); ?></div>
                                                        <?php endif; ?>

                                                        <?php if ($description): ?>
                                                            <div class="building-card__descr"><?= esc_html($description); ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <?= display_image($image, 458, 442, 'building-card__image'); ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="section-building__controls">
                                <button class="slider-btn prev">
                                    <?php sprite(32, 32, 'ArrowLeft') ?>
                                </button>
                                <button class="slider-btn next">
                                    <?php sprite(32, 32, 'ArrowRight') ?>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
