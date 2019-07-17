<?php
    $cols_desktop_class = 'col-lg-' . $vars['desktop'];
    $cols_tablet_class = 'col-md-' . $vars['tablet'];
    $cols_mobile_class = 'col-' . $vars['mobile'];
    $cols_class = $cols_mobile_class . ' ' . $cols_tablet_class . ' ' . $cols_desktop_class;
    $block_class[] = 'page-columns';
    if (isset($vars['spacingtop']) && $vars['spacingtop'] == 'true'){
        $block_class[] = 'columns-spacing-top';
    }
    if (isset($vars['spacingbottom']) && $vars['spacingbottom'] == 'true'){
        $block_class[] = 'columns-spacing-bottom';
    }

?>
<?php break_grid('close'); ?>
<div class="<?php echo implode(' ',$block_class); ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="<?php echo $cols_class; ?>"><?php echo do_shortcode($content); ?></div><?php
        ?></div>
    </div>
</div>
<?php break_grid('open'); ?>
