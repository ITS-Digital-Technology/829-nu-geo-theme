<?php
/**
 * Block for images links
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

$block_class[] = 'block-image-links';

$links     = isset( $links ) ? $links : get_sub_field( 'content_links' );
$section_title = isset( $section_title ) ? $section_title : get_sub_field( 'section_title' );
$center_links  = isset($center_links) ? $center_links : get_sub_field('center_links');

if ( $links ) :
	?>
<section class="<?php echo implode( ' ', $block_class ); ?>"<?php ContentBlock::the_block_id(); ?>>
	<div class="container">
	<?php if ( $section_title ) : ?>
		<?php echo $section_title; ?>
    <?php endif; ?>

        <div class="row block-image-links__row<?php echo $center_links ? ' justify-content-center' : '' ?>">
        <?php
        foreach ( $links as $item ) :
            $link   = $item['link'];
            $width  = $item['width'];
            $img_id = $item['image'];
            $img    = wp_get_attachment_image( $img_id, 'image-link', false, 'data-object-fit' );
            $class  = 'block-image-links__col';

            switch ( $width ) {
                case '12':
                    $class .= ' col-12';
                    break;
                case '8':
                    $class .= ' col-12 col-sm-6 col-lg-8';
                    break;
                case '6':
                    $class .= ' col-12 col-sm-6';
                    break;
                case '3':
                    $class .= ' col-12 col-sm-6 col-lg-3';
                    break;
                case '2':
                    $class .= ' col-12 col-sm-6 col-lg-2';
                    break;
                default:
                    $class .= ' col-12 col-sm-6 col-lg-4';
            }

            if ( $link ) :
                $link_title  = $link['title'];
                $link_url    = $link['url'];
                $link_target = $link['target'] ? 'target="_blank" rel="noopener"' : 'target="_self"';
            ?>
            <div class="<?php echo $class; ?>">
                <a class="image-link" href="<?php echo esc_url( $link_url ); ?>" <?php echo $link_target; ?>>
                <?php if ( $img ) : ?>
                    <figure class="image-link__image">
                        <?php echo $img; ?>
                    </figure>
                <?php endif; ?>
                <?php
                if( !empty( $link_title )) {
                    get_theme_part('elements/content-link', ['link_title'=> $link_title] );
                }
                ?>
                </a>
            </div>
        <?php
            endif;
        endforeach;
        ?>
        </div>
	</div>
</section>
	<?php
endif;
