<?php
$left_content = isset( $left_content ) ? $left_content : get_sub_field( 'left_content' );
$image        = isset( $image ) ? $image : get_sub_field( 'image' );
$img          = wp_get_attachment_image( $image, 'overview-image' );
$video        = isset( $video ) ? $video : get_sub_field( 'video' );
$video_url    = get_sub_field( 'video', false, false );
$video        = get_sub_field( 'video' );
if(!empty($video)) {
preg_match( '/src="(.+?)"/', $video, $matches );
$video_src = $matches[1];

if ( strpos( $video_url, 'wistia' ) !== false ) {
	$data    = json_decode( file_get_contents( "https://fast.wistia.com/oembed?url=$video_url" ) );
	$img_src = $data->thumbnail_url;
} elseif ( strpos( $video_url, 'vimeo' ) !== false ) {
	$data    = json_decode( file_get_contents( "https://vimeo.com/api/oembed.json?url=$video_url" ) );
	$img_src = preg_replace( '/_[\s\S]+?\./', '.', $data->thumbnail_url );
} else {
	preg_match( "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $video_url, $matches );
	$img_src = 'https://img.youtube.com/vi/' . $matches[1] . '/0.jpg';
}
}
?>

<section class="block-overview"<?php ContentBlock::the_block_id(); ?>>
	<div class="container">
		<div class="row">
		<?php if ( ! empty( $left_content ) ) : ?>
			<div class="col-12 col-lg-7">
				<div class="block-overview__left">
					<?php echo $left_content; ?>
				</div>
			</div>
		<?php endif; ?>
        <?php if ( !empty( $video ) || ! empty( $image ) ) : ?>
			<div class="col-12 col-lg-4 offset-lg-1">
				<div class="block-overview__right">
				<?php if ( empty( $video ) && ! empty( $image ) ) : ?>
					<figure class="block-overview__image"><?php echo $img; ?></figure>
				<?php else : ?>
					<a href="#" data-video="<?php echo $video_src; ?>" class="block-overview__video js-play-lightbox-video" aria-label="<?php _e( 'Play Video', 'northeasternUniversity' ); ?>">
						<figure class="block-overview__image block-overview__image--video">
							<img src="<?php echo $img_src; ?>" alt="Video Thumbnail">
							<button class="block-overview__video-button" aria-label='Play Video'></button>
						</figure>
					</a>
				<?php endif; ?>
				</div>
			</div>
        <?php endif;?>
		</div>
	</div>
	<?php if ( ! empty( $video ) ) : ?>
		<?php get_theme_part( 'elements/video-lightbox' ); ?>
	<?php endif; ?>
</section>
