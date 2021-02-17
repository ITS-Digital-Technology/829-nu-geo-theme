<?php
function loadScripts() {
	$scriptFile =
	    get_template_directory_uri() .
	    (is_IE() ? '/js/bundle.ie.js' : '/js/bundle.js');

	wp_enqueue_script('script', $scriptFile, [], false, true);
}

add_action('wp_enqueue_scripts', 'loadScripts');