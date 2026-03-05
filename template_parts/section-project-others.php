<?php
    $shower = get_sub_field('shower');
    $editor = get_sub_field('editor');
    $posts = get_sub_field('posts');

    if (!$shower) : ?>
        <section class="project-others">
            <div class="decor-lines"></div>
            <div class="container">
                <div class="project-others__wrapp">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>

                    <div class="project-others__items">
                        <?php if (!empty($posts)) :
                            foreach ($posts as $post_id) :
                                display_others_card($post_id); // Вызываем функцию для каждого ID
                            endforeach;
                        else : ?>
                            <p>No projects selected.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
