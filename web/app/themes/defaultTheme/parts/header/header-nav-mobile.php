<button class="btn-hamburger"><span></span><span></span><span></span></button>
<div class="main-header__nav-mobile--wrapper">
    <nav class="main-header__nav-mobile"><?php
        wp_nav_menu( array( 'theme_location' => 'mobile_primary', 'container' => false ) );
    ?></nav>
<?php
    $sub_nav_bool = get_field('h_display_sub_navigation', 'options');
    $sub_nav = get_field('h_sub_navigation', 'options');

    if ( $sub_nav_bool && !empty($sub_nav)){
        get_theme_part('header/header-sub-nav', ['sub_nav' => $sub_nav]);
    }

    $cta_bool = get_field('h_display_cta', 'options');
    $cta = get_field('h_cta', 'options');

    if ($cta_bool && !empty($cta)):
?>
    <div class="main-header__cta-wrapper--mobile"><?php
        get_theme_part('header/header-cta', ['cta' => $cta]);
    ?></div>
<?php
    endif;
?>
</div>
