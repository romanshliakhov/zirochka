<?php
global $global_selected_books;

if (!isset($global_selected_books)) {
    $global_selected_books = [];
}

$shower = get_sub_field('shower');
$exclude_mode = get_sub_field('exclude_mode');
$selected_ids = get_sub_field('books') ?: [];

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
        'post_type'      => 'books',
        'post__not_in'   => $global_selected_books,
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

} else {

    $query = new WP_Query([
        'post_type'      => 'books',
        'post__in'       => $selected_ids,
        'orderby'        => 'post__in',
        'posts_per_page' => -1,
    ]);
}

$posts = $query->posts;
?>

<section class="all-books-section">
    <div class="container">
        <div class="all-books-section__list">

            <?php foreach ($posts as $post) : setup_postdata($post); ?>

                <?php
                $post_id = $post->ID;
                $title = get_the_title($post_id);
                $permalink = get_permalink($post_id);

                $thumb_id  = get_post_thumbnail_id($post_id);
                $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
                $alt       = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';

                $book_date = get_the_date('d.m.y', $post_id);

                $authors = get_field('books', $post_id);
                $author_name = '';

                if ($authors) {
                    $author_id = $authors[0];
                    $author_name = get_the_title($author_id);
                    $author_link = $authors ? get_permalink($author_id) : '';
                }
                ?>

                <div class="book-card">
                    <?php if ($thumb_url): ?>
                        <a href="<?= esc_url($permalink); ?>" class="book-card__image">
                            <img src="<?= esc_url($thumb_url); ?>" alt="<?= esc_attr($alt ?: $title); ?>" loading="lazy">
                        </a>
                    <?php endif; ?>

                    <div class="book-card__box">
                        <a href="<?= esc_url($permalink); ?>" class="h2"><?= esc_html($title); ?></a>

                        <div class="book-card__bottom">
                            <span class="book-card__info">
                                 <i class="sprite"><?php sprite(16, 16, 'calendar'); ?></i>
                                <?= esc_html($book_date); ?>
                            </span>

                            <?php if ($author_name): ?>
                                <span class="book-card__info">
                                     <i class="sprite"><?php sprite(16, 16, 'user'); ?></i>
                                     <a href="<?= esc_url($author_link); ?>"><?= esc_html($author_name); ?></a>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <?php endforeach; wp_reset_postdata(); ?>

        </div>
    </div>
</section>