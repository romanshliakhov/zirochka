<?php
    $shower     = get_sub_field('shower');
    $editor     = get_sub_field('editor');
    $team       = get_sub_field('team');

    if (!$shower) : ?>
        <section class="section-team">
            <div class="decor-lines"></div>
            <div class="container">
                <div class="section-team__wrapp">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($team) : ?>
                        <div class="section-team__slider">
                            <div class="swiper-container">
                                <ul class="swiper-wrapper">
                                    <?php foreach ($team as $item) :
                                        $image   = $item['image'];
                                        $role = $item['role'];
                                        $name   = $item['name'];
                                    ?>
                                        <li class="swiper-slide">
                                            <div class="member-card">
                                                <?php if ($image) : ?>
                                                    <div class="member-card__image">
                                                        <?= wp_get_attachment_image($image['ID'], 'full'); ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($role) : ?>
                                                    <p class="member-card__role"><?= esc_html($role); ?></p>
                                                <?php endif; ?>

                                                <?php if ($name) : ?>
                                                    <span class="member-card__name"><?= esc_html($name); ?></span>
                                                <?php endif; ?>
                                            </div>
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
