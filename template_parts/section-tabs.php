<?php
	$shower  = get_sub_field( 'shower' );
	$tabs    = get_sub_field( 'tabs' );

	if ( ! $shower ) : ?>

        <section class="section-tabs" data-tabs-parent>
            <div class="container">
                <div class="section-tabs__inner">
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

                    <ul class="tabs-content">
                        <?php foreach ( $tabs as $index => $tab ) :
                            $label = $tab['label'];
                            $image = $tab['image'];
                            $editor = $tab['tabs_group']['editor'];
                             ?>

                            <li class="tabs-content__item <?= $index === 0 ? 'active' : '' ?>"
                                data-tab-content="<?= $index + 1 ?>">
                                <div class="tab-card">
                                    <div class="tab-card__label">
                                        <?= $label; ?>
                                    </div>

                                    <div class="tab-card__image">
                                        <?= display_image( $image, 1856, 824 ) ?>
                                    </div>

                                    <div class="tab-card__editor editor">
                                        <?= $editor; ?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

	<?php endif; ?>



