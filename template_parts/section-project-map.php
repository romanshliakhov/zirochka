<?php
    $shower = get_sub_field('shower');
    $editor = get_sub_field('editor');
    $image = get_sub_field('image');

    if (!$shower) : ?>
        <section class="project-map">
            <div class="container">
                <div class="project-map__wrapp">
                    <div class="project-map__box">
                        <?php if (!empty($editor)) : ?>
                            <div class="editor">
                                <?= $editor; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="project-map__frame">
                        <?= display_image($image, 1093, 600, 'project-map__bg') ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
