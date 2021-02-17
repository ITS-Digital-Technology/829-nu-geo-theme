<?php
/**
 * Adds embed responsive wrapper
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

add_filter( 'embed_oembed_html', 'oembed_video_wrapper', 99, 4 );

function oembed_video_wrapper( $cached_html, $url ) {
    return video_wrapper( $cached_html, $url, false, false );
}