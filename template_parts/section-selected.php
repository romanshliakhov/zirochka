<?php
$shower = get_sub_field('shower');
$editor = get_sub_field('editor');
$selected_ids = get_sub_field('selected_articles') ?: [];

if (!$shower) :

    // Получаем статьи
    $posts = [];
    if (!empty($selected_ids)) {
        $query = new WP_Query([
            'post_type' => 'articles',
            'post__in' => $selected_ids,
            'orderby' => 'post__in',
            'posts_per_page' => -1,
        ]);
        $posts = $query->posts;
    } else {
        $query = new WP_Query([
            'post_type' => 'articles',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
        ]);
        $posts = $query->posts;
    }

    if (!empty($posts)) :
        // Основная статья
        $main_post = array_shift($posts);
        $other_posts = $posts;
        setup_postdata($main_post);

        $post_id = $main_post->ID;
        $title = get_the_title($post_id);
        $permalink = get_permalink($post_id);
        $thumb_id = get_post_thumbnail_id($post_id);
        $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
        $alt = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
        $tags = get_the_terms($post_id, 'article_tag');
        $author_id = get_field('articles', $post_id)[0] ?? null;
        $author_name = '';
        if ($author_id) {
            $author_name = get_the_title($author_id);
            $author_link = get_permalink($author_id);
        }
        $excerpt = get_the_excerpt($post_id);
        $date = get_the_date('d.m.y', $post_id);
        $time_ago = custom_time_ago(get_post_time('U', true, $post_id));
        ?>

        <section class="selected-section">
            <div class="container">
                <div class="selected-section__box">

                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <h2 class="h1">
                                <i class="sprite"><?php sprite(29, 28, 'star_icon'); ?></i>
                                <?= esc_html($editor); ?>
                            </h2>
                        </div>
                    <?php endif; ?>

                    <div class="selected-section__inner">

                        <!-- Основная статья -->
                        <div class="news-card">
                            <?php if ($thumb_url) : ?>
                                <div class="news-card__image">
                                    <img src="<?= esc_url($thumb_url); ?>" alt="<?= esc_attr($alt ?: $title); ?>"
                                         loading="lazy">
                                </div>
                            <?php endif; ?>

                            <?php if ($tags) : ?>
                                <span class="tag"># <?php echo __('Стаття тижня', 'zirochka'); ?></span>
                            <?php endif; ?>

                            <a href="<?= esc_url($permalink); ?>" class="news-card__box mode">
                                <span class="h2"><?= esc_html($title); ?></span>
                                <p><?= esc_html($excerpt); ?></p>
                            </a>

                            <div class="news-card__bottom">
                                    <span class="news-card__info">
                                        <i class="sprite"><?php sprite(16, 16, 'clock'); ?></i>
                                        <?= esc_html($time_ago); ?>
                                    </span>
                                <span class="news-card__info">
                                        <i class="sprite"><?php sprite(16, 16, 'calendar'); ?></i>
                                        <?= esc_html($date); ?>
                                    </span>
                                <?php if ($author_name) : ?>
                                    <span class="news-card__info">
                                        <i class="sprite"><?php sprite(16, 16, 'user'); ?></i>
                                        <a href="<?= esc_url($author_link); ?>"><?= esc_html($author_name); ?></a>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Малые карточки -->
                        <?php if (!empty($other_posts)) : ?>
                            <ul class="selected-section__list">
                                <?php foreach ($other_posts as $post) :
                                    setup_postdata($post);

                                    $post_id = $post->ID;
                                    $title = get_the_title($post_id);
                                    $permalink = get_permalink($post_id);
                                    $thumb_id = get_post_thumbnail_id($post_id);
                                    $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
                                    $alt = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
                                    $tags = get_the_terms($post_id, 'article_tag');
                                    $author_id = get_field('articles', $post_id)[0] ?? null;
                                    $author_name = '';
                                    if ($author_id) {
                                        $author_name = get_the_title($author_id);
                                        $author_link = get_permalink($author_id);
                                    }
                                    $excerpt = get_the_excerpt($post_id);
                                    $date = get_the_date('d.m.y', $post_id);
                                    $time_ago = custom_time_ago(get_post_time('U', true, $post_id));
                                    ?>
                                    <li class="selected-section__item">
                                        <div class="news-card small">
                                            <?php if ($thumb_url) : ?>
                                                <a href="<?= esc_url($permalink); ?>" class="news-card__image">
                                                    <img src="<?= esc_url($thumb_url); ?>"
                                                         alt="<?= esc_attr($alt ?: $title); ?>" loading="lazy">
                                                </a>
                                            <?php endif; ?>

                                            <?php if ($tags) : ?>
                                                <span class="tag"># <?= esc_html($tags[0]->name); ?></span>
                                            <?php endif; ?>

                                            <div class="news-card__box">
                                                <a href="<?= esc_url($permalink); ?>" class="news-card__inner">
                                                    <span class="h3"><?= esc_html($title); ?></span>
                                                    <p><?= esc_html($excerpt); ?></p>
                                                </a>
                                                <div class="news-card__bottom">
                                                    <span class="news-card__info">
                                                        <i class="sprite"><?php sprite(16, 16, 'clock'); ?></i>
                                                        <?= esc_html($time_ago); ?>
                                                    </span>
                                                    <span class="news-card__info">
                                                        <i class="sprite"><?php sprite(16, 16, 'calendar'); ?></i>
                                                        <?= esc_html($date); ?>
                                                    </span>
                                                    <?php if ($author_name) : ?>
                                                    <span class="news-card__info">
                                                        <i class="sprite"><?php sprite(16, 16, 'user'); ?></i>
                                                        <a href="<?= esc_url($author_link); ?>"><?= esc_html($author_name); ?></a>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach;
                                wp_reset_postdata(); ?>
                            </ul>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </section>

    <?php
    endif; // если есть посты
endif; // если !shower
?>