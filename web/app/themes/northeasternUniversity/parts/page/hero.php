<?php
/**
 * Main Hero section for page
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity  1.0
 */

$banner_bool = get_field( 'hide_main_banner' );

if ( ! $banner_bool ) :
	$vertical_align   = get_field( 'featured_image_vertical' );
	$horizontal_align = get_field( 'featured_image_horizontal' );
	$select           = get_field( 'select_hero' );
	$thumbnail_ID     = get_post_thumbnail_id();
	$thumbnail_align  = 'center center';
	if ( ! empty( $vertical_align ) && ! empty( $horizontal_align ) ) {
		$thumbnail_align = $vertical_align . ' ' . $horizontal_align;
	}
	$thumbnail = wp_get_attachment_image(
		$thumbnail_ID,
		'full',
		false,
		[
			'style' => 'object-position: ' . $thumbnail_align,
		]
	);

	if ( ! empty( $thumbnail_ID ) ) {
		$block_class[] = 'page-hero--thumbnail';
	}

	if ( $select === 'home' ) :
		$title    = get_field( 'hero_page_title' ) ? get_field( 'hero_page_title' ) : '';
		$bg_video = get_field( 'hero_background_video' ) ? get_field( 'hero_background_video' ) : '';
		get_theme_part(
			'page/hero-home',
			[
				'title'       => $title,
				'thumbnail'   => $thumbnail,
				'block_class' => $block_class,
				'bg_video'    => $bg_video,
			]
		);
	else :
		$title         = get_field( 'hero_page_title' ) ? : get_the_title();
		$block_class[] = 'page-hero';

		?>
		<a class="skip-main" href="#contentstart">Skip to main content</a>
<section class="<?php echo implode( ' ', $block_class ); ?>">
	<div class="page-hero-wrapper">
		<?php if ( ! empty( $title ) ) : ?>
		<div class="container">
			<div class="row page-hero__row">
				<div class="col-12">
					<div class="page-hero__content">
						<h1><?php echo $title; ?></h1>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
		<?php if ( ! empty( $thumbnail ) ) : ?>
		<figure class="page-hero__thumbnail"><?php echo $thumbnail; ?></figure>
	<?php endif; ?>
	</div>
</section>
<div id="contentstart" tabindex="0"></div>
		<?php
	endif;
endif;
