<?php
$shower  = get_sub_field('shower');
$editor  = get_sub_field('editor');

if (!$shower) :
	$provinces = get_terms([
		'taxonomy' => 'locations_province',
		'hide_empty' => false
	]);
?>

<section class="section-areas" data-tabs-parent>
	<div class="decor-lines"></div>
	<div class="container">
		<div class="section-areas__wrapp">
			<div class="section-areas__top">
				<?php if (!empty($editor)) : ?>
					<div class="editor">
						<?= $editor ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($provinces)) : ?>
					<ul class="tabs-nav">
						<?php foreach ($provinces as $index => $province) : ?>
							<li class="tabs-nav__item">
								<button
									class="tabs-nav__btn <?= $index === 0 ? 'active' : '' ?>"
									type="button"
									data-tab="<?= esc_attr($province->slug) ?>"
								>
									<span><?= esc_html($province->name) ?></span>
								</button>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<?php if (!empty($provinces)) : ?>
				<ul class="section-areas__content tabs-content">
					<?php foreach ($provinces as $index => $province) :
						$cities = get_posts([
							'post_type' => 'locations',
							'tax_query' => [
								[
									'taxonomy' => 'locations_province',
									'field' => 'slug',
									'terms' => $province->slug,
								],
							],
							'posts_per_page' => -1,
							'orderby' => 'title',
							'order' => 'ASC',
						]);
					?>
						<li
							class="tabs-content__item <?= $index === 0 ? 'active' : '' ?>"
							data-tab-content="<?= esc_attr($province->slug) ?>"
						>
							<span>City in <?= esc_html($province->name) ?></span>

							<div class="section-areas__box">
								<ul class="section-areas__list">
                                    <?php foreach ($cities as $cityIndex => $city) : ?>
                                        <li>
                                            <button
                                                class="<?= $cityIndex === 0 ? 'active' : '' ?>"
                                                type="button"
                                                data-city-id="<?= $city->ID ?>"
                                            >
                                                <?= esc_html($city->post_title) ?>
                                            </button>
                                        </li>
                                    <?php endforeach; ?>
								</ul>

								<div class="section-areas__location" data-map></div>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php endif; ?>
