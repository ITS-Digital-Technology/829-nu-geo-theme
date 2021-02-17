<?php
$cta_select       = get_field( 'programs_cta_select', 'options' );
$text             = get_field( 'programs_cta_text', 'options' );
$background_image = get_field( 'programs_cta_background_image', 'options' );
$left_image       = get_field( 'programs_cta_left_image', 'options' );
$right_image      = get_field( 'programs_cta_right_image', 'options' );

get_theme_part(
	'page/block-cta',
	[
		'cta_select'       => $cta_select,
		'text'             => $text,
		'background_image' => $background_image,
		'left_image'       => $left_image,
		'right_image'      => $right_image,
	]
);
