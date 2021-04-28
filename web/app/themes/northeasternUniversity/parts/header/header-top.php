<?php
$htb_logo = get_field('htb_logo', 'options');
$htb_link = get_field('htb_link', 'options');
?>
<div class="main-header__top topbar">
    <a href="<?php echo $htb_link['url']; ?>" class="topbar__logo" aria-label="<?php echo $htb_link['title']; ?>">
        <?php echo f_img($htb_logo, 'mother-logo'); ?>
    </a>
    <?php //get_theme_part('header/header-sub-nav'); ?>

    <div id="neu-external-menu" x-data="NUGlobalElements.header()" x-init="init()" style="height: 48px; background-color: black"></div>
</div>
<?php
