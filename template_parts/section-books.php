<?php
$shower      = get_sub_field('shower');
$editor      = get_sub_field('editor');
$link        = get_sub_field('link');
$selected_ids = get_sub_field('books') ?: [];

if (!$shower) :

    $posts = [];
    if (!empty($selected_ids)) {
        $query = new WP_Query([
            'post_type'      => 'books',
            'post__in'       => $selected_ids,
            'orderby'        => 'post__in',
            'posts_per_page' => -1,
        ]);
        $posts = $query->posts;
    } else {
        $query = new WP_Query([
            'post_type'      => 'books',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);
        $posts = $query->posts;
    }
?>
<section class="books-section">
    <div class="container">
        <div class="books-section__box">
            <div class="books-section__top">
                <?php if (!empty($editor)) : ?>
                    <div class="editor">
                        <h2 class="h1">
                            <i class="sprite"><?php sprite(29, 28, 'star_icon'); ?></i>
                            <?= esc_html($editor); ?>
                        </h2>
                    </div>
                <?php endif; ?>

                <?php if ($link && is_array($link)) :
                    $link_url    = $link['url'] ?? '#';
                    $link_title  = $link['title'] ?? 'Подробнее';
                    $link_target = $link['target'] ?? '_self';
                ?>
                    <a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>" class="books-section__more">
                        <?= esc_html($link_title); ?>
                        <?php sprite(24, 24, 'arrow-r'); ?>
                    </a>
                <?php endif; ?>
            </div>

            <?php if (!empty($posts)) : ?>
                <div class="books-section__slider">
                    <div class="swiper-container">
                        <ul class="swiper-wrapper">
                            <?php foreach ($posts as $post) : setup_postdata($post);
                                $post_id   = $post->ID;
                                $title     = get_the_title($post_id);
                                $permalink = get_permalink($post_id);

                                $thumb_id  = get_post_thumbnail_id($post_id);
                                $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
                                $alt       = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';

                                $book_date = get_the_date('d.m.y', $post_id);

                                $authors = get_field('books', $post_id);
                                if ($authors) {
                                    $author_id = $authors[0];
                                    $author_name = get_the_title($author_id);
                                    $author_link = $authors ? get_permalink($author_id) : '';
                                }
                            ?>
                            <li class="swiper-slide">
                                <div class="book-card">
                                    <?php if ($thumb_url): ?>
                                        <a href="<?= esc_url($permalink); ?>" class="book-card__image">
                                            <img width="186" height="260" src="<?= esc_url($thumb_url); ?>" alt="<?= esc_attr($alt ?: $title); ?>" loading="lazy">
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
                            </li>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </ul>
                    </div>

                    <div class="slider-controls">
                        <div class="slider-btn prev"><?php sprite(32, 32, 'arrow-l'); ?></div>
                        <div class="slider-btn next"><?php sprite(32, 32, 'arrow-r'); ?></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>