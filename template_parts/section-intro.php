<?php
    $shower       = get_sub_field('shower');
    $editor       = get_sub_field('editor');


    if (!$shower) : ?>
        <section class="section-intro">
            <div class="container">
                <div class="section-intro__wrapp">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
