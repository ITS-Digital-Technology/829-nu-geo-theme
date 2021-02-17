<?php
/**
 * Full width content block
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

$main_sect_class[] = 'block-fullwidth';
$spacing_class = ContentBlock::get_block_spacing_class();

if(!empty($spacing_class))
    $main_sect_class[] = $spacing_class;

?><section class="<?php echo implode(' ',$main_sect_class); ?>"<?php ContentBlock::the_block_id(); ?>>
    <div class="container-fluid"><?php
        the_sub_field('content');
    ?></div>
</section><?php
