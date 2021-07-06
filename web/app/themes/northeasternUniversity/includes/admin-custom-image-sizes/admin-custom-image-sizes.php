<?php
/**
 * Display all registered image sizes in WP Admin panel
 *
 * @package WordPress
 * @subpackage Camp Rockmont
 * @since Camp Rockmont 1.0
 */

function filter_sizes($string) {
	$disallowed_sizes = array('main-logo');

	foreach($disallowed_sizes as $disallowed_size) {
		if(stripos($string, $disallowed_size) !== false) {
			return false;
		}
	}
	return true;
}

function admin_custom_image_sizes( $sizes ) {
	$all_sizes = array();
	$custom_sizes = get_intermediate_image_sizes();
	$custom_sizes = array_filter($custom_sizes, 'filter_sizes');

	foreach( $custom_sizes as $key => $value) {
		$all_sizes[$value] = $value;
	}
	$all_sizes = array_merge( $all_sizes, $sizes );

	return $all_sizes;
}
add_filter('image_size_names_choose', 'admin_custom_image_sizes', 11, 1);
