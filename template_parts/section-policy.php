<?php
    $shower       = get_sub_field('shower');
    $editor       = get_sub_field('editor');

    if (!$shower) : ?>
        <section class="section-policy">
            <div class="container">
                <?php if (!empty($editor)) : ?>
                    <div class="editor">
                        <?= $editor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
