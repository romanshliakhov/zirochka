<?php
	get_header();

	$post_id = get_the_ID();
	$post_editor = get_field('post_editor', $post_id);
	$roofing  = get_the_terms( $post_id, 'roofing_type' );
	$color    = get_the_terms( $post_id, 'roof_color' );
	$location = get_the_terms( $post_id, 'project_location' );

	$map_editor = get_field('map_editor', $post_id);
	$gallery = get_field('gallery', $post_id);
?>

<section class="single-project">
	<div class="container">
		<div class="single-project__wrapp">
			<?php get_breadcrumbs(); ?>

            <ul class="single-project__tags">
                <li>
                    <?php if ( $roofing ) : ?>
                        <span class="project-card__tag">
                            <?= render_terms( $roofing ); ?>
                        </span>
                    <?php endif; ?>
                </li>

                <li>
                    <?php if ( $color ) : ?>
                        <span class="project-card__tag">
                            <?= render_terms( $color ); ?>
                        </span>
                    <?php endif; ?>
                </li>
                
                <li>
                    <?php if ( $location ) : ?>
                        <span class="project-card__tag">
                            <?php sprite( 20, 20, 'MapPin' ) ?>
                            <?= render_terms( $location ); ?>
                        </span>
                    <?php endif; ?>
                </li>
            </ul>

			<div class="single-project__content">
				<?php if ($post_editor): ?>
					<div class="editor">
						<?= $post_editor ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if ($gallery): ?>
				<div class="single-project__slider">
					<div class="swiper-container">
						<ul class="swiper-wrapper">
							<?php foreach ($gallery as $image): ?>
								<li class="swiper-slide">
									<div class="single-project__image">
										<?= wp_get_attachment_image($image['ID'], 'full'); ?>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>

						<span class="swiper-pagination"></span>

						<div class="slider-btn prev">
							<?php sprite(32, 32, 'ArrowLeft'); ?>
						</div>
						<div class="slider-btn next">
							<?php sprite(32, 32, 'ArrowRight'); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="project-map">
	<div class="container">
		<div class="project-map__wrapp">
			<div class="project-map__box">
				<?php if ($map_editor): ?>
					<div class="editor">
						<?= $map_editor ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="project-map__frame" id="single-town" data-map></div>
		</div>
	</div>
</section>

<?php
// Подготовка данных для JS-карты
$location_data = [
	'lat'   => get_field('coordinates')['lat'],
	'lng'   => get_field('coordinates')['lng'],
	'title' => get_the_title(),
	'image' => '',
	'tags'  => [],
];

if (!empty($gallery)) {
	$location_data['image'] = wp_get_attachment_image_url($gallery[0]['ID'], 'medium');
} else {
	$location_data['image'] = get_the_post_thumbnail_url($post_id, 'medium') ?: 'https://via.placeholder.com/250x140';
}

$taxonomies = ['roofing_type', 'roof_color', 'project_location'];
foreach ($taxonomies as $tax) {
	$terms = get_the_terms($post_id, $tax);
	if ($terms && !is_wp_error($terms)) {
		foreach ($terms as $term) {
			$location_data['tags'][] = $term->name;
		}
	}
}
?>

<script>
	window.projectLocations = [<?= json_encode($location_data, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>];
</script>

<?php
// ACF Builder
if (have_rows('builder', $post_id)) {
	while (have_rows('builder', $post_id)) {
		the_row();
		get_template_part('template_parts/' . str_replace('_', '-', get_row_layout()));
	}
}

get_footer();
?>
