<?php
/**
 * Block with gallery lightbox
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

$block_class[] = 'block-gallery-lightbox';
$text_content  = get_sub_field( 'section_title' );
$gallery_id    = get_sub_field( 'gallery' );
$gallery       = $gallery_id ? get_field( 'gallery_slides', $gallery_id ) : false;

if ( $gallery ) :
	foreach ( $gallery as $slide ) {
		if ( $slide['caption'] ) {
			$block_class[] = 'block-gallery-lightbox--has-captions';
			break;
		}
	}
?>

<section class="<?php echo implode( ' ', $block_class ); ?>"<?php ContentBlock::the_block_id(); ?>>
	<div class="container">
	<?php if ( $text_content ) : ?>
		<div class="block-gallery-lightbox__text-content">
			<?php echo $text_content; ?>
		</div>
	<?php endif; ?>

		<div class="block-gallery-lightbox__thumbnails-wrapper">
			<div class="row">
			<?php foreach ( $gallery as $key => $item ) : ?>
				<div class="col-6 col-xl-4 block-gallery-lightbox__thumb-col">
                    <a href="<?php echo "#$key"; ?>" class="block-gallery-lightbox__single-thumb" aria-label="<?php _e( 'Gallery Thumbnail', 'nationsClassroom' ); ?>"><?php echo wp_get_attachment_image( $gallery[ $key ]['image'], 'thumbnail-content-image', false, 'data-object-fit' ); ?>
                    </a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="block-gallery-lightbox__gallery-wrapper" role="dialog" aria-model="true" aria-label="Photo Gallery Lightbox">
		<button class="block-gallery-lightbox__close" tabindex="0" aria-label="<?php _e( 'Close Lightbox', 'nationsClassroom' ); ?>">
			<span class="icon-close"></span>
		</button>
		<div class="block-gallery-lightbox__slider">
		<?php
		foreach ( $gallery as $key => $item ) :
			$img     = wp_get_attachment_image( $gallery[ $key ]['image'], 'slider-image-full' );
			$caption = $gallery[ $key ]['caption'];

			if ( $img ) :
		?>
			<figure class="block-gallery-lightbox__slide">
				<?php echo $img; ?>
				<?php if ( $caption ) : ?>
				<figcaption class="block-gallery-lightbox__slide-caption"><?php echo $caption; ?></figcaption>
			    <?php endif; ?>
			</figure>
		<?php
			endif;
		endforeach;
		?>
		</div>
	</div>
</section>
<?php
endif;
