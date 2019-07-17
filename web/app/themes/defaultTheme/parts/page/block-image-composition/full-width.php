<?php
$fields = get_sub_field('fluid_full_width_fields');
$img = $fields['image'];

if (!empty($fields)):
    $img_id = $fields['image'];

    if (!empty($img_id)):
        $img = wp_get_attachment_image($img_id, 'full-size');
        $img_capt = wp_get_attachment_caption( $img_id );
        $col_class = 'col-12';
?>
<div class="row fluid-full">
    <div class="<?php echo $col_class; ?>">
        <figure class="block-img-single"><?php echo $img; ?>
        <?php if ($img_capt): ?>
            <figcaption class="wp-caption-text"><?php echo $img_capt; ?></figcaption>
        <?php endif; ?>
        </figure>
    </div>
</div>
<?php
    endif;
endif;
