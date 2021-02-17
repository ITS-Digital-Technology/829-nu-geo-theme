<?php
$htb_logo = get_field('htb_logo', 'options');
$htb_link = get_field('htb_link', 'options');
?>
<div class="main-header__top topbar">
    <a href="<?php echo $htb_link['url']; ?>" class="topbar__logo" aria-label="Logo">
        <?php echo f_img($htb_logo, 'mother-logo'); ?>
    </a>
    <?php get_theme_part('header/header-sub-nav'); ?>
</div>
<?php
