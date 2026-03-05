<?php
	function display_post_content( int $post_id, $class = '' ): void {
		$post = get_post( $post_id );

		if ( $post && ! empty( trim( $post->post_content ) ) ) :
			remove_filter( 'the_content', 'wpautop' );
			?>
            <div class="<?= $class;?>">
				<?= apply_filters( 'the_content', $post->post_content ); ?>
            </div>
			<?php
			add_filter( 'the_content', 'wpautop' );
		endif;
	}
?>
