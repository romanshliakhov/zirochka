<?php
	$shower  = get_sub_field( 'shower' );
	$image   = get_sub_field( 'image' );
	$editor  = get_sub_field( 'editor' );
	$link    = get_sub_field( 'link' );

	if ( ! $shower ) : ?>
        <section class="section-cta">
			<?php if (!empty($image)) : ?>
				<div class="section-cta__image">
					<?= wp_get_attachment_image($image['ID'], 'full'); ?>
				</div>
			<?php endif; ?>

            <div class="container">
                <div class="section-cta__wrapp">
					<?php if (!empty($editor)) : ?>
						<div class="section-cta__editor editor">
							<?= $editor; ?>
						</div>
					<?php endif; ?>

					<?php if ( $link ) :
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<a class="button button--animated" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
							<?php echo esc_html( $link_title ); ?>
						</a>
					<?php endif; ?>
                </div>
            </div>
        </section>
	<?php endif; ?>
