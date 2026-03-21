<?php
global $global_selected_books;

if (!isset($global_selected_books)) {
    $global_selected_books = [];
}

$shower = get_sub_field('shower');
$exclude_mode = get_sub_field('exclude_mode');
$selected_ids = get_sub_field('blog') ?: [];

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
        'post_type'      => 'blog',
        'post__not_in'   => $global_selected_books,
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

} else {

    $query = new WP_Query([
        'post_type'      => 'blog',
        'post__in'       => $selected_ids,
        'orderby'        => 'post__in',
        'posts_per_page' => -1,
    ]);
}

$posts = $query->posts;
?>

<section class="blogs-section">
    <div class="container">
        <div class="blogs-section__list">

            <?php
            $index = 0;
            foreach ($posts as $post) :
                setup_postdata($post);
                $index++;

            // логика mode
            $is_mode = ($index === 4) || ($index > 4 && ($index - 4) % 5 === 0);
            $is_second = ($index === 2) || ($index > 2 && ($index - 2) % 5 === 0);

            $classes = 'blogs-section__item';
            if ($is_mode) {
                $classes .= ' mode';
            }
            if ($is_second) {
                $classes .= ' second';
            }
            ?>

                <?php
                $post_id = $post->ID;
                $title = get_the_title($post_id);
                $permalink = get_permalink($post_id);

                $thumb_id  = get_post_thumbnail_id($post_id);
                $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
                $alt       = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';

                $book_date = get_the_date('d.m.y', $post_id);

                $authors = get_field('blog', $post_id);
                $author_name = '';
                $time = custom_time_ago(get_post_time('U', true, $post_id));
                $deskr = get_field('excerpt', $post_id);
                $terms = get_the_terms($post_id, 'article_tag');

                $tag = '';
                $tag_link = '';

                if ($terms && !is_wp_error($terms)) {
                    $tag = $terms[0]->name;
                    $tag_link = get_term_link($terms[0]);
                }

                if ($authors) {
                    $author_id = $authors[0];
                    $author_name = get_the_title($author_id);
                    $author_link = $authors ? get_permalink($author_id) : '';
                }
                ?>
                <li class="<?= esc_attr($classes); ?>">
                    <div class="info-card">
                    <a href="<?= esc_url($permalink); ?>" class="info-card__box">
                        <?php if ($thumb_url): ?>
                            <div class="info-card__image">
                                <img src="<?= esc_url($thumb_url); ?>" alt="<?= esc_attr($alt ?: $title); ?>" loading="lazy">
                            </div>
                        <?php endif; ?>

                        <h2 class="h2"><?= esc_html($title); ?></h2>

                        <p><?= esc_html(wp_strip_all_tags($deskr)); ?></p>
                    </a>
                    <?php if ($tag): ?>
                        <a href="<?= esc_url($tag_link); ?>" class="tag">
                            # <?= esc_html($tag); ?>
                        </a>
                    <?php endif; ?>



                    <div class="info-card__bottom">
                         <span class="info-card__info">
                            <i class="sprite"><?php sprite(16, 16, 'clock') ?></i>
                            <?= esc_html($time); ?>
                        </span>

                        <span class="info-card__info">
                             <i class="sprite"><?php sprite(16, 16, 'calendar'); ?></i>
                            <?= esc_html($book_date); ?>
                        </span>

                        <?php if ($author_name): ?>
                            <span class="info-card__info">
                                 <i class="sprite"><?php sprite(16, 16, 'user'); ?></i>
                                 <a href="<?= esc_url($author_link); ?>"><?= esc_html($author_name); ?></a>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                </li>

            <?php endforeach; wp_reset_postdata(); ?>

        </div>
    </div>
</section>