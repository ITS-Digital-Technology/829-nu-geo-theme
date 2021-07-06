<?php

/*
Plugin Name: Advanced Custom Fields: Icon Picker
Description: Creates field type for an icon picker using a CSS file.
Version: 1.0.0
Author: 829 Studios
Author URI: https://www.829llc.com
*/

function include_field_types_icon_picker( $version ) {
	include_once 'acf-icon-picker-v5.php';
}

add_action('acf/include_field_types', 'include_field_types_icon_picker');