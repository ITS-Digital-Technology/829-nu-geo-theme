<?php
/**
 * The static page template.
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

get_header(); the_post();
?>
    <!--ARIA landmark having same label as landmark type can cause confusion to screen reader users. Following will be read out as "main main landmark".
    <main class="page-content" aria-label="Main"><?php
    -->
    <main class="page-content"><?php
        get_theme_part('page/hero');
        defaultContent();
        ContentBlock::display_theme_blocks();
    ?></main>
<?php
get_footer();

