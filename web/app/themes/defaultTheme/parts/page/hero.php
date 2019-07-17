<?php
/**
 * Main Hero section for page
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme  1.0
 */

    $banner_bool = get_field('hide_main_banner');

    if (!$banner_bool):
        $thumbnail = get_the_post_thumbnail_url();
        $vertical_align = get_field('featured_image_vertical');
        $horizontal_align = get_field('featured_image_horizontal');
        $thumbnail_align = 'center center';

        if (!empty($vertical_align) && !empty($horizontal_align)){
            $thumbnail_align = $vertical_align . ' ' . $horizontal_align;
        }

        $block_class[] = 'page-hero';

        if(!empty($thumbnail)){
            $block_class[] = 'page-hero--thumbnail';
            $thumbnail_class = 'page-hero__thumbnail';
            $style = 'background-image: url(' .  $thumbnail .  '); background-position:' . $thumbnail_align;
        }
?>
<section class="<?php echo implode(' ', $block_class); ?>">
    <?php if(!empty($thumbnail)): ?>
    <div class="<?php echo $thumbnail_class; ?>" style="<?php echo $style; ?>"></div>
    <?php endif; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="page-hero__content"><?php
                    ?><h1><?php the_title(); ?></h1><?php
                ?></div>
            </div>
        </div>
    </div>
</section>
<?php
    endif;
