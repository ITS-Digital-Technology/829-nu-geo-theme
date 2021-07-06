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
    <main class="page-content" aria-label="Main"><?php
        get_theme_part('page/hero');
        defaultContent();
        ContentBlock::display_theme_blocks();
    ?></main>
<?php
get_footer();

