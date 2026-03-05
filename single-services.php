<?php
	get_header();
	$post_id = get_the_ID();
	$shortcode = get_field('get_shortcode');

	if (have_posts()) : while (have_posts()) : the_post(); ?>
        <section <?php post_class('services-post'); ?>>
            <div class="container">
				<?php get_breadcrumbs(); ?>
            </div>

            <div class="container container--small">
				<h1 class="services-post__title h3"><?php the_title(); ?></h1>

				<?php if (has_excerpt()) : ?>
					<div class="services-post__excerpt"><?php the_excerpt(); ?></div>
				<?php endif; ?>
            </div>

			<?php the_post_thumbnail(); ?>

            <div class="container container--small">
                <div class="editor">
                    <?php the_content(); ?>
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
<?php
	get_footer();
?>
