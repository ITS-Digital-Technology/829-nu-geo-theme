<?php
/**
 * Block with content slider
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

    $block_size = ContentBlock::get_block_size_class();
    $gallery = '';
    $gallery_id = get_sub_field('gallery');

    if(!empty($gallery_id)){
        $gallery = get_field('gallery_slides', $gallery_id);
    }

    if (!empty($gallery)):

?><section class="block-gallery-slider">
    <div class="container">
    <?php ContentBlock::the_block_title(); ?>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="bc-gallery__slider">
                <?php
                    foreach($gallery as $slide):
                        $slide_img = wp_get_attachment_image($slide['image'], 'slider-image-full');
                        $slide_caption = $slide['caption'];
                        if (!empty($slide_img)):
                ?>
                    <div class="bc-gallery__single-slide">
                        <figure class="bc-gallery__image"><?php
                            echo $slide_img;
                            if (!empty($slide_caption)):
                            ?><figcaption class="bc-gallery__caption"><?php
                                echo $slide_caption;
                            ?></figcaption><?php
                            endif;
                        ?></figure>
                    </div>
                <?php
                        endif;
                    endforeach;
                ?>
                </div>
            </div>
        </div>
    </div>
</section><?php
    endif;
