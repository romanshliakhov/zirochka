<?php
global $global_selected_books;

if (!isset($global_selected_books)) {
    $global_selected_books = [];
}

$shower = get_sub_field('shower');
$exclude_mode = get_sub_field('exclude_mode');
$selected_ids = get_sub_field('articles') ?: [];
$editor = get_sub_field('editor');

// ❌ если скрыто — ничего не рендерим
if ($shower) {
    return;
}

// 👉 если первая секция — сохраняем выбранные книги
if (!$exclude_mode) {
    $global_selected_books = $selected_ids;
}

// 👉 формируем query
if ($exclude_mode) {

    $query = new WP_Query([
        'post_type'      => 'articles',
        'post__not_in'   => $global_selected_books,
        'posts_per_page' => 7,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

} else {

    $query = new WP_Query([
        'post_type'      => 'articles',
        'post__in'       => $selected_ids,
        'orderby'        => 'post__in',
        'posts_per_page' => -1,
    ]);
}

$posts = $query->posts;
?>

<section class="blog-section">
    <div class="container">
        <div class="blog-section__box">
            <?php if (!empty($editor)) : ?>

                <div class="editor">
                    <h2 class="h1">
                        <i class="sprite">
                            <?php sprite(29, 28, 'star_icon') ?>
                        </i>
                        <?= esc_html($editor); ?>
                    </h2>
                </div>
            <?php endif; ?>

            <ul class="blog-list">

                <?php foreach ($posts as $index => $post) : setup_postdata($post); ?>

                    <?php
                    $post_id   = $post->ID;
                    $title     = get_the_title($post_id);
                    $permalink = get_permalink($post_id);

                    $thumb_id  = get_post_thumbnail_id($post_id);
                    $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
                    $alt       = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';

                    $date = get_the_date('d.m.y', $post_id);

                    // описание
                    $excerpt = get_the_excerpt($post_id);

                    // автор
                    $authors = get_field('articles', $post_id);
                    $author_name = '';
                    $author_link = '';

                    if ($authors) {
                        $author_id   = $authors[0];
                        $author_name = get_the_title($author_id);
                        $author_link = get_permalink($author_id);
                    }

                    $time = get_field('reading_time', $post_id);
                    $timestamp = get_the_time('U', $post_id);
                    $time_ago = custom_time_ago($timestamp);
                    $terms = get_the_terms($post_id, 'article_tag');

                    $tag = '';
                    $tag_link = '';

                    if ($terms && !is_wp_error($terms)) {
                        $tag = $terms[0]->name;
                        $tag_link = get_term_link($terms[0]);
                    }

                    // 👉 для чередования layout (mode)
                    $item_class = ( ($index % 5) >= 2 ) ? 'mode' : '';
                    ?>

                    <li class="blog-list__item <?= esc_attr($item_class); ?>" data-id="<?= esc_attr($post_id); ?>">

                        <div class="blog-card">

                            <?php if ($thumb_url): ?>
                                <a href="<?= esc_url($permalink); ?>" class="blog-card__image">
                                    <img src="<?= esc_url($thumb_url); ?>"
                                         alt="<?= esc_attr($alt ?: $title); ?>"
                                         loading="lazy">
                                </a>
                            <?php endif; ?>

                            <?php if ($tag): ?>
                                <a href="<?= esc_url($tag_link); ?>" class="tag">
                                    # <?= esc_html($tag); ?>
                                </a>
                            <?php endif; ?>

                            <div class="blog-card__box">

                                <a href="<?= esc_url($permalink); ?>" class="h2"><?= esc_html($title); ?></a>

                                <?php if ($excerpt): ?>
                                    <p><?= esc_html($excerpt); ?></p>
                                <?php endif; ?>

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

                                            <?php if ($author_link): ?>
                                                <a href="<?= esc_url($author_link); ?>">
                                                    <?= esc_html($author_name); ?>
                                                </a>
                                            <?php else: ?>
                                                <span><?= esc_html($author_name); ?></span>
                                            <?php endif; ?>

                                        </span>
                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>

                    </li>

                <?php endforeach; wp_reset_postdata(); ?>


            </ul>

        </div>
    </div>
</section>
