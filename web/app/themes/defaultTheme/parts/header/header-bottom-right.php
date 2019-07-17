<?php
    $cta_bool = get_field('h_display_cta', 'options');
    $cta = get_field('h_cta', 'options');

    if ($cta_bool && !empty($cta)):
?>
<div class="main-header__right col-12 col-lg-3">
    <?php get_theme_part('header/header-cta', ['cta' => $cta]); ?>
</div>
<?php
    endif;
