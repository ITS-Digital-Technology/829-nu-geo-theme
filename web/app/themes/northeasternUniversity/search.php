<?php
/**
 * The search page template.
 *
 * @package    WordPress
 * @subpackage northeasternUniversity
 * @since      northeasternUniversity 1.0
 */

get_header();

?>
	<main class="page-content page-content--search">
	<?php
		get_theme_part( 'search/hero' );
		get_theme_part( 'search/results' );
	?>
	</main>
<?php
get_footer();
