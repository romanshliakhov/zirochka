<?php
	function display_gallery( $gallery, $width, $height, $post_ID ): void {

		if ( $gallery ) :

			$total = count( $gallery );
			$initial = 5;
			$first_batch = array_slice( $gallery, 0, $initial );
			?>

            <div class="main-gallery">
                <div class="gallery-list swiper-wrapper">
					<?php foreach ( $first_batch as $image ) : ?>
                        <div class="swiper-slide">
                            <a data-fancybox="gallery-<?=$post_ID; ?>" href="<?= esc_url( $image['url'] ); ?>">
								<?= display_image( $image, $width, $height ) ?>
                            </a>
                        </div>
					<?php endforeach; ?>
                </div>
            </div>

			<?php if ( $total > $initial ) : ?>
            <button class="main-link"
                    data-gallery-more="<?= $post_ID ?>"
                    data-total="<?= $total ?>"
                    data-offset="<?= $initial - 1 ?>">

				<?= __( 'Показати ще', 'textdomain' ); ?>
            </button>
		<?php endif;

		endif;
	}
?>
