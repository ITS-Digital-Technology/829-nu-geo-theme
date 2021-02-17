<?php
$vertical_align   = get_field( 'featured_image_vertical' );
$horizontal_align = get_field( 'featured_image_horizontal' );
$thumbnail_id     = get_post_thumbnail_id();
$thumbnail_align  = 'center center';

if ( ! empty( $vertical_align ) && ! empty( $horizontal_align ) ) {
	$thumbnail_align = $vertical_align . ' ' . $horizontal_align;
}

$thumbnail = wp_get_attachment_image(
	$thumbnail_id,
	'single-news',
	false,
	[
		'style' => 'object-position: ' . $thumbnail_align,
	]
);

?>
<figure class="news-hero__image">
	<?php echo $thumbnail; ?>
</figure>
