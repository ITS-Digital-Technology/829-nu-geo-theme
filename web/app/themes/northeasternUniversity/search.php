<?php
/**
 * The search page template.
 *
 * @package    WordPress
 * @subpackage northeasternUniversity
 * @since      northeasternUniversity 1.0
 */

get_header();
$keyword = get_search_query();
?>
    <main class="page-content page-content--search" data-search-term=<?php echo $keyword;?>>
        <?php
            if (class_exists('eight29_filters')) {
                echo do_shortcode('[eight29_filters
                layout="search"
                posts_per_row="1"
                posts_per_page="9"
                ]');
            }
        ?>
    </main>
<?php
get_footer();
