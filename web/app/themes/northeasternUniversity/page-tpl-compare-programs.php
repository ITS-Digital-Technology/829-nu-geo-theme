<?php
/**
 * Template Name: Compare Programs
 * Compare Programs template.
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

get_header();
?>
<main class="page-content">
	<?php
	get_theme_part( 'tpl-compare-products/hero-compare' );
	ContentBlock::display_theme_blocks();
	?>
</main>
<?php
get_footer();
