<?php
/**
 * Home Hero section for page
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity  1.0
 */


$title         = isset( $title ) ? $title : '';
$thumbnail     = isset( $thumbnail ) ? $thumbnail : false;
$block_class   = isset( $block_class ) ? $block_class : false;
$block_class[] = 'page-hero-home';
$gradient      = get_field( 'hero_display_gradient' );
$bg_video      = isset( $bg_video ) ? $bg_video : false;

if ( $gradient ) {
	$block_class[] = 'page-hero--gradient';
}
if ( $title ) {
	$block_class[] = 'page-hero--text';
}
if ( $bg_video ) {
	$block_class[] = 'page-hero--video';
}

?>
<a class="skip-main" href="#contentstart">Skip to main content</a>
<section class="<?php echo implode( ' ', $block_class ); ?>">
	<div class="page-hero-home__wrapper">
		<?php
		if ( ! empty( $bg_video ) ) {
			get_theme_part(
				'elements/video-background',
				array(
					'video' => $bg_video,

				)
			);
		}
		?>
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
<?php
if ( is_front_page() ) {
	get_theme_part( 'elements/program-filters/filters', [ 'mobile_modal' => true ] );
}
?>
</section>
<div id="contentstart"></div>
<?php


