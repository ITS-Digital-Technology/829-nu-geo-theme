<?php
$title = get_field('program_landing_page_title') ? get_field('program_landing_page_title') : get_the_title();
$images = get_field('program_landing_page_images');
$icon = get_field('program_landing_page_icon');
$icon = get_svg($icon);
$block_class[] = "block-program-landing-hero";
if($icon){
    $block_class[] = "block-program-landing-hero--icon";
}
?>
<section class="<?php echo implode( ' ', $block_class ); ?>">
    <div class="program-landing-hero__top">
    <?php if(!empty($icon)):?>
        <figure class="program-landing-hero__icon"><?php echo $icon;?></figure>
    <?php endif;?>
    <?php if(!empty($title)):?>
        <h1><?php echo $title; ?></h1>
    <?php endif;?>
    </div>
    <div class="program-landing-hero__images">
		<?php
		foreach ( $images as $image ) :
			$img = wp_get_attachment_image( $image['image'], 'image-collage' );
		?>
			<figure class="program-landing-hero__image">
				<?php echo $img; ?>
            </figure>
		<?php endforeach; ?>
	</div>
    <div class="program-landing-hero__filters">
        <?php echo get_theme_part('elements/program-filters/filters'); ?>
    </div>
</section>