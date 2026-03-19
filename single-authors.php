<?php
get_header();

$post_id = get_the_ID(); // ID автора

// ACF поля
$author_name = get_the_title($post_id);
$author_desc = get_field('description', $post_id);

// Связанные статьи через ACF Post Relationship
$related_articles = get_field('articles', $post_id); // массив ID или объектов WP_Post
$author_articles_count = $related_articles ? count($related_articles) : 0;

// Изображение автора
$author_thumb_id  = get_post_thumbnail_id($post_id);
$author_thumb_url = $author_thumb_id
    ? wp_get_attachment_image_url($author_thumb_id, 'full')
    : get_template_directory_uri() . '/assets/img/Author.png';
$author_thumb_alt = $author_thumb_id
    ? get_post_meta($author_thumb_id, '_wp_attachment_image_alt', true)
    : $author_name;
?>

    <section class="author-section">
        <div class="author-section__bg">
            <img width="1920" height="153"
                 src="<?= esc_url(get_template_directory_uri() . '/assets/img/bg_author.png'); ?>"
                 loading="lazy"/>
        </div>
        <div class="container">
            <div class="author-section__box">
                <div class="author-section__thumb">
                    <img width="248" height="240"
                         src="<?= esc_url($author_thumb_url); ?>"
                         alt="<?= esc_attr($author_thumb_alt); ?>"
                         loading="lazy"/>
                </div>
                <div class="author-section__inner">
                    <h1 class="h1"><?= esc_html($author_name); ?></h1>
                    <?php if ($author_desc): ?>
                        <p><?= esc_html($author_desc); ?></p>
                    <?php endif; ?>
                    <span class="author-section__info">
                    <i class="sprite"><?php sprite(16, 16, 'article') ?></i>
                    <?= intval($author_articles_count); ?> <?= __('статей', 'zirochka') ?>
                </span>
                </div>
            </div>
        </div>
    </section>

<?php
if (have_rows('post_builder', get_the_ID())) {
    while (have_rows('post_builder', get_the_ID())) {
        the_row();
        get_template_part('template_parts/' . str_replace('_', '-', get_row_layout()));
    }
}
?>

<?php get_footer(); ?>