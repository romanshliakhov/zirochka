<?php
    $shower     = get_sub_field('shower');
    $editor     = get_sub_field('editor');
    $news_posts = get_sub_field('news'); // relationship (IDs)
    $link       = get_sub_field('link');

    $selected_ids = is_array($news_posts) ? $news_posts : [];
    $posts        = [];

    // ==================================
    // 📰 Новости для слайдера
    // Логика:
    // 1. Выбранные в ACF — первыми (ручной порядок)
    // 2. Остальные — последние по дате
    // ==================================

    if (!empty($selected_ids)) {
        // 1️⃣ Выбранные (ручной порядок из relationship)
        $selected_query = new WP_Query([
            'post_type'      => 'news',
            'post__in'       => $selected_ids,
            'orderby'        => 'post__in',
            'posts_per_page' => -1,
        ]);

        $posts = $selected_query->posts;

        // 2️⃣ Остальные — автоматически последние по дате
        $latest_query = new WP_Query([
            'post_type'      => 'news',
            'post__not_in'   => $selected_ids,
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        $posts = array_merge($posts, $latest_query->posts);
    } else {
        // Если ничего не выбрано — просто все последние
        $all_query = new WP_Query([
            'post_type'      => 'news',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        $posts = $all_query->posts;
    }

	
	if ( ! $shower ) : ?>
        <section class="section-news" >
            <div class="container">
                <div class="section-news__wrapp">
                    <div class="section-news__top">
                        <?php if (!empty($editor)) : ?>
                            <div class="section-news__editor editor">
                                <?= $editor; ?>
                            </div>
                        <?php endif; ?>

                        <div class="section-news__controls">

                        </div>
                    </div>
                    
                    <?php if (!empty($posts)) : ?>
                        <div class="section-news__slider">
                            <div class="swiper-container">
                                <ul class="swiper-wrapper">
                                    <?php foreach ($posts as $post) : ?>
                                        <?php setup_postdata($post); ?>
                                        <li class="swiper-slide">
                                            <?php display_news_card($post->ID); ?>
                                        </li>
                                    <?php endforeach; ?>
                                    <?php wp_reset_postdata(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ( $link ) :
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<a class="section-news__button button button--animated" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
							<?php echo esc_html( $link_title ); ?>
						</a>
					<?php endif; ?>
                </div>
            </div>
        </section>

	<?php endif; ?>