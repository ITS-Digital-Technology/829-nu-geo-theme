<?php
/**
 * The main template file.
 *
 * @package    WordPress
 * @subpackage defaultTheme
 * @since      defaultTheme 1.0
 */

get_header();

$tax_conditions = is_tax() || is_category();
$heading_text = get_blog_heading();
$post_type = get_post_type();
$taxonomy = $tax_conditions ? get_queried_object()->taxonomy : NULL;
$term_id = $tax_conditions ? get_queried_object()->term_id : NULL;
?>

	<main class="content container">
		<div class="row">
			<div class="col-12">
				<?php 
				if (class_exists('eight29_filters') && !is_search()) {
					//Update the conditional and attributes as needed
					//Full list of attributes here: https://bitbucket.org/829studios/829-blog-category-filters-react/src/master/
					echo do_shortcode('[eight29_filters 
					post_type="'.$post_type.'" 
					display_sidebar="top" 
					posts_per_page="3" 
					taxonomy="'.$taxonomy.'"
					term_id="'.$term_id.'"
					]');
				}
				?>
			</div>
		</div>
	</main>

<?php
get_footer();
