<?php
	function display_image( $image_array, $width, $height, $class = '', $loading = 'lazy' ): void {

		if ( isset( $image_array['url'] ) && !empty( $image_array['url'] ) ) {
			$image_url = esc_url( $image_array['url'] );
			$image_alt = isset( $image_array['alt'] ) ? esc_attr( $image_array['alt'] ) : '';

			$srcset = wp_get_attachment_image_srcset( $image_array['ID'] );

			$sizes = '(max-width: 576px) 100vw, (max-width: 768px) 80vw, (max-width: 1200px) 50vw, 800px';

			if ( !empty( $class ) ): ?>
                <div class="<?= esc_attr( $class ); ?>">
			<?php endif; ?>

            <img src="<?= $image_url; ?>"
                 width="<?= intval( $width ); ?>"
                 height="<?= intval( $height ); ?>"
                 alt="<?= $image_alt; ?>"
				<?= !empty( $srcset ) ? 'srcset="' . esc_attr( $srcset ) . '"' : ''; ?>
                 sizes="<?= esc_attr( $sizes ); ?>"
                 loading="<?= esc_attr( $loading ); ?>"
            />

			<?php
			if ( !empty( $class ) ): ?>
                </div>
			<?php endif;
		}
	}
?>
