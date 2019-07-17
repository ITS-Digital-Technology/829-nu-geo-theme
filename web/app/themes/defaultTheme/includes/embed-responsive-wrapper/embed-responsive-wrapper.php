<?php
/**
 * Adds embed responsive wrapper
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

add_filter('embed_oembed_html','oembed_youtube_add_wrapper');
function oembed_youtube_add_wrapper($html) {
    return '<div class="iframe-wrapper">'.$html.'</div>';
}
