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
        $first_posts = array_slice($related_articles, 0, 5);
        $second_posts = array_slice($related_articles, 5);
    ?>

    <section class="blog-section">
        <div class="container">
            <div class="blog-section__box">

                <div class="editor">
                    <h2 class="h1">
                        <i class="sprite"><?php sprite(29, 28, 'star_icon') ?></i>
                        <?= __('Статті автора', 'zirochka') ?>
                    </h2>
                </div>

                <ul class="blog-list">
                    <?php foreach ($first_posts as $index => $post) : setup_postdata($post); ?>

                        <?php
                        $item_class = ( ($index % 5) >= 2 ) ? 'mode' : '';
                        ?>

                        <?php
                        $post_id = is_object($post) ? $post->ID : $post;
                        ?>

                        <li class="blog-list__item <?= esc_attr($item_class); ?>">
                            <?php display_articles_card($post_id); ?>
                        </li>

                    <?php endforeach; wp_reset_postdata(); ?>
                </ul>

            </div>
        </div>
    </section>

    <?php
        if (have_rows('builder', get_the_ID())) {
            while (have_rows('builder', get_the_ID())) {
                the_row();
                get_template_part('template_parts/' . str_replace('_', '-', get_row_layout()));
            }
        }
    ?>

    <section class="blog-section">
        <div class="container">
            <div class="blog-section__box">

                <ul class="blog-list">

                    <?php foreach ($second_posts as $index => $post) : setup_postdata($post); ?>

                        <?php
                        $item_class = ( ($index % 5) >= 2 ) ? 'mode' : '';
                        ?>

                        <?php
                        $post_id = is_object($post) ? $post->ID : $post;
                        ?>

                        <li class="blog-list__item <?= esc_attr($item_class); ?>">
                            <?php display_articles_card($post_id); ?>
                        </li>

                    <?php endforeach; wp_reset_postdata(); ?>

                </ul>

            </div>
        </div>
    </section>

<?php get_footer(); ?>