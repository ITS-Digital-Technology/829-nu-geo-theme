<?php
function video_wrapper( $cached_html, $url, $oembed, $thumbnail ) {
    $class = 'iframe-wrapper';
    if ( $oembed ) {
        $cached_html = $url;
        $matches_url;
        preg_match('/src="(.+?)"/', $url, $matches_url);
        $url = $matches_url[1];
    }

    $id = substr( $url, strrpos( $url, '/' ) + 1 );

    if ( strstr($id, '?', true) ) {
        $id = strstr($id, '?', true);
    }

    [$class_to_add, $img_src, $title] = get_video_thumbnail_data($url);

    $class .= $class_to_add;

	// Move iframe src to data-src attribute to avoid loading iframe when page is loading
	$cached_html = preg_replace('/src=\"/','loading="lazy" data-src="',$cached_html);

	// Add title to iframe
    $cached_html = preg_replace('/<iframe/','<iframe title="'.$title.'"',$cached_html);

    if ( $thumbnail ) {
        $img_src = $thumbnail;
    }

	return "<div class='$class' data-video-id='$id' data-image-src='$img_src'>
                <div class='iframe-wrapper__overlay' style='background-image: url($img_src);'>
                    <button class='iframe-wrapper__play' aria-label='Play Video'></button>
                </div>
                $cached_html
            </div>";
}


function get_video_thumbnail_data($url, $oembed = false) {
    if ( $oembed ) {
        $cached_html = $url;
        $matches_url;
        preg_match('/src="(.+?)"/', $url, $matches_url);
        $url = $matches_url[1];
    }

    if ( strpos( $url, 'wistia' ) !== false ) {
		$class = ' wistia';
		$data = json_decode( file_get_contents( "https://fast.wistia.com/oembed?url=$url" ) );
        $img_src = $data->thumbnail_url;
		$title = __('wistia video','buffaloOutdoorCenter');
	} elseif ( strpos( $url, 'vimeo' ) !== false ) {
        $class = ' vimeo';
		$data = json_decode( file_get_contents( "https://vimeo.com/api/oembed.json?url=$url" ) );
		$img_src = preg_replace( '/_[\s\S]+?\./', '.', $data->thumbnail_url );
		$title = __('vimeo video','buffaloOutdoorCenter');
	} else {
        $class = ' youtube';
        $matches = [];
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
        $id = $matches[1];
        $title = __('youtube video','buffaloOutdoorCenter');

        $url = 'https://img.youtube.com/vi/' . $id . '/';
		$url_max = $url . 'maxresdefault.jpg';
        $url_sd = $url . 'sddefault.jpg';
        $url = $url . '0.jpg';

        if (is_url_200($url_max)) {
            $img_src = $url_max;
        } elseif (is_url_200($url_sd)) {
            $img_src = $url_sd;
        } else {
            $img_src = $url;
        }
    }

    return [$class, $img_src, $title];
}