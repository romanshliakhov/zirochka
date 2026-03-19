<?php
get_header();

$term = get_queried_object();

$term_id   = $term->term_id;
$term_name = $term->name;
$term_desc = $term->description;

// Получаем статьи по таксономии
$args = [
    'post_type'      => 'articles',
    'posts_per_page' => -1,
    'tax_query'      => [
        [
            'taxonomy' => 'article_tag',
            'field'    => 'term_id',
            'terms'    => $term_id,
        ]
    ]
];

$query = new WP_Query($args);

$related_articles      = $query->posts;
$author_articles_count = $query->found_posts;

// Разделяем посты
$first_posts  = array_slice($related_articles, 0, 5);
$second_posts = array_slice($related_articles, 5);
?>

    <section class="single-tag-section">
        <div class="container">
            <div class="single-tag-section__box">

                <h1 class="h1"># <?= esc_html($term_name); ?></h1>

                <?php if ($term_desc): ?>
                    <p><?= esc_html($term_desc); ?></p>
                <?php endif; ?>

                <span class="single-tag-section__info">
                <i class="sprite"><?php sprite(16, 16, 'article') ?></i>
                <?= intval($author_articles_count); ?> <?= __('статей', 'zirochka') ?>
            </span>

            </div>
        </div>
    </section>

    <section class="blog-section">
        <div class="container">
            <div class="blog-section__box">
                <ul class="blog-list">
                    <?php foreach ($first_posts as $index => $post) : ?>
                        <?php setup_postdata($post); ?>

                        <?php
                        $item_class = (($index % 5) >= 2) ? 'mode' : '';
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
// Builder для taxonomy term
$builder_post_id = 'term_' . $term_id;

if (have_rows('builder', $builder_post_id)) :
    while (have_rows('builder', $builder_post_id)) :
        the_row();

        $layout = get_row_layout();
        get_template_part('template_parts/' . str_replace('_', '-', $layout));

    endwhile;
endif;
?>

    <section class="blog-section">
        <div class="container">
            <div class="blog-section__box">

                <ul class="blog-list">
                    <?php foreach ($second_posts as $index => $post) : ?>
                        <?php setup_postdata($post); ?>

                        <?php
                        $item_class = (($index % 5) >= 2) ? 'mode' : '';
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