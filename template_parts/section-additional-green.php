<?php
	$shower  = get_sub_field( 'shower' );
	$editor  = get_sub_field( 'editor' );
	$list  = get_sub_field( 'list' );
	
	if ( ! $shower ) : ?>
        <section class="section-additional-green" >
            <div class="container">
                <div class="section-additional-green__wrapp">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($list) : ?>
                        <ul class="additional-green">
                            <?php foreach ($list as $item) :
                                $item_image    = $item['item_image'];
                                $item_editor   = $item['editor'];
                            ?>
                                <li class="additional-green__item">
                                    <?= display_image($item_image, 446, 212, 'additional-green__item-image') ?>

                                    <?php if (!empty($item_editor)) : ?>
                                        <div class="additional-green__item-editor editor">
                                            <?= $item_editor; ?>
                                        </div>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>

	<?php endif; ?>