<?php
$main_logo = get_field('main_logo', 'options');
if (!empty($main_logo)):
?>
<div class="main-header__left">
    <a href="<?php echo home_url('/'); ?>" class="main-header__logo">
        <span class="sr-only">Northeastern University Global Experience Office Homepage</span>
        <?php echo f_img($main_logo, 'main-logo'); ?>
    </a>
</div>
<?php endif; ?>
