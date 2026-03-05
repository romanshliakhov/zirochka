<?php
    $shower = get_sub_field('shower');

    // Получаем 3 последних поста CPT blog
	$posts = new WP_Query( [
		'post_type'      => 'news',
		'posts_per_page' => 6,
		'paged'          => get_query_var( 'paged' ) ?: 1,

	] );

    global $wp_query;
	$temp_query = $wp_query;
	$wp_query   = $posts;

	$current = max( 1, get_query_var( 'paged' ) );
	$max     = $posts->max_num_pages;

    if (!$shower): ?>
        <section class="section-blog">
            <div class="container">
                <div class="section-blog__wrapp">
                    <div class="section-blog__posts" data-loader="false">
                        <?php if ( $posts->have_posts() ) : ?>
                            <?php while ( $posts->have_posts() ) : $posts->the_post();
                                display_news_card( get_the_ID() );
                            endwhile; ?>
                        <?php else : ?>
                            <div>Новин не знайдено</div>
                        <?php endif; ?>
                    </div>

                    <div class="pagination-wrapper">
                        <?php if ( $max > 1 ): ?>
                            <div class="pagination">

                                <?php if ( $current > 1 ): ?>
                                    <button class="pagination__item pagination__prev" data-direction="prev">
                                        <!-- <?php sprite(20, 20, 'ArrowLeft'); ?> -->
                                    </button>
                                <?php endif; ?>

                                <?php for ( $i = 1; $i <= $max; $i ++ ): ?>
                                    <button class="pagination__item <?= $i === $current ? 'active' : '' ?>"
                                            data-page="<?= $i ?>"><?= $i ?></button>
                                <?php endfor; ?>

                                <?php if ( $current < $max ): ?>
                                    <button class="pagination__item pagination__next" data-direction="next">
                                        <!-- <?php sprite(20, 20, 'ArrowRight'); ?> -->
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
