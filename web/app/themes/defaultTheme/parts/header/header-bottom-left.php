<?php
    $main_logo = get_field('main_logo', 'options');
    if (!empty($main_logo)):
?>
<div class="main-header__left col-12 col-lg-3">
    <a href="<?php echo home_url('/'); ?>" class="main-header__logo"><?php echo f_img($main_logo, 'main-logo'); ?></a>
    <?php get_theme_part('header/header-nav-mobile'); ?>
</div>
<?php endif; ?>
