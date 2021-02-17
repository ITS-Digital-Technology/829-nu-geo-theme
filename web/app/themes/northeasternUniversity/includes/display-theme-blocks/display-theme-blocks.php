<?php
/**
 * Display theme blocks from flexible content (acf)
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

class ContentBlock {

	private static $theme_blocks_locations = array(
		'block_content'              => 'page/content',
		'block_tabs'                 => 'page/block-tabs',
        'block_slider_gallery'       => 'page/block-gallery-slider',
        'block_testimonial_slider'   => 'page/block-testimonial-slider',
        'block_gallery_video'        => 'page/block-gallery-video',
        'block_lightbox_gallery'     => 'page/block-gallery-lightbox',
        'block_image_links'          => 'page/block-image-links',
        'block_text_links'           => 'page/block-text-links',
		'block_content_images_fluid' => 'page/block-content-images-fluid',
		'block_call_to_action'       => 'page/block-cta',
        'universal_block'            => 'page/universal-block',
        'block_intro'                => 'page/block-intro',
        'block_upcoming_events'      => 'page/block-upcoming-events',
        'block_featured_programs'    => 'page/block-featured-programs',
        'block_blog_news'            => 'page/block-blog-news',
        'block_social_feed'          => 'page/block-social-feed',
        'block_program_comparison'   => 'page/block-program-comparison',
        'block_icon_columns_content' => 'page/block-icon-columns-content',
        'block_overview'             => 'page/block-overview',
        'block_stats_bar'            => 'page/block-stats-bar',
        'block_content_steps'        => 'page/block-content-steps',
        'block_related_posts'        => 'page/block-related-posts',
        'block_content_accordions'   => 'page/block-content-accordions'
	);

	private function __construct(){}

	public static function display_theme_blocks( $field_name = 'page_blocks', $sec_param = null ) {
		if ( $sec_param == null ) {
			$sec_param = get_the_ID();
		}
		while ( have_rows( $field_name, $sec_param ) ) {
			the_row();
			$block_layout = get_row_layout();

			if ( isset( self::$theme_blocks_locations[ $block_layout ] ) ) {
				get_theme_part( self::$theme_blocks_locations[ $block_layout ] );
			}
		}
	}

	public static function get_block_size_class() {
		$block_width          = get_sub_field( 'width' ) ? get_sub_field( 'width' ) : '8';
		$block_offset         = get_sub_field( 'offset' ) !== '' && get_sub_field( 'offset' ) !== false ? get_sub_field( 'offset' ) : '2';
		$block_width_sm       = get_sub_field( 'width_tablet' ) ? get_sub_field( 'width_tablet' ) : '12';
		$block_offset_sm      = get_sub_field( 'offset_tablet' ) ? get_sub_field( 'offset_tablet' ) : '';
		$block_width_xs       = get_sub_field( 'width_mobile' ) ? get_sub_field( 'width_mobile' ) : '12';
		$block_offset_xs      = get_sub_field( 'offset_mobile' ) ? get_sub_field( 'offset_mobile' ) : '';
		$block_size_classes   = array();
		$block_size_classes[] = 'col-' . $block_width_xs;
		$block_size_classes[] = 'col-md-' . $block_width_sm;
		$block_size_classes[] = 'col-lg-' . $block_width;

		if ( ! empty( $block_offset_xs ) || $block_offset_xs === '0' ) {
			$block_size_classes[] = 'offset-' . $block_offset_xs;
		}

		if ( ! empty( $block_offset_sm ) || $block_offset_sm === '0' ) {
			$block_size_classes[] = 'offset-md-' . $block_offset_sm;
		}

		if ( ! empty( $block_offset ) || $block_offset === '0' ) {
			$block_size_classes[] = 'offset-lg-' . $block_offset;
		}

		return implode( ' ', $block_size_classes );
	}

	public static function get_block_spacing_class() {
		$result = array();
		if ( get_sub_field( 'top_spacing' ) ) {
			$result[] = 'block-top-spacing';
		}
		if ( get_sub_field( 'bottom_spacing' ) ) {
			$result[] = 'block-bottom-spacing';
		}

		if ( get_sub_field( 'top_margin' ) ) {
			$result[] = 'block-margin-top';
		}
		if ( get_sub_field( 'bottom_margin' ) ) {
			$result[] = 'block-margin-bottom';
		}

		return implode( ' ', $result );
	}

	public static function the_block_title() {
		$block_title = get_sub_field( 'section_title' );
		if ( ! empty( $block_title ) ) :
			?><?php echo $block_title; ?>
			<?php
		endif;
    }

    public static function the_block_id( $id = false ) {
        if ( ! $id ) {
            $block_id = get_sub_field( 'anchor_id' );
            if ( ! empty( $block_id ) ) {
                $block_id = strtolower( str_replace( ' ', '-', $block_id ) );
                $string = preg_replace('/[^A-Za-z0-9\-]/', '', $block_id);

                $block_id =  preg_replace('/-+/', '-', $string);

                echo " id='$block_id'";
            }
        } else {
            $string =  strtolower( str_replace( ' ', '-', $id ) );
            return  preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        }
    }
}
