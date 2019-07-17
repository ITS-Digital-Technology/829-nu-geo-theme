<?php
/**
 * The static page template.
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

get_header(); the_post();
?>
    <main class="page-content"><?php
        get_theme_part('page/hero');
        ContentBlock::display_theme_blocks();
    ?></main>
<?php
get_footer();

