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
        $vertical_align_mobile = get_field('featured_image_vertical_mobile');
        $horizontal_align_mobile = get_field('featured_image_horizontal_mobile');
        $thumbnail_align = 'center center';

        if (!empty($vertical_align) && !empty($horizontal_align)){
            $thumbnail_align = $vertical_align.' '.$horizontal_align;
        }

        if (!empty($vertical_align_mobile) && !empty($horizontal_align_mobile)){
            $thumbnail_align_mobile = $vertical_align_mobile.' '.$horizontal_align_mobile;
        }

        $block_class[] = 'page-hero';

        if(!empty($thumbnail)){
            $block_class[] = 'page-hero--thumbnail';
            $thumbnail_class = 'page-hero__thumbnail';
            $css_class = '.'.$thumbnail_class;
            $style = 'background-image: url(' .  $thumbnail .  ');';
        }
?>

<?php if(!$banner_bool && $vertical_align && $horizontal_align): ?>
<style>
    <?php echo $css_class; ?> {
        background-position: <?php echo $thumbnail_align ?>;
    }
</style>
<?php endif; ?>

<?php if(!$banner_bool && $vertical_align_mobile && $horizontal_align_mobile): ?>
<style>
    @media only screen and (max-width: 767px) {
        <?php echo $css_class; ?> {
            background-position: <?php echo $thumbnail_align_mobile ?>;
        }
    }
</style>
<?php endif; ?>

<section class="<?php echo implode(' ', $block_class); ?>">
    <?php if(!empty($thumbnail)): ?>
    <div class="<?php echo $thumbnail_class; ?>" style="<?php echo $style; ?>"></div>
    <?php endif; ?>
    <div class="container">
    test
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
