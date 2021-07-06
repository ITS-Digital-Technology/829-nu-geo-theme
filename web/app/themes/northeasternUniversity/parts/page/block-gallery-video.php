<?php
/**
 * Block with video gallery
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

$block_class[] = 'block-gallery-video';
$text_content  = get_sub_field( 'section_title' );
$gallery       = get_sub_field( 'gallery' );

if ( $gallery ) :
?>
<section class="<?php echo implode( ' ', $block_class ); ?>"<?php ContentBlock::the_block_id(); ?>>
	<div class="container">
    <?php if ( $text_content ) : ?>
        <div class="block-gallery-video__text-content">
            <?php echo $text_content; ?>
        </div>
    <?php endif; ?>

	    <div class="block-gallery-video__thumbnails-wrapper">
			<div class="row">
            <?php
            while ( have_rows( 'gallery' ) ) :
                the_row();

                $video_url = get_sub_field( 'video', false, false );
                $video     = get_sub_field( 'video' );
                $title     = get_sub_field( 'title' );
                $column    = get_sub_field( 'column' );

                preg_match( '/src="(.+?)"/', $video, $matches );
                $video_src = $matches[1];

                if ( strpos( $video_url, 'wistia' ) !== false ) {
                    $data     = json_decode( file_get_contents( "https://fast.wistia.com/oembed?url=$video_url" ) );
                    $img_src  = $data->thumbnail_url;
                } elseif ( strpos( $video_url, 'vimeo' ) !== false ) {
                    $data     = json_decode( file_get_contents( "https://vimeo.com/api/oembed.json?url=$video_url" ) );
                    $img_src  = preg_replace( '/_[\s\S]+?\./', '.', $data->thumbnail_url );
                } else {
                    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $video_url, $matches);
                    $img_src  = 'https://img.youtube.com/vi/' . $matches[1] . '/0.jpg';
                }
            ?>
				<div class="col-6 col-xl-<?php echo $column;?> block-gallery-video__thumb-col">
                    <button data-video="<?php echo $video_src; ?>" class="block-gallery-video__single-thumb js-play-lightbox-video" aria-label="<?php echo $title; ?>">
                        <figure class="block-gallery-video__single-thumb-wrapper">
                        <img src="<?php echo $img_src; ?>" alt="Video Thumbnail.">
                        <span class="block-gallery-video__single-thumb-button"></span>
                        </figure>
                    <?php if ( $title ) : ?>
                        <span class="heading block-gallery-video__single-thumb-title"><?php echo $title; ?></span>
                    <?php endif; ?>
                    </button>
                </div>
            <?php
            endwhile;
            ?>
		</div>
    </div>
    <?php get_theme_part( 'elements/video-lightbox' ); ?>
</section>
<?php
endif;
