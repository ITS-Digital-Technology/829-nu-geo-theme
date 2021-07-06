<?php
$title    = isset( $title ) ? $title : get_sub_field( 'title' );
$link     = isset( $link ) ? $link : get_sub_field( 'link' );
$bg_image = isset( $bg_image ) ? $bg_image : get_sub_field( 'background_image' );
$bg_img   = wp_get_attachment_image( $bg_image, 'image-social' );
$images   = isset( $images ) ? $images : get_sub_field( 'square_images' );
$count    = 0;
?>
<section class="block-social-feed"<?php ContentBlock::the_block_id(); ?>>
	<div class="social-feed__wrapper">
		<?php
		foreach ( $images as $image ) :
			$img = wp_get_attachment_image( $image['image'], 'image-social' );
			$count++;
			$class_img = '';
			if ( $count === 1 ) {
				$class_img .= ' social-feed__image-info';
			}
		?>
			<figure class="social-feed__image<?php echo $class_img; ?>">
				<?php if ( $count === 1 ) : ?>
					<div class="social-feed__info">
						<span class="social-feed__instagram-icon"><span class="icon-social-instagram"></span></span>
						<span class="social-feed__info-title h3"><?php echo $title; ?></span>
						<?php echo wp_acf_link( $link, 'c-btn c-btn-secondary c-btn-color-normal' ); ?>
					</div>
				<?php endif; ?>
				<?php echo $img; ?>
            </figure>
		<?php endforeach; ?>
	</div>
</section>
