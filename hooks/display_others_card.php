<?php
    // Функция для красивого вывода терминов
    function render_terms( $terms ) {
        if ( is_array( $terms ) && ! is_wp_error( $terms ) ) {
            return implode( ', ', wp_list_pluck( $terms, 'name' ) );
        }
        return '';
    }

    function display_others_card( $post_id ) {
        if ( ! $post_id ) {
            return;
        }

        $title    = get_the_title( $post_id );
        $roofing  = get_the_terms( $post_id, 'roofing_type' );
        $color    = get_the_terms( $post_id, 'roof_color' );
        $location = get_the_terms( $post_id, 'project_location' );
        $gallery  = get_field('gallery', $post_id);
        ?>

        <div class="other-card">
            <?php if ( $gallery ) : ?>
                <div class="other-card__slider">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach ( $gallery as $image ) : ?>
                                <div class="swiper-slide">
                                    <img src="<?= esc_url($image['url']) ?>" alt="<?= esc_attr($image['alt']) ?>" />
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="swiper-pagination"></div>

                        <div class="slider-btn prev">
                            <?php sprite(32, 32, 'ArrowLeft'); ?>
                        </div>
                        <div class="slider-btn next">
                            <?php sprite(32, 32, 'ArrowRight'); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <ul class="other-card__tags">
                <li>
                    <?php if ( $roofing ) : ?>
                        <span class="other-card__tag">
                            <?= render_terms( $roofing ); ?>
                        </span>
                    <?php endif; ?>
                </li>

                <li>
                    <?php if ( $color ) : ?>
                        <span class="other-card__tag">
                            <?= render_terms( $color ); ?>
                        </span>
                    <?php endif; ?>
                </li>
                
                <li>
                    <?php if ( $location ) : ?>
                        <span class="other-card__tag">
                            <?php sprite( 20, 20, 'MapPin' ) ?>
                            <?= render_terms( $location ); ?>
                        </span>
                    <?php endif; ?>
                </li>
            </ul>

            <div class="other-card__bottom">
                <a class="other-card__title" href="<?= get_the_permalink( $post_id ) ?>"><?= $title; ?></a>

                <a class="main-button main-button--blue" href="<?= get_the_permalink( $post_id ) ?>">
                    <?= __('About project', THEME_SLUG)?>
                </a>
            </div>
        </div>
    <?php
}
