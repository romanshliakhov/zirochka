<?php
/**
 * Template name: Single books
 */

get_header();

$post_id   = get_the_ID();
$title     = get_the_title($post_id);
$excerpt   = get_the_excerpt($post_id);
$post_type = get_post_type($post_id);

// ACF
$authors = get_field('books', $post_id);
$deskr   = get_field('excerpt', $post_id);
$info   = get_field('info', $post_id);

// Автор
$author_name = '';
$author_link = '';

if (!empty($authors)) {
    $author_id   = $authors[0];
    $author_name = get_the_title($author_id);
    $author_link = get_permalink($author_id);
}

// Дата
$date = get_the_date('d.m.y', $post_id);
$time = get_post_time('U', true, $post_id);

// Теги
$tags = get_the_terms($post_id, 'article_tag');
$tags = (!empty($tags) && !is_wp_error($tags)) ? $tags : [];

// Категория
$terms    = get_the_terms($post_id, 'article_category');
$category = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : '';
$category_class = '';

if ($terms && !is_wp_error($terms)) {
    $category_slug = $terms[0]->slug;

    switch ($category_slug) {
        case 'polityka':
            $category_class = 'is-politics';
            break;

        case 'kultura':
            $category_class = 'is-culture';
            break;

        case 'oglyady':
            $category_class = 'is-reviews';
            break;

        case 'ideyi':
            $category_class = 'is-ideas';
            break;
    }
}

// Картинка
$thumb_id  = get_post_thumbnail_id($post_id);
$thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
$alt       = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
?>

    <section class="hero-section hero-section--blog <?= esc_attr($category_class); ?>">
        <div class="container">
            <div class="hero-section__box">

                <div class="hero-section__inner">

                    <?php if ($category): ?>
                        <span class="h3">
                        <i class="sprite"><?php sprite(29, 28, 'star_icon') ?></i>
                        <?= esc_html($category); ?>
                    </span>
                    <?php endif; ?>

                    <div class="editor">
                        <p class="h1"><?= esc_html($title); ?></p>

                        <?php if ($deskr): ?>
                            <p><?= esc_html(wp_strip_all_tags($deskr)); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="hero-section__bottom">
                    <span class="hero-section__info">
                        <i class="sprite"><?php sprite(16, 16, 'clock') ?></i>
                        <?= esc_html(custom_time_ago($time)); ?>
                    </span>

                        <span class="hero-section__info">
                        <i class="sprite"><?php sprite(16, 16, 'calendar') ?></i>
                        <?= esc_html($date); ?>
                    </span>

                        <?php if ($author_name): ?>
                            <span class="hero-section__info">
                            <i class="sprite"><?php sprite(16, 16, 'user') ?></i>
                            <a href="<?= esc_url($author_link); ?>">
                                <?= esc_html($author_name); ?>
                            </a>
                        </span>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="hero-section__image hero-section__image--book">

                    <?php if ($thumb_url): ?>
                        <img src="<?= esc_url($thumb_url); ?>" alt="<?= esc_attr($alt ?: $title); ?>" loading="lazy">
                    <?php endif; ?>

                    <?php if (!empty($tags)): ?>
                        <?php foreach ($tags as $tag):
                            $tag_link = get_term_link($tag);
                            if (is_wp_error($tag_link)) continue;
                            ?>
                            <a href="<?= esc_url($tag_link); ?>" class="tag">
                                # <?= esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if ($info): ?>
                        <p><?= esc_html($info); ?></p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

<?php if (have_rows('builder', $post_id)) : ?>
    <?php while (have_rows('builder', $post_id)) : the_row(); ?>
        <?php get_template_part('template_parts/' . str_replace('_', '-', get_row_layout())); ?>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>