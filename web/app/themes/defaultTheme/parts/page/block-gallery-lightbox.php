<?php
/**
 * Block with gallery lightbox
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

    $gallery = '';
    $gallery_length = 0;
    $gallery_id = get_sub_field('gallery');
    if(!empty($gallery_id)){
        $gallery = get_field('gallery_slides', $gallery_id);
        $gallery_length = count($gallery);
    }
?>
<section class="block-gallery-lightbox">
    <div class="container">
        <?php ContentBlock::the_block_title(); ?>
        <div class="lightbox-gallery__thumbnails-wrapper">
            <div class="row"><?php
            for($i = 0; $i < $gallery_length; $i++):
                ?><a href="<?php echo '#'.$i; ?>" class="lightbox-gallery__single-thumb col-6 col-md-4"><?php
                    echo wp_get_attachment_image($gallery[$i]['image'], 'thumbnail-content-image');
                ?></a><?php
            endfor;
            ?></div>
        </div>
    </div>
    <div class="lightbox-gallery__gallery-wrapper">
        <span class="lightbox-gallery__close"></span>
        <div class="container-fluid">
            <div class="lightbox-gallery__slider">
            <?php
                for($i = 0; $i < $gallery_length; $i++):
                    $caption = $gallery[$i]['caption'];
                    $img = wp_get_attachment_image($gallery[$i]['image'], 'slider-image-full');

                    if (!empty($img)):
            ?>
                <div class="lightbox-gallery__single-slide">
                    <figure class="lightbox-gallery__slide-image"><?php
                    echo $img;
                    if (!empty($caption)):
                ?><figcaption class="lightbox-gallery__caption"><?php echo $caption; ?></figcaption>
                <?php
                    endif;
                ?>
                    </figure>
                </div>
            <?php
                    endif;
                endfor;
            ?></div>
        </div>
    </div>
</section>
