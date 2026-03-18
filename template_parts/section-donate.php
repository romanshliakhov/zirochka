<?php
$shower = get_sub_field('shower');
$editor = get_sub_field('editor');
$list = get_sub_field('list');

if (!$shower) : ?>
    <section class="donate-section">
        <div class="donate-section__bg">
            <img width="248" height="240"
                 src="<?= esc_url(get_template_directory_uri() . '/assets/img/star_bg_author.png'); ?>"
                 loading="lazy"/>
        </div>
        <div class="container">
            <div class="donate-section__box">
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
                    <ul class="donate-section__list">
                        <?php foreach ($list as $item) :
                            $title = $item['title'];
                            $text = $item['description'];
                            $image = $item['image'];
                            $link  = $item['link'];
                            ?>
                            <li class="donate-section__item">
                                <div class="donate-card">

                                    <?php if ($image): ?>
                                        <?= display_image($image, 64, 64, 'donate-card__image'); ?>
                                    <?php endif; ?>

                                    <?php if ($title): ?>
                                        <span class="h3"><?= esc_html($title); ?></span>
                                    <?php endif; ?>

                                    <?php if ($text): ?>
                                        <p><?= esc_html($text); ?></p>
                                    <?php endif; ?>

                                    <?php if ($link) :
                                        $url = $link['url'];
                                        $title = $link['title'];
                                        $target = $link['target'] ?: '_self';
                                        ?>
                                        <a href="<?= esc_url($url); ?>"
                                           target="<?= esc_attr($target); ?>"
                                           class="main-button main-button--green">

                                            <?= esc_html($title); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
