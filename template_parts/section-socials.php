<?php
    $shower     = get_sub_field('shower');
    $editor     = get_sub_field('editor');
    $team       = get_sub_field('team');

    if (!$shower) : ?>
        <section class="socials-section">
            <div class="socials-section__bg">
                <?php sprite(466, 761, 'star2') ?>
            </div>
            <div class="container">
                <div class="socials-section__box">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <h2 class="h1">
                                <i class="sprite">
                                    <?php sprite(29, 28, 'star_icon') ?>
                                </i>
                                <?= esc_html($editor); ?>
                            </h2>
                        </div>
                    <?php endif; ?>

                    <ul class="socials-section__list">
                        <li>
                            <a href="#" class="h2">
                                <?php sprite(24, 24, 'Instagram'); ?>
                                Instagram
                            </a>
                        </li>
                        <li>
                            <a href="#" class="h2">
                                <?php sprite(24, 24, 'X'); ?>
                                X
                            </a>
                        </li>
                        <li>
                            <a href="#" class="h2">
                                <?php sprite(24, 24, 'Telegram'); ?>
                                Telegram
                            </a>
                        </li>
                        <li>
                            <a href="#" class="h2">
                                <?php sprite(24, 24, 'fb'); ?>
                                Facebook
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    <?php endif; ?>
