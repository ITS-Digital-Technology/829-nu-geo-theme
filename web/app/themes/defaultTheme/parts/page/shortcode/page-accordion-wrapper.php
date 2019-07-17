<?php break_grid('close'); ?>
<div class="page-accordion">
    <div class="container">
        <div class="row">
            <div class="<?php echo ContentBlock::get_block_size_class(); ?>">
                <?php echo do_shortcode($content); ?>
            </div>
        </div>
    </div>
</div>
<?php break_grid('open'); ?>
