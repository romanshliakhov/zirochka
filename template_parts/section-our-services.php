<?php
$shower   = get_sub_field('shower');
$editor   = get_sub_field('editor');
$services = get_sub_field('services');

if ( ! $shower ) : ?>
<section class="section-our-services">
    <div class="container">
        <div class="section-our-services__wrapp">

            <?php if ($editor) : ?>
                <div class="editor">
                    <?= wp_kses_post($editor); ?>
                </div>
            <?php endif; ?>

            <?php if ($services) : ?>
                <div class="section-our-services__slider">
                    <div class="swiper-container">
                        <ul class="swiper-wrapper">
                            <?php foreach ($services as $service_id) :
                                $title   = get_the_title($service_id);
                                $excerpt = get_the_excerpt($service_id);
                                $thumb_id = get_post_thumbnail_id($service_id);
                                $permalink = get_permalink($service_id);
                            ?>
                                <li class="swiper-slide">
                                    <a class="service-card" href="<?= esc_url($permalink); ?>">
                                        <?php if ($thumb_id) : ?>
                                            <div class="service-card__image">
                                                <?= wp_get_attachment_image($thumb_id, 'full'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="service-card__info">
                                            <?php if ($title) : ?>
                                                <div class="service-card__title">
                                                    <?= esc_html($title); ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($excerpt) : ?>
                                                <p class="service-card__excerpt">
                                                    <?= esc_html($excerpt); ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php endif; ?>
