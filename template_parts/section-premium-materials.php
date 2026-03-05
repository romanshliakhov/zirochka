<?php
$shower = get_sub_field('shower');
$editor = get_sub_field('editor');
$list   = get_sub_field('list');

if (!$shower) : ?>
    <section class="section-premium">
        <div class="container">
            <div class="section-premium__wrapp">
                <?php if (!empty($editor)) : ?>
                    <div class="section-premium__editor editor">
                        <?= $editor; ?>
                    </div>
                <?php endif; ?>

                <?php if ($list) : ?>
                    <ul class="section-premium__items">
                        <?php foreach ($list as $index => $item) :
                            $item_editor = $item['editor'];
                            $model_file = $item['model_file'];
                            $model_scale = $item['model_scale'];
                            $model_file_url = $model_file['url'] ?? '';
                            $model_id = 'three-container-' . $index;
                        ?>
                            <li class="section-premium__item">
                                <div class="section-premium__item-model"
                                    id="<?= esc_attr($model_id); ?>"
                                    data-model="<?= esc_url($model_file_url); ?>"
                                    data-model-scale="<?= esc_attr($model_scale ?: '1'); ?>">

                                    <span class="section-premium__item-icon">
                                        <?php sprite( 64, 64, '3d' ) ?>
                                    </span>
                                </div>

                                <?php if ($item_editor) : ?>
                                    <div class="editor"><?= $item_editor; ?></div>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
