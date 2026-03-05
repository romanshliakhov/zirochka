<?php
    $shower = get_sub_field('shower');
    $editor = get_sub_field('editor');
    $list   = get_sub_field('list');

    if (!$shower) : ?>
        <section class="section-program">
            <div class="container">
                <div class="section-program__inner">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($list) : ?>
                        <ul class="program-list">
                            <?php foreach ($list as $item) :
                                $text = $item['text'];
                            ?>
                                <li class="program-list__box">
                                    <?php if ($text) : ?>
                                        <p class="program-list__text"><?= $text; ?></p>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
