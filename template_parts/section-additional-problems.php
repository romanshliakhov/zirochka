<?php
	$shower  = get_sub_field( 'shower' );
	$editor  = get_sub_field( 'editor' );
	$list  = get_sub_field( 'list' );
	
	if ( ! $shower ) : ?>
        <section class="section-additional-problems" >
            <div class="container">
                <div class="section-additional-problems__wrapp">
                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($list) : ?>
                        <ul class="problems-list">
                            <?php foreach ($list as $item) :
                                $image   = $item['image'];
                                $title   = $item['title'];
                                $text    = $item['descr'];
                            ?>
                                <li class="problems-list__item">
                                    <?= display_image($image, 446, 212, 'problems-list__item-image') ?>

                                    <?php if ($title) : ?>
                                        <span class="problems-list__item-_title"><?= esc_html($title); ?></span>
                                    <?php endif; ?>

                                    <?php if ($text) : ?>
                                        <p class="problems-list__item-text"><?= esc_html($text); ?></p>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>

	<?php endif; ?>