<?php
/**
 * Block - Image Composition - main
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */
?>
<section class="block-img-comp">
    <div class="container-fluid"><?php
        ContentBlock::the_block_title();
        if( have_rows('image_layouts_row') ):
            while( have_rows('image_layouts_row') ): the_row();
                $layout = get_sub_field('select_row_layout');
                switch ($layout) {
                    case 'fluid_50_50':
                        get_theme_part( 'page/block-image-composition/two-half' );
                        break;
                    case 'fluid_full_width':
                        get_theme_part( 'page/block-image-composition/full-width' );
                        break;
                    case 'fluid_2small_1large':
                        get_theme_part( 'page/block-image-composition/two-small-one-large' );
                        break;
                    case 'fluid_2_3_a_1_3':
                        get_theme_part( 'page/block-image-composition/two-third-one-third' );
                        break;
                    case 'fluid_1_3_columns':
                        get_theme_part( 'page/block-image-composition/one-third-cols' );
                        break;
                }
            endwhile;
        endif;
    ?></div>
</section>
<?php
