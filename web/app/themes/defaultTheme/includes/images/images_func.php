<?php
//======================================================================
//   Usable function - f_img(string|int $attachment, string|array $size = 'full-size', bool $html = true);
//
//   RETURN: <img>, <svg> or src in string or array;
//
//   $attachment (string|int) (required) - WP image ID or static path to file;
//   $size (string|array) (optional - default - 'full-size') - WP thumbnail size - usable only with image ID and NOT SVG files;
//   $html (bool) (optional - default = true) - IF set to false, function return STRING with path to file
//   Supports Retina with Retina 2x Wordpress plugin (IF RETINA 2x PLUGIN IS ACTIVE, AND $html SET TO FALSE - RETURN ARRAY (if current image doesn't exist in retina size, return default size for [0] and [1]));
//======================================================================

// Helper Func
function vector_image_path($attachment_id) {
    $file = get_attached_file($attachment_id, true);
    if ( !wp_attachment_is_image($attachment_id) ) {
        return false;
    }
    return realpath($file);
}
// Usable Func
function f_img ( $attachment_id, $size = 'full-size', $html = true ) {
    if ( is_int ( $attachment_id ) ) {
        $src = wp_get_attachment_image_src( $attachment_id, $size );
        if ( $html !== true ) {
            if ( function_exists('wr2x_get_retina_from_url') ) {
                $img[] = $src[0];
                $img2x = wr2x_get_retina_from_url( $src[0] );
                if ( !empty($img2x) ){
                    $img[] = $img2x;
                } else {
                    $img[] = $src[0];
                }

            } else {
                $img = $src[0];
            }
        } else {
            $ext = pathinfo($src[0], PATHINFO_EXTENSION);
            if ( $ext == 'svg' ) {
                $img = vector_image_path( $attachment_id);
                if ( $img !== false ) {
                    $img_svg = file_get_contents( $img );
                    preg_match('/<svg[\s\S]*\/svg>/m', $img_svg, $matches);

                    if ( isset($matches[0]) ) {
                        $img = $matches[0];
                    } else {
                        $img = $img_svg;
                    }
                }
            } else {
                $img = wp_get_attachment_image( $attachment_id, $size );
            }
        }
        if ( $img === false ) {
            $img = '';
        }
    } else {
        $src = get_template_directory() . $attachment_id;
        $ext = pathinfo($src, PATHINFO_EXTENSION);
        if ( $html !== true ) {
            $img = $src;
        } else {
            if ( $ext == 'svg' ) {
                $img_svg = file_get_contents( $src );
                preg_match('/<svg[\s\S]*\/svg>/m', $img_svg, $matches);
                if ( isset($matches[0]) ) {
                    $img = $matches[0];
                } else {
                    $img = $img_svg;
                }
            } else {
                $img = $src;
            }
        }
    }
    return $img;
}