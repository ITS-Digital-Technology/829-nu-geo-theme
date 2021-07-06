<?php
/**
 * Block with content slider
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

$block_class[] = 'block-gallery-slider';
$gallery_id    = get_sub_field( 'gallery' );
$section_title = get_sub_field( 'section_title' );
$gallery       = $gallery_id ? get_field( 'gallery_slides', $gallery_id ) : false;

if ( $gallery ) :
?>
<section class="<?php echo implode( ' ', $block_class ); ?>"<?php ContentBlock::the_block_id(); ?>>
	<?php if ( ! empty( $section_title ) ) : ?>
		<h2><?php echo $section_title; ?></h2>
	<?php endif; ?>
	<div class="block-gallery-slider__slider">
	<?php
	foreach ( $gallery as $slide ) :
		$slide_img     = wp_get_attachment_image( $slide['image'], 'slider-image-full' );
		$slide_caption = $slide['caption'];

		if ( $slide_img ) :
			?>
		<figure class="block-gallery-slider__slide">
			<?php echo $slide_img; ?>

			<?php if ( $slide_caption ) : ?>
			<figcaption class="block-gallery-slider__slide-caption">
				<?php echo $slide_caption; ?>
			</figcaption>
		<?php endif; ?>
		</figure>
			<?php
		endif;
	endforeach;
	?>
	</div>
</section>
	<?php
endif;
