<?php
/**
 * Content part for default page
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity  1.0
 */

$use_content_field = get_sub_field( 'use_default_content_field' );
$block_size        = ContentBlock::get_block_size_class();

$main_block_class = 'block-content';
$spacing_class    = ContentBlock::get_block_spacing_class();
if ( ! empty( $spacing_class ) ) {
	$main_block_class .= ' ' . $spacing_class;
}

?>
<section class="<?php echo $main_block_class; ?>"<?php ContentBlock::the_block_id(); ?>>
	<div class="container">
		<div class="row">
			<div class="<?php echo $block_size; ?>">
                <?php
                if ( $use_content_field ) {
                    the_content();
                } else {
                    the_sub_field( 'content' );
                }
                ?>
			</div>
		</div>
	</div>
</section>
<?php
