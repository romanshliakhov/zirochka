<?php
$shower = get_sub_field('shower');
$editor = get_sub_field('editor');

// например, ID услуги = текущая страница services
$current_service_id = get_the_ID();

if (!$shower) :

    // 1) Пытаемся вытащить только проекты, где поле services_bind совпадает
    $query_args = [
        'post_type'      => 'projects',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
        'meta_query'     => [
            [
                'key'     => 'services_bind',
                'value'   => $current_service_id,
                'compare' => '='
            ]
        ],
    ];

    $projects_query = new WP_Query($query_args);

    // 2) Если не нашлось → вытаскиваем все проекты
    if (!$projects_query->have_posts()) {
        $query_args = [
            'post_type'      => 'projects',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        ];
        $projects_query = new WP_Query($query_args);
    }
    ?>
    <section class="section-completed">
        <div class="container">
            <div class="section-completed__wrapp">
                <?php if (!empty($editor)) : ?>
                    <div class="editor">
                        <?= $editor; ?>
                    </div>
                <?php endif; ?>

                <?php if ($projects_query->have_posts()) : ?>
                    <div class="section-completed__slider">
                        <div class="swiper-container">
                            <ul class="swiper-wrapper">
                                <?php while ($projects_query->have_posts()) : $projects_query->the_post(); ?>
                                    <li class="swiper-slide">
                                        <?php display_projects_card_default(get_the_ID()); ?>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>

                        <div class="section-completed__controls">
                            <button class="slider-btn completed-prev">
                                <?php sprite(32, 32, 'ArrowLeft') ?>
                            </button>
                            <button class="slider-btn completed-next">
                                <?php sprite(32, 32, 'ArrowRight') ?>
                            </button>
                        </div>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php else: ?>
                    <p>Проекты пока не добавлены.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
