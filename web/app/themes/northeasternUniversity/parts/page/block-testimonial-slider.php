<?php

$background_shape = get_sub_field( 'background_shape' );
$testimonials     = get_sub_field( 'testimonials' );
$count_slides     = count($testimonials);
$block_class[] = 'block-testimonial-slider';
if ( $background_shape ) {
	$block_class[] = 'block-testimonial-slider--shape';
}

if($count_slides <= 1){
$block_class[] = 'block-testimonial-slider--single';
}

if ( ! empty( $testimonials ) ) :
	?>

<section class="<?php echo implode( ' ', $block_class ); ?>"<?php ContentBlock::the_block_id(); ?>>
	<div class="container">
		<div class="testimonial-slider">
		<?php
		foreach ( $testimonials as $testimonial ) :
			$quote        = $testimonial['quote'];
			$author       = $testimonial['author'];
			$author_image = $testimonial['author_image'];
			$author_image = wp_get_attachment_image( $author_image, 'testimonial-img' );
			$program      = $testimonial['program'];
			?>
			<div class="testimonial-slide">
				<blockquote class="testimonial-quote">
					<?php if ( ! empty( $quote ) ) : ?>
					<!--<p role="alert" aria-live="Polite">-->
					<p><?php echo $quote; ?></p>
					<?php endif; ?>
					<figure class="testimonial-thumb"><?php echo $author_image; ?></figure>
					<footer class="testimonial-footer">
						<p><?php echo $author; ?></p>
						<?php
						if ( ! empty( $program ) ) :
							$link_url    = $program['url'];
							$link_title  = $program['title'];
							$link_target = $program['target'] ? $program['target'] : '_self';
							?>
							<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php endif; ?>
					</footer>
				</blockquote>
			</div>
			<?php
		endforeach;
		?>
		</div>
	</div>
</section>
	<?php
endif;
