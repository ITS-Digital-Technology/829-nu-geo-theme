<?php
$show = get_field('show_additional_submenu');
$menu = get_field('page_undermenu');

if ($show && !empty($menu)) :
?>
<div class="undermenu">
    <div class="undermenu__wrapper">
        <button class="undermenu__trigger"><?php _e('Submenu', 'northeasternUniversity'); ?></button>
        <?php echo $menu; ?>
    </div>
</div>
<?php endif;