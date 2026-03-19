<?php
add_action('wp_ajax_get_articles', 'ajax_get_articles');
add_action('wp_ajax_nopriv_get_articles', 'ajax_get_articles');

function ajax_get_articles() {

    // Проверка nonce
    if (empty($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ajax_global')) {
        wp_send_json_error(['message' => 'Invalid nonce']);
    }

    // Получаем offset (сколько уже загружено)
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;

    // WP_Query
    $query = new WP_Query([
        'post_type'      => 'articles',
        'posts_per_page' => 3, // шаг загрузки
        'offset'         => $offset,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    ob_start();
    $index = $offset; // для паттерна mode

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $post_id = get_the_ID();
            $title = get_the_title();
            $permalink = get_permalink();
            $thumb_id = get_post_thumbnail_id();
            $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
            $alt = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
            $date = get_the_date('d.m.y');
            $timestamp = get_the_time('U');
            $time_ago = custom_time_ago($timestamp);

            $authors = get_field('articles', $post_id);
            $author_name = $author_link = '';
            if ($authors && is_array($authors)) {
                $author_id = $authors[0];
                $author_name = get_the_title($author_id);
                $author_link = get_permalink($author_id);
            }

            $terms = get_the_terms($post_id, 'article_tag');
            $tag = $tag_link = '';
            if ($terms && !is_wp_error($terms)) {
                $tag = $terms[0]->name;
                $tag_link = get_term_link($terms[0]);
            }

            $item_class = (($index % 5) >= 2) ? 'mode' : '';
            ?>

            <li class="blog-list__item <?= esc_attr($item_class); ?>" data-id="<?= esc_attr($post_id); ?>">
                <div class="blog-card">
                    <?php if ($thumb_url): ?>
                        <a href="<?= esc_url($permalink); ?>" class="blog-card__image">
                            <img src="<?= esc_url($thumb_url); ?>" alt="<?= esc_attr($alt ?: $title); ?>" loading="lazy">
                        </a>
                    <?php endif; ?>

                    <?php if ($tag): ?>
                        <a href="<?= esc_url($tag_link); ?>" class="tag"># <?= esc_html($tag); ?></a>
                    <?php endif; ?>

                    <div class="blog-card__box">
                        <a href="<?= esc_url($permalink); ?>" class="h2"><?= esc_html($title); ?></a>
                        <div class="blog-card__bottom">
                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'clock'); ?></i>
                                <?= esc_html($time_ago); ?>
                            </span>
                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'calendar'); ?></i>
                                <?= esc_html($date); ?>
                            </span>
                            <?php if ($author_name): ?>
                                <span class="blog-card__info">
                                    <i class="sprite"><?php sprite(16, 16, 'user'); ?></i>
                                    <a href="<?= esc_url($author_link); ?>"><?= esc_html($author_name); ?></a>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </li>

            <?php
            $index++;
        }
    }

    wp_reset_postdata();
    $html = ob_get_clean();

    wp_send_json_success(['html' => $html]);
    wp_die();
}