<?php
/**
 * The Header for theme.
 *
 * Displays all of the <head> section and page header
 *
 * @package    WordPress
 * @subpackage defaultTheme
 * @since      defaultTheme 1.0
 */

get_theme_part( 'html-head' );
?>

<body <?php body_class(); ?>>
<div id="page">
	<header class="main-header"><?php
        get_theme_part( 'header/header-top' );
        get_theme_part( 'header/header-bottom' );
    ?></header>
