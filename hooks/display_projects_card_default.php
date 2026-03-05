<?php
    // Функция для красивого вывода терминов
    // function render_terms( $terms ) {
    //     if ( is_array( $terms ) && ! is_wp_error( $terms ) ) {
    //         return implode( ', ', wp_list_pluck( $terms, 'name' ) );
    //     }
    //     return '';
    // }

    function display_projects_card_default( $post_id ) {
        if ( ! $post_id ) {
            return;
        }

        $title     = get_the_title( $post_id );
        $roofing   = get_the_terms( $post_id, 'roofing_type' );
        $color     = get_the_terms( $post_id, 'roof_color' );
        $location  = get_the_terms( $post_id, 'project_location' );
        $thumbnail = get_the_post_thumbnail_url( $post_id, 'large' ); // или 'full', 'medium'

        ?>

        <div class="project-card">
            <div class="project-card__thumbnail">
                <?php if ( $thumbnail ) : ?>
                    <img src="<?= esc_url( $thumbnail ); ?>" alt="<?= esc_attr( $title ); ?>" loading="lazy" width="600" height="400" />
                <?php endif; ?>
            </div>

            <ul class="project-card__tags">
                <?php if ( $roofing ) : ?>
                    <li>
                        <span class="project-card__tag">
                            <?= render_terms( $roofing ); ?>
                        </span>
                    </li>
                <?php endif; ?>

                <?php if ( $color ) : ?>
                    <li>
                        <span class="project-card__tag">
                            <?= render_terms( $color ); ?>
                        </span>
                    </li>
                <?php endif; ?>

                <?php if ( $location ) : ?>
                    <li>
                        <span class="project-card__tag">
                            <?php sprite( 20, 20, 'MapPin' ); ?>
                            <?= render_terms( $location ); ?>
                        </span>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="project-card__bottom">
                <span class="project-card__title"><?= esc_html( $title ); ?></span>
                <a class="main-button main-button--blue" href="<?= esc_url( get_permalink( $post_id ) ); ?>">
                    <?= __( 'About project', THEME_SLUG ); ?>
                </a>
            </div>
        </div>
        <?php
    }
?>
