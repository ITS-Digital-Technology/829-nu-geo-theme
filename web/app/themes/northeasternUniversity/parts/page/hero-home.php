<?php
/**
 * Home Hero section for page
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity  1.0
 */


$title         = isset( $title ) ? $title : '';
$humbnail      = isset( $thumbnail ) ? $thumbnail : false;
$block_class   = isset( $block_class ) ? $block_class : false;
$block_class[] = 'page-hero-home';
$gradient      = get_field('hero_display_gradient');

if( $gradient ){
    $block_class[] = 'page-hero--gradient';
}
if( $title ){
    $block_class[] = 'page-hero--text';
}

?>
<section class="<?php echo implode( ' ', $block_class ); ?>">
	<div class="page-hero-home__wrapper">
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
	get_theme_part( 'elements/program-filters/filters',['mobile_modal'=>true] );
}
?>
</section>
<?php


