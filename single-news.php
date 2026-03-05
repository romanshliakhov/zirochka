<?php
get_header();

$post_id    = get_the_ID();
$post_title = get_the_title($post_id);

/**
 * ACF banner (TOP image)
 */
$banner = get_field('news_banner', $post_id); // return_format = array

$fallback_url = get_template_directory_uri() . '/assets/img/news-placeholder.jpg';

$top_image_url = !empty($banner['url'])
    ? $banner['url']
    : $fallback_url;

$top_image_alt = !empty($banner['alt'])
    ? $banner['alt']
    : $post_title;

/**
 * Featured image (CONTENT image)
 */
$thumb_id  = get_post_thumbnail_id($post_id);
$thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
$thumb_alt = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<section class="article">
    <div class="container container--small">
        <div class="article__wrapp">
            <div class="article__top">

                <!-- TOP IMAGE: banner OR placeholder -->
                <div class="article__image<?= empty($banner['url']) ? ' is-placeholder' : ''; ?>">
                    <img
                        src="<?= esc_url($top_image_url); ?>"
                        alt="<?= esc_attr($top_image_alt); ?>"
                        loading="eager"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>

                <div class="article__top-info">
                    <div class="article__top-head">
                        <p class="aticle__pubtime">
                            <?php echo get_the_date('F d, Y'); ?>
                        </p>

                        <div class="article__views">
                            <?php sprite(16, 16, 'eye'); ?>
                            <p><?php echo get_post_views(get_the_ID()); ?></p>
                        </div>
                    </div>

                    <h1 class="article__title">
                        <?php echo esc_html($post_title); ?>
                    </h1>
                </div>
            </div>

            <div class="article__inner">
                <div class="article__share">
                    <span class="article__share-heading">
                        <?php esc_html_e('Поширити', 'dental'); ?>
                    </span>

                    <ul class="article__share-socials">
                        <li>
                            <a href="<?php echo get_share('fb'); ?>" target="_blank">
                                <?php sprite(26, 26, 'facebook'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo get_share('telegram'); ?>" target="_blank">
                                <?php sprite(26, 26, 'telegram'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo get_share('whatsapp'); ?>" target="_blank">
                                <?php sprite(26, 26, 'whatsapp'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo get_share('viber'); ?>" target="_blank">
                                <?php sprite(26, 26, 'viber'); ?>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="article__content">
                    <!-- CONTENT IMAGE: featured image ONLY -->
                    <?php if ($thumb_url): ?>
                        <div class="article__thumbnail">
                            <img
                                src="<?= esc_url($thumb_url); ?>"
                                alt="<?= esc_attr($thumb_alt ?: $post_title); ?>"
                                loading="eager"
                                fetchpriority="high"
                            >
                        </div>
                    <?php endif; ?>

                    <div class="editor">
                        <?php the_content(); ?>
                    </div>
                </div>

                <ul class="article__related">
                    <?php
                    $query = new WP_Query([
                        'post_type'      => 'news',
                        'posts_per_page' => 3,
                        'post__not_in'   => [get_the_ID()],
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ]);

                    if ($query->have_posts()):
                        while ($query->have_posts()): $query->the_post(); ?>
                            <li class="article__related-item">
                                <?php display_news_card(get_the_ID()); ?>
                            </li>
                        <?php endwhile;
                        wp_reset_postdata();
                    else: ?>
                        <li><?php esc_html_e('Немає статей', 'novolipki'); ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php endwhile; endif; ?>

<?php
if (have_rows('post_builder', get_the_ID())) {
    while (have_rows('post_builder', get_the_ID())) {
        the_row();
        get_template_part('template_parts/' . str_replace('_', '-', get_row_layout()));
    }
}
?>

<?php get_footer(); ?>
