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
	// $icon  = get_svg( 'triangle-play' );
	$id    = substr( $url, strrpos( $url, '/' ) + 1 );

	if ( strpos( $url, 'wistia' ) !== false ) {
		$class  .= ' wistia';
		$data    = json_decode( file_get_contents( "https://fast.wistia.com/oembed?url=$url" ) );
		$img_src = $data->thumbnail_url;
		$title = __('wistia video','defaultTheme');
	} elseif ( strpos( $url, 'vimeo' ) !== false ) {
		$class  .= ' vimeo';
		$data    = json_decode( file_get_contents( "https://vimeo.com/api/oembed.json?url=$url" ) );
		$img_src = preg_replace( '/_[\s\S]+?\./', '.', $data->thumbnail_url );
		$title = __('vimeo video','defaultTheme');
	} else {
        $class  .= ' youtube';
        $matches;
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
        $id = $matches[1];
        $url_base = 'https://img.youtube.com/vi/' . $id . '/';
        $url_max = $url_base . 'maxresdefault.jpg';
        $url_sd = $url_base . 'sddefault.jpg';
        $url = $url_base . '0.jpg';
        $title = __('youtube video','defaultTheme');

        if (is_url_200($url_max)) {
            $img_src = $url_max;
        } elseif (is_url_200($url_sd)) {
            $img_src = $url_sd;
        } else {
            $img_src = $url;
        }
	}

	// Move iframe src to data-src attribute to avoid loading iframe when page is loading
	$cached_html = preg_replace('/src=\"/','loading="lazy" data-src="',$cached_html);

	// Add title to iframe
	$cached_html = preg_replace('/<iframe/','<iframe title="'.$title.'"',$cached_html);

	return "<div class='$class' data-video-id='$id' data-image-src='$img_src'>
                <div class='iframe-wrapper__overlay' style='background-image: url($img_src);'>
                    <button class='iframe-wrapper__play' aria-label='Play Video'></button>
                </div>
                $cached_html
            </div>";
}
