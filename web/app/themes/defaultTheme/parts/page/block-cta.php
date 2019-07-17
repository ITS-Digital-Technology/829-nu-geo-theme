<?php
/**
 * Block for CTA
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */
    $text = get_sub_field('cta_text');
    $cta = get_sub_field('button');
    $bg_color = get_sub_field('background_color');
    $style = '';
    if (!empty($bg_color)) {
        $style = " style='background-color: $bg_color'";
    }
?>
<section class="block-cta"<?php echo $style; ?>>
    <div class="container">
        <div class="row align-items-center"><?php
            if (!empty($text)):
            ?><div class="col-12 col-lg-8 block-cta__text-wrapper">
                <?php echo $text; ?>
            </div><?php
            endif;
            if (!empty($cta)):
            ?><div class="col-12 col-lg-4 block-cta__button-wrapper">
                <a class="c-btn c-btn-primary c-btn-color-alt" href="<?php echo $cta['url']; ?>" target="<?php echo $cta['target']; ?>"><span><?php echo $cta['title']; ?></span></a>
            </div><?php
            endif;
        ?></div>
    </div>
</section>
