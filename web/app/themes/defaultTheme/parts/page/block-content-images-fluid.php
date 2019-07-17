<?php
/**
 * Block fluid with content and image
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

$main_sect_class[] = 'block-content-images';
$spacing_class = ContentBlock::get_block_spacing_class();
$block_img = wp_get_attachment_image(get_sub_field('block_image'), 'full-width-block');


$container_bool = get_sub_field('display_in_container');
$container_class = 'container-fluid';
$aligment = get_sub_field('block_image_alignment');
$single_col_class = 'b-content-images__col col-12';
$single_col_wide = 'col-lg-8 image-right';
$single_col_short = 'col-lg-4 content-left';

if ($aligment === 'left'){
    $single_col_wide = 'col-lg-8 image-left order-lg-first';
    $single_col_short = 'col-lg-4 content-right order-lg-last';
}

if ($container_bool){
    $container_class = 'container';
    $main_sect_class[] = 'has-container';
    $single_col_wide = 'col-lg-7 image-right';
    $single_col_short = 'col-lg-5 content-left';
    $block_img = wp_get_attachment_image(get_sub_field('block_image'), 'standard-width-block');
    if ($aligment === 'left'){
        $single_col_wide = 'col-lg-7 image-left order-lg-first';
        $single_col_short = 'col-lg-5 content-right order-lg-last';
    }
}

if(!empty($spacing_class))
    $main_sect_class[] = $spacing_class;

if(!empty(get_sub_field('block_margin_top')))
    $main_sect_class[] = 'block-margin-top';

if(!empty(get_sub_field('block_margin_bottom')))
    $main_sect_class[] = 'block-margin-bottom';

$sect_bg = get_sub_field('block_background_color');
$attr_style = '';
if(!empty($sect_bg)){
    $attr_style .= 'background-color:'.$sect_bg.';';
}
$sect_bg_img = get_sub_field('block_background_image_pattern');
if(!empty($sect_bg_img)) {
    $attr_style .= 'background-image: url('. $sect_bg_img .')';
}
?><section class="<?php echo implode(' ',$main_sect_class); ?>" style="<?php echo $attr_style; ?>">
    <div class="<?php echo $container_class; ?>">
        <div class="row align-items-center">
            <div class="<?php echo $single_col_class . ' ' . $single_col_short; ?>">
                <div class="b-content-images__content-wrapper">
                    <?php the_sub_field('block_content'); ?>
                </div>
            </div>
            <div class="<?php echo $single_col_class . ' ' . $single_col_wide; ?>">
                <figure class="b-content-images__image"><?php echo $block_img; ?></figure>
            </div>
        </div>
    </div>
</section>
