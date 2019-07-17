<?php
    $fields = get_sub_field('fluid_2small_1large_fields');

    if (!empty($fields)):
        $img_large_id = $fields['image_large'];
        $img_small_top_id = $fields['image_small_top'];
        $img_small_bottom_id = $fields['image_small_bottom'];

        $img_large = wp_get_attachment_image($img_large_id, 'full-size');
        $img_small_top = wp_get_attachment_image($img_small_top_id, 'full-size');
        $img_small_bottom = wp_get_attachment_image($img_small_bottom_id, 'full-size');

        $small_col_pos = $fields['small_image_column_pos'];

        $first_col_class = 'col-12 col-md-4';
        $last_col_class = 'col-12 col-md-8';
        if ($small_col_pos === 'right') {
            $first_col_class .= ' order-last';
            $last_col_class .= ' order-first';
        }

?>
<div class="row fluid-two-small">
    <div class="<?php echo $first_col_class; ?>">
    <?php if (!empty($img_small_top_id)): ?>
        <figure class="block-img-single small-top"><?php echo $img_small_top; ?></figure>
    <?php endif; ?>
    <?php if (!empty($img_small_bottom_id)): ?>
        <figure class="block-img-single small-bottom"><?php echo $img_small_bottom; ?></figure>
    <?php endif; ?>
    </div>
<?php if (!empty($img_large_id)): ?>
    <div class="<?php echo $last_col_class; ?>">
        <figure class="block-img-single"><?php echo $img_large; ?></figure>
    </div>
<?php endif; ?>
</div>
<?php
    endif;
