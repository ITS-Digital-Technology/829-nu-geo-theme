<?php
/**
 * Adds embed responsive wrapper
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

add_filter( 'embed_oembed_html', 'oembed_video_wrapper', 99, 4 );

function oembed_video_wrapper( $cached_html, $url ) {
	$class = 'iframe-wrapper';
	// $icon  = get_svg( 'video-play' );
	$id    = substr( $url, strrpos( $url, '/' ) + 1 );

	if ( strpos( $url, 'wistia' ) !== false ) {
		$class  .= ' wistia';
		$data    = json_decode( file_get_contents( "https://fast.wistia.com/oembed?url=$url" ) );
		$img_src = $data->thumbnail_url;
	} elseif ( strpos( $url, 'vimeo' ) !== false ) {
		$class  .= ' vimeo';
		$data    = json_decode( file_get_contents( "https://vimeo.com/api/v2/video/$id.json" ) );
		$img_src = $data[0]->thumbnail_large;
	} else {
		$class  .= ' youtube';
		$img_src = "https://img.youtube.com/vi/$id/0.jpg";
	}

	// Move iframe src to data-src attribute to avoid loading iframe when page is loading
	$cached_html = preg_replace('/src=\"/','loading="lazy" data-src="',$cached_html);

	return "<div class='$class' data-video-id='$id' data-image-src='$img_src'>
                <div class='iframe-wrapper__overlay' style='background-image: url($img_src);'>
                    <button aria-label='".__('play video','themeName')."' class='iframe-wrapper__play'></button>
                </div>
                $cached_html
            </div>";
}