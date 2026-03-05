<?php
	$shower  = get_sub_field( 'shower' );
	$editor  = get_sub_field( 'editor' );
	$list  = get_sub_field( 'list' );
	
	if ( ! $shower ) : ?>
        <section class="section-additional-list" >
            <div class="container">
                <div class="section-additional-list__wrapp">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($list) : ?>
                        <ul class="additional-list">
                            <?php foreach ($list as $item) :
                                $row_direction = $item['row_direction'];
                                $item_image    = $item['item_image'];
                                $item_editor   = $item['editor'];
                            ?>
                                <li class="additional-list__item <?= $row_direction ? 'row-reverse' : ''; ?>">
                                    <?php if (!empty($item_editor)) : ?>
                                        <div class="additional-list__item-editor editor">
                                            <?= $item_editor; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?= display_image($item_image, 446, 212, 'additional-list__item-image') ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>

	<?php endif; ?>