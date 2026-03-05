<?php
	function custom_pagination() {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) {
			$big = 999999999;

			$pages = paginate_links( array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => max( 1, get_query_var( 'paged' ) ),
				'total'     => $wp_query->max_num_pages,
				'type'      => 'array',
				'prev_text' => '<i class="fa-solid fa-arrow-left-long"></i>',
				'next_text' => '<i class="fa-solid fa-arrow-right-long"></i>',
				'end_size'  => 1,
				'mid_size'  => 1,
			) );

			if ( is_array( $pages ) ) {
				$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );

				echo '<div class="post-pagination">';
				echo '<ul class="pagination">';

				foreach ( $pages as $page ) {
					if ( strpos( $page, 'current' ) !== false ) {
						echo '<li class="active">' . $page . '</li>';
					} else {
						echo '<li>' . $page . '</li>';
					}
				}

				echo '</ul>';
				echo '</div>';
			}
		}
	}

?>