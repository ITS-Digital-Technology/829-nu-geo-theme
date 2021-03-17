<?php
$menu_id = isset( $menu_id ) ? $menu_id : get_sub_field( 'mm_wp_menu' );
$items   = wp_get_nav_menu_items( $menu_id );

$args = [
	'menu' 	=> $menu_id,
	'walker'=> new Description_Walker,
];

wp_nav_menu($args);
