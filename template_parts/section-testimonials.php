<?php
    $shower      = get_sub_field('shower');
    $editor      = get_sub_field('editor');
    $summary     = get_sub_field('summary');
    $shortcode   = $summary['get_shortcode'] ?? '';
    $total       = $summary['total'] ?? '';
    $link        = $summary['link'] ?? '';

    // Подгружаем все отзывы:
    $postsSlider = get_posts([
        'post_type'      => 'review',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    if (!$shower) : ?>
        <section class="section-testimonials">
            <div class="container">
                <div class="section-testimonials__inner">
                    <div class="editor"><?= $editor ?></div>

                    <div class="elfsight-app-be0465c9-b012-4f01-be17-db89b7b97870" data-elfsight-app-lazy></div> 
                </div>
            </div>
        </section>
    <?php endif; ?>
