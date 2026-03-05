<?php
	$shower = get_sub_field('shower');
	$editor = get_sub_field('editor');
	$faqs   = get_sub_field('faq');

	if (!$shower) : ?>
		<section class="section-faq" data-accordion>
			<div class="decor-lines"></div>
			<div class="container">
				<div class="section-faq__wrapp">
					<?php if (!empty($editor)) : ?>
						<div class="editor">
							<?= $editor; ?>
						</div>
					<?php endif; ?>

					<?php if ($faqs) : ?>
						<ul class="accordion" data-single="true" data-breakpoint="576" data-accordion>
							<?php foreach ($faqs as $index => $faq) :
								$id = $index + 1;
								$faq_heading = $faq['title'];
								$faq_editor  = $faq['faq_editor'];
							?>
								<li class="accordion__item">
									<?php if ($faq_heading) : ?>
										<button class="accordion__btn" data-id="<?= esc_attr($id); ?>">
											<?= esc_html($faq_heading); ?>
											<?php sprite( 48, 48, 'PlusCircle' ) ?>
										</button>
									<?php endif; ?>

									<div class="accordion__content" data-content="<?= esc_attr($id); ?>">
										<article class="editor">
											<?= $faq_editor; ?>
										</article>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
