<?php /* Template Name: Archive Blog */ ?>
<?php get_header();

$page_post = get_post();

$posts = new WP_Query([
    'post_type'      => 'blog',
    'posts_per_page' => 6,
    'paged'          => get_query_var('paged') ?: 1,
]);

global $wp_query;
$temp_query = $wp_query;
$wp_query   = $posts;

$current = max(1, get_query_var('paged'));
$max     = $posts->max_num_pages;
?>

<section class="blog">
    <div class="container">
        <div class="blog__wrapp">
            <?php if ($page_post): ?>
                <div class="blog__top editor">
                    <?= apply_filters('the_content', $page_post->post_content); ?>
                </div>
            <?php endif; ?>

            <div class="blog__posts" data-loader="false">
                <?php if ($posts->have_posts()) :
                    while ($posts->have_posts()) :
                        $posts->the_post();
                        display_post_card(get_the_ID());
                    endwhile;
                else : ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>

			<div class="pagination-wrapper">
				<?php if ($max > 1): ?>
					<div class="pagination">
						<button class="pagination__item pagination__prev"
								data-direction="prev"
								<?= $current === 1 ? 'disabled' : '' ?>>
							<span class="icon-prev"></span>
						</button>

						<?php for ($i = 1; $i <= $max; $i++): ?>
							<button class="pagination__item <?= $i === $current ? 'active' : '' ?>"
									data-page="<?= $i ?>">
								<?= $i ?>
							</button>
						<?php endfor; ?>

						<button class="pagination__item pagination__next"
								data-direction="next"
								<?= $current === $max ? 'disabled' : '' ?>>
							<span class="icon-next"></span>
						</button>
					</div>
				<?php endif; ?>
			</div>
        </div>
    </div>
</section>

<?php
$wp_query = $temp_query;
wp_reset_postdata();
get_footer();
