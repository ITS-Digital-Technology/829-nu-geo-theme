<?php
/**
 * The main template file.
 *
 * @package    WordPress
 * @subpackage defaultTheme
 * @since      defaultTheme 1.0
 */

get_header();

$heading_text = get_blog_heading();

?>

	<main class="content container">
		<div class="row">
			<div class="col-12">
				<?php 
				if (class_exists('eight29_filters')) {
					echo do_shortcode('[eight29_filters]');
				}
				?>
			</div>
		</div>
	</main>

<?php
get_footer();
