<?php
    $sub_nav_bool = get_field('h_display_sub_navigation', 'options');
    $sub_nav = get_field('h_sub_navigation', 'options');
    if ( $sub_nav_bool && !empty($sub_nav)):
?>
<div class="main-header__top">
    <div class="main-header__wrapper">
        <?php get_theme_part('header/header-sub-nav', ['sub_nav' => $sub_nav]); ?>
    </div>
</div>
<?php
    endif;
