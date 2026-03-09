<?php
    $shower     = get_sub_field('shower');
    $editor     = get_sub_field('editor');
    $team       = get_sub_field('team');
    $global_setting = get_field('global_contacts', 'settings');
    $socials = $global_setting['social'] ?? [];

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

                    <?php if ($socials) : ?>
                        <ul class="socials-section__list">
                            <?php foreach ($socials as $social) :

                                $link  = $social['social_link'] ?? null;
                                $image = $social['social_image'] ?? null;

                                $url    = $link['url'] ?? '#';
                                $title  = $link['title'] ?? '';
                                $target = $link['target'] ?? '_self';

                                ?>

                                <li>
                                    <a href="<?= esc_url($url); ?>" target="<?= esc_attr($target); ?>" class="h2">

                                        <?php
                                        if ($image && !empty($image['ID'])) {
                                            $path = get_attached_file($image['ID']);

                                                 if ($path && file_exists($path)) {
                                                     echo '<i class="sprite">';
                                                     echo file_get_contents($path);
                                                     echo '</i>';
                                                 }
                                            }
                                        ?>

                                        <?= esc_html($title); ?>

                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
