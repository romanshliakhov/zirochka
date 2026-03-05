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
							<div class="close modal__close">
								<?php sprite(14, 14, 'close'); ?>
							</div>
							<div class="modal__container">
								<?= display_editor_blocks(get_sub_field('editors'), 'modal_box editor'); ?>
							</div>
						</div>
					<?php endif;

					if (get_row_layout() === 'sizeguide') : 
							$size_charts = get_sub_field('size_charts'); 
							$measure_image  = get_sub_field('measure_image'); 
							$measure_editor = get_sub_field('measure_editor'); 
						?>
						<div class="modal modal--sizeguide" data-popup="modal_<?php echo esc_attr($modal_id); ?>">
							<div class="close modal__close">
								<?php sprite(14, 14, 'close'); ?>
							</div>

							<div class="modal__sizes">
								<button class="modal__sizes-btn active">CM</button>
								<button class="modal__sizes-btn">IN</button>
							</div>

							<div class="modal__sizeguide" data-tabs-init>
								<ul class="modal__sizeguide-nav">
									<li class="active">
										<button class="modal__sizeguide-btn active" type="button" data-tab="size-chart">
											<span>Size Chart</span>
										</button>
									</li>
									<li class="">
										<button class="modal__sizeguide-btn" type="button" data-tab="measure">
											<span>How to measure</span>
										</button>
									</li>
								</ul>

								<ul class="modal__sizeguide-content tabs-content">
									<li class="tabs-content__item active" data-tab-content="size-chart">
										<?php if ($size_charts) : ?>
											<ul class="modal__sizings">
												<?php foreach ($size_charts as $item) :
													$size_editor   = $item['size_editor'];
												?>                  
													<li>
														<div class="editor">
															<?= $size_editor; ?>
														</div>
													</li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</li>

									<li class="tabs-content__item" data-tab-content="measure">
										<div class="modal__measure">
											<?php if ($measure_image) :
												display_image($measure_image, 450, 300, 'modal__measure-img');
											endif; ?>

											<?php if ($measure_editor) : ?>
												<div class="modal__measure-editor editor">
													<?= $measure_editor; ?>
												</div>
											<?php endif; ?>
										</div>
									</li>
								</ul>
							</div>
						</div>
					<?php endif;

					// Лейаут Promo 
					if (get_row_layout() === 'promo') : 
							$promo_media  = get_sub_field('promo_media'); 
							$promo_editor = get_sub_field('promo_editor'); 
						?>
						<div class="modal modal--promo" data-popup="modal_<?php echo esc_attr($modal_id); ?>">
							<div class="close modal__close">
								<?php sprite(14, 14, 'close'); ?>
							</div>

							<div class="modal__promo">
								<?php if ($promo_media) :
									display_image($promo_media[0], 1200, 800, 'modal__promo-media');
								endif; ?>

								<?php if ($promo_editor) : ?>
									<div class="modal__promo-editor editor">
										<?= $promo_editor; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif;
				endwhile;
			endif;

		endwhile;
	endif;

	wp_reset_postdata();
	?>
</div>
