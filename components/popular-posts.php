<?php
	$popular_posts = new WP_Query([
		'post_type'      => 'blog',
		'posts_per_page' => 6,
		'orderby'        => 'comment_count',
		'order'          => 'DESC',
//		'meta_key' => 'views',
//		'orderby'  => 'meta_value_num',

	]);

	if ( $popular_posts->have_posts() ) : ?>
		<div class="popular-posts">
			<span class="widget__title"><?= __('Most Popular Posts', THEME_SLUG); ?></span>
			<ul class="popular-posts__list">
				<?php while ( $popular_posts->have_posts() ) : $popular_posts->the_post(); ?>
					<li>
						<a href="<?= get_permalink(); ?>"><?= get_the_title(); ?></a>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	<?php endif;

	wp_reset_postdata();
