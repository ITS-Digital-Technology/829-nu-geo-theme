<?php
/**
 * The Header for theme.
 *
 * Displays all of the <head> section and page header
 *
 * @package    WordPress
 * @subpackage northeasternUniversity
 * @since      northeasternUniversity 1.0
 */

get_theme_part( 'html-head' );

$body_class = [];

$alert_show    = get_field( 'h_show_alert_bar', 'options' );
$alert_content = get_field( 'h_alert_bar', 'options' );
$alert_link    = get_field( 'h_alert_bar_link', 'options' );
if ( $alert_show && ! empty( $alert_content ) && ! isset( $_COOKIE['hideAlertBar'] ) ) {
	$body_class[] = 'alert-bar-on';
}
?>

<body <?php body_class( implode( ' ', $body_class ) ); ?>>

<?php get_template_part('filter-options'); ?>

<div id="page">
	<header id="main-header" class="main-header"><?php
        get_theme_part(
            'header/alert-bar',
            [
                'show'    => $alert_show,
                'content' => $alert_content,
                'link'    => $alert_link,
            ]
        );
        wp_body_open();
        get_theme_part( 'header/header-bottom' );
        get_theme_part( 'header/search' );
    ?></header>
    <?php get_theme_part('header/undermenu');