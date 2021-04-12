<?php
function wpb_modify_search_query( $query ) {
	global $wp_the_query;
	if ( $query === $wp_the_query && $query->is_search() ) {
		$meta_query = $query->get( 'meta_query' ) ? : [];

		$meta_query = array(
			'relation' => 'OR',
			[
				'key'     => 'hide_from_search',
				'compare' => 'NOT EXISTS',
			],
			[
				'key'     => 'hide_from_search',
				'value'   => '1',
				'compare' => '!=',
			],
		);

		$query->set( 'meta_query', $meta_query );
	}
}
add_action( 'pre_get_posts', 'wpb_modify_search_query' );
