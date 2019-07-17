<?php

/**
 * Retrieve part of the template.
 * Uses template engine build into theme to grab the file (relative to "parts" directory),
 * and pass variables to this files local scope.
 *
 * @param string $part
 * @param array  $data
 * @param string $folder
 */
function get_theme_part( $part, $data = array(), $folder = 'parts' ) {
	$engine = Theme_Template_Engine::create( $folder );
	$engine->render( $part, $data );
}

/**
 * Begin generating a theme part layout.
 *
 * @param string $layout
 * @param array  $data
 * @param string $folder
 */
function start_layout( $layout, $data = [], $folder = 'parts' ) {
	$engine = Theme_Template_Engine::create( $folder );
	$engine->start_layout( $layout, $data );
}

/**
 * Begin outputting to the next layout part.
 *
 * @param string $folder
 */
function next_layout_part( $folder = 'parts' ) {
	$engine = Theme_Template_Engine::create( $folder );
	$engine->next_layout_part();
}

/**
 * Finalize (print) generated layout.
 *
 * @param string $folder
 */
function close_layout( $folder = 'parts' ) {
	$engine = Theme_Template_Engine::create( $folder );
	$engine->close_layout();
}
