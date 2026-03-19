<?php
$shower = get_sub_field('shower');
$editor = get_sub_field('editor');
$link = get_sub_field('link');

if (!$shower) :

    $tags = get_terms([
    'taxonomy'   => 'article_tag',
    'hide_empty' => false,
    ]);
    ?>

    <section class="tags-section mode">
        <div class="container">
            <div class="tags-section__box">
                <?php if (!empty($editor)) : ?>
                    <div class="editor">
                        <h2 class="h1">
                            <?= esc_html($editor); ?>
                        </h2>
                    </div>
                <?php endif; ?>


                <?php if ($tags && !is_wp_error($tags)) : ?>
                    <ul class="tags-section__list">
                        <?php foreach ($tags as $tag) :
                            $tag_link = get_term_link($tag);
                            if (is_wp_error($tag_link)) continue;
                            ?>
                            <li>
                                <a href="<?= esc_url($tag_link); ?>" class="tag">
                                    # <?= esc_html($tag->name); ?> (<?= intval($tag->count); ?>)
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>
