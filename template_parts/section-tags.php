<?php
$shower = get_sub_field('shower');
$editor = get_sub_field('editor');
$link = get_sub_field('link');

if (!$shower) :

    $tags = get_terms([
    'taxonomy'   => 'article_tag',
    'hide_empty' => false,
    ]);

    $limit = 32;

    $visible_tags = array_slice($tags, 0, $limit);
    $hidden_tags  = array_slice($tags, $limit);
    ?>

    <section class="tags-section">
        <div class="container">
            <div class="tags-section__box">
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

                <div class="tags-section__content">
                    <?php if ($tags && !is_wp_error($tags)) : ?>
                        <ul class="tags-section__list">

                            <?php foreach ($visible_tags as $tag) :
                                $tag_link = get_term_link($tag);
                                if (is_wp_error($tag_link)) continue;
                                ?>
                                <li>
                                    <a href="<?= esc_url($tag_link); ?>" class="tag">
                                        # <?= esc_html($tag->name); ?> (<?= intval($tag->count); ?>)
                                    </a>
                                </li>
                            <?php endforeach; ?>

                            <?php if (!empty($hidden_tags)) : ?>
                                <?php foreach ($hidden_tags as $tag) :
                                    $tag_link = get_term_link($tag);
                                    if (is_wp_error($tag_link)) continue;
                                    ?>
                                    <li class="tag-hidden">
                                        <a href="<?= esc_url($tag_link); ?>" class="tag">
                                            # <?= esc_html($tag->name); ?> (<?= intval($tag->count); ?>)
                                        </a>
                                    </li>
                                <?php endforeach; ?>

                                <?php if ($link && is_array($link)) :
                                    $link_url    = $link['url'] ?? '#';
                                    $link_title  = $link['title'];
                                    $link_target = $link['target'] ?? '_self';
                                    ?>
                                    <li class="tags-section__all">
                                        <a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>" class="tag tag--all">
                                            # <?php echo __('Усі теги', 'zirochka') ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>

                        </ul>
                    <?php endif; ?>

                        <button class="main-button main-button--transparent js-show-all-tags">
                            <?php echo __('Показати більше', 'zirochka') ?>
                        </button>

                </div>
            </div>
        </div>
    </section>

<?php endif; ?>
