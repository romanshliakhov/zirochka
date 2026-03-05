<section class="projects">
	<div class="decor-lines"></div>
	<div class="container">
		<div class="projects__wrapp">

			<div class="projects__box">
				<div class="filters">
					<div class="filters__box">
						<span>Type of roofing</span>
						<div id="filter-types" class="filter-types" data-name="types">
							<div class="custom-select">
								<div class="select-field">
									<div class="selected-options">
										<span class="placeholder">All</span>
									</div>
									<span class="icon-arrow-down"></span>
								</div>
								<ul class="options-container">
									<?php
									$terms = get_terms([
										'taxonomy' => 'roofing_type',
										'hide_empty' => false,
										'orderby' => 'term_id', // ← замени при необходимости
										'order' => 'ASC',
									]);
									foreach ($terms as $term) :
									?>
										<li class="option" data-value="<?= esc_attr($term->slug); ?>">
											<span class="option-text"><?= esc_html($term->name); ?></span>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>

					<div class="filters__box">
						<span>Locations</span>
						<div id="filter-locations" class="filter-locations" data-name="locations">
							<div class="custom-select">
								<div class="select-field">
									<div class="selected-options">
										<span class="placeholder">All</span>
									</div>
									<span class="icon-arrow-down"></span>
								</div>
								<ul class="options-container">
									<?php
									$terms = get_terms(['taxonomy' => 'project_location', 'hide_empty' => false]);
									foreach ($terms as $term) :
									?>
										<li class="option" data-value="<?= esc_attr($term->slug); ?>">
											<span class="option-text"><?= esc_html($term->name); ?></span>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>

					<div class="filters__box">
						<span>Roof color</span>
						<div id="filter-colors" class="filter-colors" data-name="colors">
							<div class="custom-select">
								<div class="select-field">
									<div class="selected-options">
										<span class="placeholder">All</span>
									</div>
									<span class="icon-arrow-down"></span>
								</div>
								<ul class="options-container">
									<?php
									$terms = get_terms(['taxonomy' => 'roof_color', 'hide_empty' => false]);
									foreach ($terms as $term) :
									?>
										<li class="option" data-value="<?= esc_attr($term->slug); ?>">
											<span class="option-text"><?= esc_html($term->name); ?></span>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="projects__items">
                    <div class="projects__items-list">
                        <?php
                        $projects = new WP_Query([
                            'post_type' => 'projects',
                            'posts_per_page' => 4,
                        ]);
                        if ($projects->have_posts()) :
                            while ($projects->have_posts()) : $projects->the_post();
                        ?>
                            <?php display_projects_card(get_the_ID()); ?>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php else : ?>
                            <p>No projects found.</p>
                        <?php endif; ?>
                    </div>

                    <button class="main-button main-button--red" id="load-more-projects" data-offset="4">
                        See more
                    </button>
				</div>
			</div>
		</div>
	</div>
</section>
