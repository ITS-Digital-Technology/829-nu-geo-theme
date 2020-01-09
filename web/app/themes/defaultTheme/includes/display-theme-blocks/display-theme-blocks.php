<?php
/**
 * Display theme blocks from flexible content (acf)
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

class ContentBlock {

    private static $theme_blocks_locations = array(
        'block_content'              => 'page/content',
        'block_tabs'                 => 'page/block-tabs',
        'block_slider_gallery'       => 'page/block-content-gallery',
        'block_content_links'        => 'page/block-content-links',
        'block_text_links'           => 'page/block-content-links',
        'block_gallery_lightbox'     => 'page/block-gallery-lightbox',
        'block_img_composition'      => 'page/block-image-composition/main',
        'block_content_images_fluid' => 'page/block-content-images-fluid',
        'block_call_to_action'       => 'page/block-cta',
        'universal_block'            => 'page/universal-block',
    );

    private function __construct(){}

    public static function display_theme_blocks($field_name = 'page_blocks', $sec_param = null){
        if($sec_param == null)
            $sec_param = get_the_ID();
        while(have_rows($field_name, $sec_param)){ the_row();
            $block_layout = get_row_layout();

            if(isset(self::$theme_blocks_locations[$block_layout])){
                get_theme_part(self::$theme_blocks_locations[$block_layout]);
            }
        }
    }

    public static function get_block_size_class(){
        $block_width     = get_sub_field('width') ? get_sub_field('width') : '8';
        $block_offset    = get_sub_field('offset') !== '' && get_sub_field('offset') !== false ? get_sub_field('offset') : '2';
        $block_width_sm     = get_sub_field('width_tablet') ? get_sub_field('width_tablet') : '12';
        $block_offset_sm    = get_sub_field('offset_tablet') ? get_sub_field('offset_tablet') : '';
        $block_width_xs     = get_sub_field('width_mobile') ? get_sub_field('width_mobile') : '12';
        $block_offset_xs    = get_sub_field('offset_mobile') ? get_sub_field('offset_mobile') : '';
        $block_size_classes = array();
        $block_size_classes[] = "col-" . $block_width_xs;
        $block_size_classes[] = "col-md-" . $block_width_sm;
        $block_size_classes[] = "col-lg-" . $block_width;

        if(!empty($block_offset_xs) || $block_offset_xs === '0') {
            $block_size_classes[] = "offset-" . $block_offset_xs;
        }

        if(!empty($block_offset_sm) || $block_offset_sm === '0') {
            $block_size_classes[] = "offset-md-" . $block_offset_sm;
        }

        if(!empty($block_offset) || $block_offset === '0') {
            $block_size_classes[] = "offset-lg-" . $block_offset;
        }

        return implode(' ', $block_size_classes);
    }

    public static function get_block_spacing_class(){
        $result = array();
        if(get_sub_field('top_spacing')){
            $result[] = 'block-top-spacing';
        }
        if(get_sub_field('bottom_spacing')){
            $result[] = 'block-bottom-spacing';
        }

        if(get_sub_field('top_margin')){
            $result[] = 'block-margin-top';
        }
        if(get_sub_field('bottom_margin')){
            $result[] = 'block-margin-bottom';
        }

        return implode(' ', $result);
    }

    public static function the_block_title(){
        $block_title = get_sub_field('section_title');
        if(!empty($block_title)):
            ?><?php echo $block_title; ?><?php
        endif;
    }
}
