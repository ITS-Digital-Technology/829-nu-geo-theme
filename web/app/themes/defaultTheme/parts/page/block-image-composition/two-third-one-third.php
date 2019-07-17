<?php
    $fields = get_sub_field('fluid_23_and_13_fields');

    if (!empty($fields)):
        $img_large_id = $fields['image_large'];
        $img_small_id = $fields['image_small'];

        $img_large = wp_get_attachment_image($img_large_id, 'full-size');
        $img_small = wp_get_attachment_image($img_small_id, 'full-size');

        $small_col_pos = $fields['small_image_pos'];

        $first_col_class = 'col-12 col-md-4';
        $last_col_class = 'col-12 col-md-8';
        if ($small_col_pos === 'right') {
            $first_col_class .= ' order-last';
            $last_col_class .= ' order-first';
        }

?>
<div class="row fluid-two-small">
<?php if (!empty($img_small_id)): ?>
    <div class="<?php echo $first_col_class; ?>">
        <figure class="block-img-single"><?php echo $img_small; ?></figure>
    </div>
<?php endif; ?>
<?php if (!empty($img_large_id)): ?>
    <div class="<?php echo $last_col_class; ?>">
        <figure class="block-img-single"><?php echo $img_large; ?></figure>
    </div>
<?php endif; ?>
</div>
<?php
    endif;
