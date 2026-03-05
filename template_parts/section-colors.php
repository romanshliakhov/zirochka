<?php
$shower = get_sub_field('shower');
$editor = get_sub_field('editor');
$tabs   = get_sub_field('tabs');

if (!$shower && $tabs) : ?>
    <section class="section-colors" data-tabs-parent>
        <div class="decor-lines"></div>
        <div class="container">
            <div class="section-colors__wrapp">
                <div class="section-colors__top">
                    <div class="editor">
                        <?= $editor ?>
                    </div>

                    <ul class="tabs-nav">
                        <?php foreach ($tabs as $index => $tab) : ?>
                            <li class="tabs-nav__item">
                                <button class="tabs-nav__btn <?= $index === 0 ? 'active' : '' ?>" type="button"
                                        data-tab="<?= $index + 1 ?>">
                                    <span><?= esc_html($tab['tab_name']) ?></span>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <ul class="tabs-content">
                    <?php foreach ($tabs as $index => $tab) :
                        $colors_group = $tab['colors_group'] ?? [];
                    ?>
                        <li class="tabs-content__item <?= $index === 0 ? 'active' : '' ?>"
                            data-tab-content="<?= $index + 1 ?>">

                            <?php if (!empty($colors_group)) : ?>
                                <ul class="colors-group">
                                    <?php foreach ($colors_group as $group_item) :
                                        $group_title = $group_item['colors_group_title'] ?? '';
                                        $group_cols  = $group_item['colors_group_rows'] ?? 3;
                                        $colors_vars = $group_item['colors_vars'] ?? [];
                                    ?>
                                        <li class="colors-group__item">
                                            <?php if ($group_title) : ?>
                                                <span class="colors-group__heading"><?= esc_html($group_title); ?></span>
                                            <?php endif; ?>

                                            <?php if (!empty($colors_vars)) : ?>
                                                <ul class="colors-vars" style="--col-counter: <?= esc_attr($group_cols); ?>;">
                                                    <?php foreach ($colors_vars as $item) :
                                                        $color_label = $item['color_label'] ?? '';
                                                        $color_image = $item['color_image'] ?? '';
                                                        $color_title = $item['color_title'] ?? '';
                                                    ?>
                                                        <li class="colors-vars__item">
                                                            <div class="color">
                                                                <?php if ($color_label) : ?>
                                                                    <span class="color-label"><?= esc_html($color_label); ?></span>
                                                                <?php endif; ?>

                                                                <?php if ($color_image) : ?>
                                                                    <div class="color-image">
                                                                        <?= wp_get_attachment_image($color_image['ID'], 'full'); ?>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <?php if ($color_title) : ?>
                                                                    <span class="color-title"><?= esc_html($color_title); ?></span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>
