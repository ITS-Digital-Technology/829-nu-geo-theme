<?php
/**
 * Returns the primary term for the chosen taxonomy set by Yoast SEO
 * or the first term selected.
 *
 * @param integer $post The post id.
 * @param string  $taxonomy The taxonomy to query. Defaults to category.
 * @return array  Array with keys of 'title', and 'url'.
 */
function get_primary_taxonomy_term( $post = null, $taxonomy = 'category' ) {
	if ( ! $post ) {
		$post = get_the_ID();
	}

	$terms        = get_the_terms( $post, $taxonomy );
	$primary_term = array();

	if ( $terms ) {
		$term_display = '';
		$term_link    = '';

		if ( class_exists( 'WPSEO_Primary_Term' ) ) {
			$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term               = get_term( $wpseo_primary_term );

			if ( is_wp_error( $term ) ) {
				$term_display = $terms[0]->name;
				$term_link    = get_term_link( $terms[0]->term_id );
			} else {
				$term_display = $term->name;
				$term_link    = get_term_link( $term->term_id );
			}

		} else {
			$term_display = $terms[0]->name;
			$term_link    = get_term_link( $terms[0]->term_id );
		}

		$primary_term['url']   = $term_link;
		$primary_term['title'] = $term_display;
	}

	return $primary_term;
}