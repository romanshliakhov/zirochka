<?php
    $shower       = get_sub_field('shower');
    $editor       = get_sub_field('editor');
    $post_ids = get_sub_field('posts'); 


    if (!$shower) : ?>
        <section class="section-typeof">
            <div class="decor-lines"></div>
            <div class="container">
                <div class="section-typeof__wrapp">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($post_ids) : ?>
                        <ul class="typeof-list">
                            <?php foreach ($post_ids as $post_id) :
                                $title     = get_the_title($post_id);
                                $thumbnail = get_the_post_thumbnail($post_id, 'medium');
                                $permalink = get_permalink($post_id);

                                if (!$title && !$thumbnail) continue;
                            ?>
                                <li class="typeof-list__item">
                                    <a class="typeof-list__link" href="<?= esc_url($permalink); ?>">
                                        <?php if ($thumbnail) : ?>
                                            <div class="typeof-list__image">
                                                <?= $thumbnail; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($title) : ?>
                                            <div class="typeof-list__title"><?= esc_html($title); ?></div>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
