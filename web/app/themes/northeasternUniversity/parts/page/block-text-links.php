<?php
/**
 * Block for text links
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

$block_class[]  = 'block-text-links';
$block_size     = ContentBlock::get_block_size_class();
$disable_margin = get_sub_field( 'disable_margin' );

$links         = isset( $links ) ? $links : get_sub_field( 'content_links' );
$section_title = isset( $section_title ) ? $section_title : get_sub_field( 'section_title' );
$center_links  = isset( $center_links ) ? $center_links : get_sub_field( 'center_links' );
$button        = isset( $button ) ? $button : get_sub_field( 'text_link_button' );
$shape         = isset( $shape ) ? $shape : get_sub_field( 'background_shape' );

if ( $disable_margin ) {
	$block_class[] = 'block-text-links--disable-margin';
}

if ( $shape ) {
	$block_class[] = 'block-text-links--bg-shape';
}

if ( $links ) :
	?>
<section class="<?php echo implode( ' ', $block_class ); ?>"<?php ContentBlock::the_block_id(); ?>>
	<?php if ( ! empty( $shape ) ) : ?>
	<div class="block-text-links-wrapper">
	<?php endif; ?>
	<div class="container">
		<div class="row">
			<div class="<?php echo $block_size; ?>">
			<?php if ( ! empty( $button ) ) : ?>
				<div class="block-text-links__top">
			<?php endif; ?>
				<?php if ( $section_title ) : ?>
					<?php echo $section_title; ?>
				<?php endif; ?>
				<?php
				if ( ! empty( $button ) ) :
					$link_url    = $button['url'];
					$link_title  = $button['title'];
					$link_target = $button['target'] ? $button['target'] : '_self';
					?>
					<a class="c-btn c-btn-tertiary c-btn-color-normal" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
						<span><?php echo esc_html( $link_title ); ?></span>
						<span class="c-btn-icon"><span class="icon-arrow-right-circle"></span></span>
					</a>
				</div>
				<?php endif; ?>
				<div class="row block-text-links__row<?php echo $center_links ? ' justify-content-center' : ''; ?>">
				<?php
				foreach ( $links as $item ) :
					$link  = $item['link'];
					$width = $item['width'];
					$class = 'block-text-links__col';

					switch ( $width ) {
						case '12':
							$class .= ' col-12';
							break;
						case '8':
							$class .= ' col-12 col-sm-6 col-lg-8';
							break;
						case '6':
							$class .= ' col-12 col-sm-6';
							break;
						case '3':
							$class .= ' col-12 col-sm-6 col-lg-3';
							break;
						case '2':
							$class .= ' col-12 col-sm-6 col-lg-2';
							break;
						default:
							$class .= ' col-12 col-sm-6 col-lg-4';
					}

					if ( $link ) :
						$link_title  = $link['title'];
						$link_url    = $link['url'];
						$link_target = $link['target'] ? 'target="_blank" rel="noopener"' : 'target="_self"';
						?>
					<div class="<?php echo $class; ?>">
						<a class="text-link" href="<?php echo esc_url( $link_url ); ?>" <?php echo $link_target; ?>>

						<?php
						if ( ! empty( $link_title ) ) {
							get_theme_part(
								'elements/content-link',
								[
									'link_title'  => $link_title,
									'link_target' => $link['target'],
								]
							);
						}
						?>
						</a>
					</div>
						<?php
					endif;
				endforeach;
				?>
				</div>
			</div>
		</div>
	</div>
	<?php if ( ! empty( $shape ) ) : ?>
	</div>
	<?php endif; ?>
</section>
	<?php
endif;
