<?php
	$shower  = get_sub_field( 'shower' );
    $image   = get_sub_field('image');
	$editor  = get_sub_field( 'editor' );
	
	if ( ! $shower ) : ?>
        <section class="section-additional-wide" >
            <div class="container">
                <div class="section-additional-wide__wrapp">
                    <?= display_image($image, 460, 500, 'section-additional-wide__image') ?>

                    <?php if (!empty($editor)) : ?>
                        <div class="editor">
                            <?= $editor; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

	<?php endif; ?>