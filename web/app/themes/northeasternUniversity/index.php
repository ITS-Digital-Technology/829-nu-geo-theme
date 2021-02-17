<?php
/**
 * The main template file.
 *
 * @package    WordPress
 * @subpackage northeasternUniversity
 * @since      northeasternUniversity 1.0
 */


get_header();

$type = get_post_type();
?>
<main class="page-content">
<?php
//program archive
if ( $type === 'program' && ! is_tax() ) {
    get_theme_part( 'archive/program/main' );
} else if ( $type === 'program' && is_tax() ) {
    get_theme_part( 'archive/program/tax/main' );
//blog
} else if ( $type === 'post' && ( is_tax() || is_author()) ) {
    get_theme_part( 'archive/post/tax/main' );
} else if ( $type === 'post' && is_home() && ! is_tax() ) {
    get_theme_part( 'archive/post/main' );
//news
} else if ( $type === 'news' && !is_tax() ) {
    get_theme_part( 'archive/news/main' );
} else if ( $type === 'news' && is_tax() ) {
    get_theme_part( 'archive/news/tax/main' );
//staff
} else if ( $type === 'staff' && !is_tax() ) {
    get_theme_part( 'archive/staff/main' );
} else if ( $type === 'staff' && is_tax() ) {
    get_theme_part( 'archive/staff/tax/main' );
//default
} else {
	get_theme_part( 'archive/main' );
}
?>
</main>
<?php
get_footer();