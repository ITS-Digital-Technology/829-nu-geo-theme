<?php
/**
 * Block for CTA
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

$block_class[]    = 'block-cta';
$text             = isset( $text ) ? $text : get_sub_field( 'cta_text' );
$cta_select       = isset( $cta_select ) ? $cta_select : get_sub_field( 'cta_select' );
$background_image = isset( $background_image ) ? $background_image : get_sub_field( 'background_image' );
$left_image       = isset( $left_image ) ? $left_image : get_sub_field( 'left_image' );
$right_image      = isset( $right_image ) ? $right_image : get_sub_field( 'right_image' );

$bg_img           = wp_get_attachment_image( $background_image, 'full' );
$l_img            = wp_get_attachment_image( $left_image, 'cta-img' );
$r_img            = wp_get_attachment_image( $right_image, '$cta-img' );
if ( $cta_select === 'dark-mode' ) {
	$block_class[] = 'block-cta--dark';
} elseif ( $cta_select === 'full-background-image' && ! empty( $background_image ) ) {
	$block_class[] = 'block-cta--bg-img';
} elseif ( $cta_select === 'left-right-image' && ( ! empty( $left_image ) || ! empty( $right_image ) ) ) {
	$block_class[] = 'block-cta--lr-images';
}
?>
<section class="<?php echo implode( ' ', $block_class ); ?>"<?php ContentBlock::the_block_id(); ?>>
<?php if ( ! empty( $background_image ) && $cta_select ==='full-background-image' ) : ?>
	<figure class="block-cta__bg-img"><?php echo $bg_img; ?></figure>
<?php endif; ?>
<?php if(!empty($left_image) && $cta_select === 'left-right-image'):?>
    <figure class="block-cta__left-img"><?php echo $l_img; ?></figure>
<?php endif;?>
	<div class="container">
		<div class="row align-items-center">
		<?php
		if ( ! empty( $text ) ) :
			?>
			<div class="col-12 col-lg-8 offset-lg-2 block-cta__text-wrapper">
			<?php echo $text; ?>
			</div>
			<?php
		endif;
		?>
		</div>
    </div>
<?php if(!empty($right_image) && $cta_select === 'left-right-image'):?>
    <figure class="block-cta__right-img"><?php echo $r_img; ?></figure>
<?php endif;?>
</section>
