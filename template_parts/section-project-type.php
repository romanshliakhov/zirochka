<?php
    $shower      = get_sub_field('shower');
    $editor_top  = get_sub_field('editor_top');
    $types       = get_sub_field('types');

    if (!$shower) : ?>
        <section class="project-type">
            <div class="container">
                <div class="project-type__wrapp">
                    <?php if (!empty($editor_top)) : ?>
                        <div class="editor">
                            <?= $editor_top; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($types)) : ?>
                        <ul class="project-type__items">
                            <?php foreach ($types as $item) :
                                $editor    = $item['editor'] ?? '';
                                $animation = $item['type_animation'] ?? null;
                            ?>
                                <li class="project-type__box">
                                    <?php if (!empty($editor)) : ?>
                                        <div class="editor">
                                            <?= $editor; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($animation) && isset($animation['url'], $animation['mime_type'])) : ?>
                                        <div class="project-type__animation">
                                            <video autoplay muted loop playsinline preload="auto">
                                                <source src="<?= esc_url($animation['url']); ?>" type="<?= esc_attr($animation['mime_type']); ?>">
                                            </video>
                                        </div>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
