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
	<!--ARIA landmark having same label as landmark type can cause confusion to screen reader users. Following will be read out as "main main landmark".
	<main class="page-content page-content--search" aria-label="Main">
	-->
	<main class="page-content page-content--search">
	<?php
		get_theme_part( 'search/hero' );
		get_theme_part( 'search/results' );
	?>
	</main>
<?php
get_footer();
