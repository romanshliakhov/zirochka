<?php
    $shower     = get_sub_field('shower');
    $editor     = get_sub_field('editor');
    $team       = get_sub_field('team');

    if (!$shower) : ?>
        <section class="team-section">
            <div class="container">
                <div class="team-section__box">
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
                    <?php if ($team) : ?>
                        <ul class="team-section__list">
                            <?php foreach ($team as $item) :
                                $image   = $item['image'];
                                $group = $item['team_group'];
                                $role = $group['role'];
                                $name   = $group['name'];
                                ?>
                                <li class="team-section__item">
                                    <?php if ($image) : ?>
                                        <div class="team-section__image">
                                            <?= wp_get_attachment_image($image['ID'], 'full'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($name) : ?>
                                        <span class="h2"><?= esc_html($name); ?></span>
                                    <?php endif; ?>

                                    <?php if ($role) : ?>
                                        <p><?= esc_html($role); ?></p>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
