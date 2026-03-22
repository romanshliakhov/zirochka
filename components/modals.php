<div class="overlay fixed-block" data-overlay>
	<?php 
	$args = [
		'post_type'      => 'modals',
		'posts_per_page' => -1,
	];

	$modal_done  = get_field('modal_box', 'modals_options')['success_id'] ?? null;
	$modal_error = get_field('modal_box', 'modals_options')['error_id'] ?? null;

	$modals_query = new WP_Query($args);

	if ($modals_query->have_posts()) :
		while ($modals_query->have_posts()) :
			$modals_query->the_post();

			$modal_id = get_the_ID();
			$classes  = ['modal'];

			if ($modal_done && $modal_id === $modal_done[0]) {
				$classes[] = 'modal--done';
			}
			if ($modal_error && $modal_id === $modal_error[0]) {
				$classes[] = 'modal--error';
			}

			// Flexible Content
			if (have_rows('modals_layout', $modal_id)) :
				while (have_rows('modals_layout', $modal_id)) : the_row();

					// Лейаут editors
					if (get_row_layout() === 'editors') : ?>
						<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-popup="modal_<?php echo esc_attr($modal_id); ?>">
                            <div class="modal__bg">
                                <?php sprite(248, 240, 'decor2'); ?>
                            </div>

							<div class="modal__container">
                                <div class="close modal__close">
                                    <?php sprite(14, 14, 'close'); ?>
                                </div>
								<?= display_editor_blocks(get_sub_field('editors'), 'modal__box editor'); ?>
							</div>
						</div>
					<?php endif;
				endwhile;
			endif;

		endwhile;
	endif;




	wp_reset_postdata();
	?>

<!--    TODO-->
<!--    Модалка поиска-->
    <div class="modal modal--search" data-popup="search">
        <div class="modal__container">
            <div class="modal__header">
                <span class="h2"><?= __('Пошук новин', 'zirochka') ?></span>

                <button type="button" class="close modal__close">
                    <?php sprite(14, 14, 'close'); ?>
                </button>
            </div>

            <form role="search" method="get" action="<?php echo home_url('/'); ?>" class="search-form" data-search-form>
                <input
                        type="search"
                        name="s"
                        placeholder="Пошта"
                        required
                        data-search-input
                        autocomplete="off"
                >
            </form>

            <div class="search-results" data-search-results>
                <div class="blog-card">
                    <a href="/article/nevdala-rosijska-revolyucziya-povstannya-dekabrystiv-1825-roku/" class="blog-card__image">
                        <img src="//localhost:3000/wp-content/uploads/2026/03/rectangle-2.png"
                             alt="<?= esc_attr($alt ?: $title); ?>"
                             loading="lazy">
                    </a>

                    <div class="blog-card__box">
                        <a href="/article/nevdala-rosijska-revolyucziya-povstannya-dekabrystiv-1825-roku/" class="h2">Невдала російська революція? Повстання декабристів 1825 року</a>

                        <div class="blog-card__bottom">
                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'clock'); ?></i>
                                9 хв
                            </span>

                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'calendar'); ?></i>
                                16.01.26
                            </span>

                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'user'); ?></i>
                                <a href="/authors/andrij-kravczov/">
                                   Андрій Кравцов
                                </a>
                            </span>
                        </div>
                    </div>

                </div>

                <div class="blog-card">
                    <a href="/article/nevdala-rosijska-revolyucziya-povstannya-dekabrystiv-1825-roku/" class="blog-card__image">
                        <img src="//localhost:3000/wp-content/uploads/2026/03/rectangle-2.png"
                             alt="<?= esc_attr($alt ?: $title); ?>"
                             loading="lazy">
                    </a>

                    <div class="blog-card__box">
                        <a href="/article/nevdala-rosijska-revolyucziya-povstannya-dekabrystiv-1825-roku/" class="h2">Невдала російська революція? Повстання декабристів 1825 року</a>

                        <div class="blog-card__bottom">
                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'clock'); ?></i>
                                9 хв
                            </span>

                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'calendar'); ?></i>
                                16.01.26
                            </span>

                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'user'); ?></i>
                                <a href="/authors/andrij-kravczov/">
                                   Андрій Кравцов
                                </a>
                            </span>
                        </div>
                    </div>

                </div>

                <div class="blog-card">
                    <a href="/article/nevdala-rosijska-revolyucziya-povstannya-dekabrystiv-1825-roku/" class="blog-card__image">
                        <img src="//localhost:3000/wp-content/uploads/2026/03/rectangle-2.png"
                             alt="<?= esc_attr($alt ?: $title); ?>"
                             loading="lazy">
                    </a>

                    <div class="blog-card__box">
                        <a href="/article/nevdala-rosijska-revolyucziya-povstannya-dekabrystiv-1825-roku/" class="h2">Невдала російська революція? Повстання декабристів 1825 року</a>

                        <div class="blog-card__bottom">
                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'clock'); ?></i>
                                9 хв
                            </span>

                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'calendar'); ?></i>
                                16.01.26
                            </span>

                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'user'); ?></i>
                                <a href="/authors/andrij-kravczov/">
                                   Андрій Кравцов
                                </a>
                            </span>
                        </div>
                    </div>

                </div>

                <div class="blog-card">
                    <a href="/article/nevdala-rosijska-revolyucziya-povstannya-dekabrystiv-1825-roku/" class="blog-card__image">
                        <img src="//localhost:3000/wp-content/uploads/2026/03/rectangle-2.png"
                             alt="<?= esc_attr($alt ?: $title); ?>"
                             loading="lazy">
                    </a>

                    <div class="blog-card__box">
                        <a href="/article/nevdala-rosijska-revolyucziya-povstannya-dekabrystiv-1825-roku/" class="h2">Невдала російська революція? Повстання декабристів 1825 року</a>

                        <div class="blog-card__bottom">
                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'clock'); ?></i>
                                9 хв
                            </span>

                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'calendar'); ?></i>
                                16.01.26
                            </span>

                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'user'); ?></i>
                                <a href="/authors/andrij-kravczov/">
                                   Андрій Кравцов
                                </a>
                            </span>
                        </div>
                    </div>

                </div>

                <div class="blog-card">
                    <a href="/article/nevdala-rosijska-revolyucziya-povstannya-dekabrystiv-1825-roku/" class="blog-card__image">
                        <img src="//localhost:3000/wp-content/uploads/2026/03/rectangle-2.png"
                             alt="<?= esc_attr($alt ?: $title); ?>"
                             loading="lazy">
                    </a>

                    <div class="blog-card__box">
                        <a href="/article/nevdala-rosijska-revolyucziya-povstannya-dekabrystiv-1825-roku/" class="h2">Невдала російська революція? Повстання декабристів 1825 року</a>

                        <div class="blog-card__bottom">
                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'clock'); ?></i>
                                9 хв
                            </span>

                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'calendar'); ?></i>
                                16.01.26
                            </span>

                            <span class="blog-card__info">
                                <i class="sprite"><?php sprite(16, 16, 'user'); ?></i>
                                <a href="/authors/andrij-kravczov/">
                                   Андрій Кравцов
                                </a>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            <a href="<?php echo home_url('/?s='); ?>" class="main-button" data-search-submit>
                <?= __('Більше статей', 'zirochka') ?>
            </a>
        </div>
    </div>
</div>
