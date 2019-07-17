<?php
/**
 * Add custom WYSIWYG editor buttons for admin panel
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

add_action( 'init', 'editor_buttons' );
function editor_buttons() {
	add_filter( "mce_external_plugins", "editor_add_buttons" );
	add_filter( 'mce_buttons', 'editor_register_buttons' );
}
function editor_add_buttons( $plugin_array ) {
	$plugin_array['default_theme'] = get_template_directory_uri() . '/includes/editor-buttons/editor-buttons-plugin.js';
	return $plugin_array;
}
function editor_register_buttons( $buttons ) {
	array_push( $buttons, 'images', 'elements', 'columns' );
	return $buttons;
}

add_action('wp_ajax_get_custom_posts_list', 'get_custom_posts_list');
add_action('wp_ajax_nopriv_get_custom_posts_list', 'get_custom_posts_list');

function get_custom_posts_list() {
	$args = array(
		'post_type' => $_POST['post_type']
	);
	$posts = get_posts($args);
	$posts_list = array();

	foreach($posts as $post) {
		$posts_list[] = array(
			'text' => $post->post_title,
			'value' => $post->ID
		);
	}
	wp_send_json($posts_list);
}
