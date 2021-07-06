<?php
/**
 * Block fluid with content and image
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

$main_sect_class[] = 'block-content-images';
$block_img         = wp_get_attachment_image( get_sub_field( 'block_image' ), 'full-width-block' );
$aligment          = get_sub_field( 'block_image_alignment' );
$pattern_top       = get_sub_field( 'background_top_pattern' );
$pattern_bottom    = get_sub_field( 'background_bottom_pattern' );
$single_col_class = 'b-content-images__col col-12';


if ( ! empty( $pattern_top ) || ! empty( $pattern_bottom ) ) {
	$main_sect_class[] = 'block-content-images--pattern';
}

if ( ! empty( $pattern_top ) ) {
	$main_sect_class[] = 'block-content-images--pattern-top';
}

if ( ! empty( $pattern_bottom ) ) {
	$main_sect_class[] = ' block-content-images--pattern-bottom';
}

if ( $aligment === 'left' ) {
	$single_col_wide  = 'col-lg-6 image-left';
	$single_col_short = 'col-lg-5 offset-lg-1 content-right';
} else {
    $single_col_wide  = 'col-lg-6 offset-lg-1 image-right';
    $single_col_short = 'col-lg-5 content-left';
}
?>
<section class="<?php echo implode( ' ', $main_sect_class ); ?>"<?php ContentBlock::the_block_id(); ?>>
	<div class="block-content-images__wrapper">
		<div class="container">
			<div class="row">
				<div class="<?php echo $single_col_class . ' ' . $single_col_short; ?>">
					<div class="b-content-images__content-wrapper">
						<?php the_sub_field( 'block_content' ); ?>
					</div>
				</div>
				<div class="<?php echo $single_col_class . ' ' . $single_col_wide; ?>">
					<figure class="b-content-images__image"><?php echo $block_img; ?></figure>
				</div>
			</div>
		</div>
	</div>
</section>
