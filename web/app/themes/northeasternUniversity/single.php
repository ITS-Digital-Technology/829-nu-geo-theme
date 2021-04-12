<?php
/**
 * The single post page template.
 *
 * @package    WordPress
 * @subpackage northeasternUniversity
 * @since      northeasternUniversity 1.0
 */

get_header();
the_post();
$type = get_post_type();
$thumbnail_class = has_post_thumbnail() ? 'has-thumbnail' : 'no-thumbnail';
?>

<main class="page-content page-content--single page-content--<?php echo $type;?> <?php echo $thumbnail_class; ?>">
<?php

    switch ( $type ) {
        case 'staff':
            get_theme_part( 'single/staff/staff-main' );
		break;
		
        case 'news':
            get_theme_part( 'single/news/news-main' );
        break;

        default:
            get_theme_part( 'single/post/post-main' );
    }
?>
</main>

<?php
get_footer();