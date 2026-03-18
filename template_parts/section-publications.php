<?php
    $shower     = get_sub_field('shower');
    $news_posts = get_sub_field('news'); // relationship (IDs)
    $title = get_sub_field('editor');

    $selected_ids = is_array($news_posts) ? $news_posts : [];
    $posts        = [];

    // ==================================
    // 📰 Новости для слайдера
    // Логика:
    // 1. Выбранные в ACF — первыми (ручной порядок)
    // 2. Остальные — последние по дате
    // ==================================

    if (!empty($selected_ids)) {
        // 1️⃣ Выбранные (ручной порядок из relationship)
        $selected_query = new WP_Query([
            'post_type'      => 'news',
            'post__in'       => $selected_ids,
            'orderby'        => 'post__in',
            'posts_per_page' => -1,
        ]);

        $posts = $selected_query->posts;

        // 2️⃣ Остальные — автоматически последние по дате
        $latest_query = new WP_Query([
            'post_type'      => 'news',
            'post__not_in'   => $selected_ids,
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        $posts = array_merge($posts, $latest_query->posts);
    } else {
        // Если ничего не выбрано — просто все последние
        $all_query = new WP_Query([
            'post_type'      => 'news',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        $posts = $all_query->posts;
    }

	
	if ( ! $shower ) : ?>
        <section class="publications-section" >
            <div class="container">
                <div class="publications-section__box">
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
                    
                    <?php if (!empty($posts)) : ?>
                        <div class="publications-section__slider">
                            <div class="swiper-container">
                                <ul class="swiper-wrapper">
                                    <?php foreach ($posts as $post) : setup_postdata($post); ?>
                                        <?php
                                        $post_id   = $post->ID;
                                        $title     = get_the_title($post_id);
                                        $permalink = get_permalink($post_id);
                                        $thumb_id  = get_post_thumbnail_id($post_id);
                                        $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
                                        $alt       = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';


                                        $authors = get_field('authors', $post_id);

                                        $authors = get_field('authors', $post_id);
                                        $authors_list = [];

                                        $authors_text = '';

                                        if ($authors) {
                                            $author_id = is_object($authors[0]) ? $authors[0]->ID : $authors[0];
                                            $author_name = get_the_title($author_id);        // имя автора
                                            $birth_year  = get_field('birth_year', $author_id); // год

                                            $authors_text = $birth_year && is_numeric($birth_year) ? "{$author_name} {$birth_year}" : $author_name;
                                        }
                                        ?>

                                        <li class="swiper-slide">
                                            <a class="publications-card" href="<?= esc_url($permalink); ?>">
                                                <?php if ($thumb_url): ?>
                                                    <div class="publications-card__thumb">
                                                        <img src="<?= esc_url($thumb_url); ?>" alt="<?= esc_attr($alt ?: $title); ?>" loading="lazy">
                                                    </div>
                                                <?php endif; ?>

                                                <div class="publications-card__body">
                                                    <span class="h2"><?= esc_html($title); ?></span>
                                                    <?php if ($authors_text): ?>
                                                        <p><?= esc_html($authors_text); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>

                                    <?php wp_reset_postdata(); ?>
                                </ul>
                            </div>

                            <div class="slider-controls red">
                                <div class="slider-btn prev">
                                    <?php sprite(32, 32, 'arrow-l'); ?>
                                </div>
                                <div class="slider-btn next">
                                    <?php sprite(32, 32, 'arrow-r'); ?>
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

	<?php endif; ?>