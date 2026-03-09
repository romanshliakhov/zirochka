<?php
$shower = get_sub_field('shower');
$editor = get_sub_field('editor');
$list = get_sub_field('list');

if (!$shower) : ?>
    <section class="mission-section">
        <div class="container">
            <div class="mission-section__box">
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

                <?php if ($list) : ?>
                    <ul class="mission-section__list">
                        <?php foreach ($list as $item) :
                            $title = $item['title'];
                            $text = $item['description'];
                            ?>
                            <li class="mission-section__item">
                                <i class="sprite">
                                    <?php sprite(60, 64, 'star_icon') ?>
                                </i>

                                <span class="h2"><?= esc_html($title); ?></span>

                                <p><?= esc_html($text); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
