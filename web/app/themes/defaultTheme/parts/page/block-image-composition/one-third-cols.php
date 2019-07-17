<?php
    $fields = get_sub_field('fluid_13_columns_fields');

    if (!empty($fields)):
        $img_left_id = $fields['image_left'];
        $img_middle_id = $fields['image_middle'];
        $img_right_id = $fields['image_right'];

        $img_left = wp_get_attachment_image($img_left_id, 'full-size');
        $img_middle = wp_get_attachment_image($img_middle_id, 'full-size');
        $img_right = wp_get_attachment_image($img_right_id, 'full-size');

        $col_class = 'col-12 col-md-4';
?>
<div class="row fluid-one-third">
<?php if (!empty($img_left_id)): ?>
    <div class="<?php echo $col_class; ?>">
        <figure class="block-img-single"><?php echo $img_left; ?></figure>
    </div>
<?php
    endif;
    if (!empty($img_left_id)):
?>
    <div class="<?php echo $col_class; ?>">
        <figure class="block-img-single"><?php echo $img_middle; ?></figure>
    </div>
<?php
    endif;
    if (!empty($img_right_id)):
?>
    <div class="<?php echo $col_class; ?>">
        <figure class="block-img-single"><?php echo $img_right; ?></figure>
    </div>
<?php endif; ?>
</div>
<?php
    endif;
