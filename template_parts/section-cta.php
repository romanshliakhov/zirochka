<?php
$cta_sections       = get_sub_field( 'cta_section' );

if ( $cta_sections ) :
    foreach ( $cta_sections as $cta ) :

        if ( $cta['acf_fc_layout'] === 'cta_1' ) :
            $section_id = get_field( 'section_id' );
            $editor1 = $cta['editor'] ?? [];
            $editor2 = $cta['editor2'] ?? []; ?>

            <section class="cta-section mode" <?= $section_id ? 'id="' . esc_attr( $section_id ) . '"' : ''; ?>>
                <div class="container">
                    <div class="cta-section__box">
                        <div class="cta-section__bg">
                            <img width="248" height="240"
                                 src="<?= esc_url(get_template_directory_uri() . '/assets/img/sprite/star.svg'); ?>"
                                 loading="lazy"/>
                        </div>

                        <?php if (!empty($editor1)) : ?>
                            <div class="editor">
                                <?= wp_kses_post($editor1); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($editor2)) : ?>
                            <div class="editor">
                                <?= wp_kses_post($editor2); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif;

        if ( $cta['acf_fc_layout'] === 'cta_2' ) :
            $section_id = get_field( 'section_id' );
            $editor1 = $cta['editor'] ?? [];
            $editor2 = $cta['editor2'] ?? [];
            $bg = $cta['bg'] ?? []; ?>

            <section class="cta-section">
                <?php if ($bg): ?>
                    <?= display_image($bg, 1920, 153, 'cta-section__bg'); ?>
                <?php endif; ?>
                <div class="container">
                    <div class="cta-section__box">
                        <?php if (!empty($editor1)) : ?>
                            <div class="editor">
                                <?= wp_kses_post($editor1); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($editor2)) : ?>
                            <div class="editor">
                                <?= wp_kses_post($editor2); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif;

    endforeach;
endif;



