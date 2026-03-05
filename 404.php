<?php get_header(); ?>

	<section class="error-section">
		<div class="container">
			<div class="error-section__box">
				<?php if ( have_rows( '404', 'options_404' ) ) : ?>
					<?php while ( have_rows( '404' , 'options_404' ) ) : the_row();
						$editor = get_sub_field('editor');
						$image = get_sub_field('image');
					?>

						<div class="error-section__inner editor">
							<?= $editor;?>
						</div>
						<?php display_image($image, 880, 500)?>
					<?php endwhile; ?>
				<?php endif; ?>


			</div>
		</div>
	</section>

<?php get_footer(); ?>


