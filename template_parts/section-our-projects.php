<?php
	$shower  = get_sub_field( 'shower' );
    $editor  = get_sub_field( 'editor' );
 	$tabs    = get_sub_field( 'tabs' );
	
	if ( ! $shower ) : ?>

        <section class="section-portfolio" data-tabs-parent>
            <div class="decor-lines"></div>
            <div class="container">
                <div class="section-portfolio__wrapp">
                    <div class="section-portfolio__top">
                        <div class="editor">
                            <?=$editor?>
                        </div>

                        <ul class="tabs-nav">
                            <?php foreach ( $tabs as $index => $tab ) : ?>
                                <li class="tabs-nav__item">
                                    <button class="tabs-nav__btn <?= $index === 0 ? 'active' : '' ?>" type="button"
                                            data-tab="<?= $index + 1 ?>">
                                        <span><?= $tab['tab_name'] ?></span>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <ul class="tabs-content">
                        <?php foreach ( $tabs as $index => $tab ) :
                            $posts = $tab['posts'];
                             ?>

                            <li class="tabs-content__item <?= $index === 0 ? 'active' : '' ?>" data-tab-content="<?= $index + 1 ?>">
                                <div class="section-portfolio__slider">
                                    <div class="swiper-container">
                                        <ul class="swiper-wrapper">
                                            <?php foreach ($posts as $post_id) : ?>
                                                <li class="swiper-slide">
                                                    <?php display_projects_card_default($post_id); ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>

                                    <div class="section-portfolio__controls">
                                        <div class="slider-btn portfolio-prev">
                                            <?php sprite(32, 32, 'ArrowLeft') ?>
                                        </div>
                                        <div class="slider-btn portfolio-next">
                                            <?php sprite(32, 32, 'ArrowRight') ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

	<?php endif; ?>



