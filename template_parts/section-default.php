<?php
	$shower  = get_sub_field( 'shower' );
    $image   = get_sub_field('image');
	$editor  = get_sub_field( 'editor' );
	
	if ( ! $shower ) : ?>

        <section class="section-default" >
            <div class="container">
                <div class="section-default__wrapp">
                    <?= display_image($image, 460, 500, 'section-default__bg') ?>

                    <div class="section-default__box">
                        <div class="editor">
                            <?=$editor?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

	<?php endif; ?>