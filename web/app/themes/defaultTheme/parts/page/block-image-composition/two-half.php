<?php
$fields = get_sub_field('fluid_5050_fields');

if (!empty($fields)):
    $img_left_id = $fields['image_left'];
    $img_right_id = $fields['image_right'];
    $img_left = wp_get_attachment_image($img_left_id, 'full-size');
    $img_right = wp_get_attachment_image($img_right_id, 'full-size');
    $img_capt = wp_get_attachment_caption( $img_left_id );
    $img_capt_right = wp_get_attachment_caption( $img_right_id );

    $padding_bool = $fields['add_padding'];

    $col_class = 'col-12 col-md-6';

    if ($padding_bool) {
        $col_class .= ' with-paddings';
    }
?>
<div class="row fluid-half">
<?php if (!empty($img_left_id)): ?>
    <div class="<?php echo $col_class; ?>">
        <figure class="block-img-single"><?php echo $img_left; ?>
        <?php if ($img_capt): ?>
            <figcaption class="wp-caption-text"><?php echo $img_capt; ?></figcaption>
        <?php endif; ?>
        </figure>
    </div>
<?php
    endif;
    if (!empty($img_right_id)):
?>
    <div class="<?php echo $col_class; ?>">
        <figure class="block-img-single"><?php echo $img_right; ?>
        <?php if ($img_capt_right): ?>
            <figcaption class="wp-caption-text"><?php echo $img_capt_right; ?></figcaption>
        <?php endif; ?>
        </figure>
    </div>
<?php endif; ?>
</div>
<?php
    endif;
