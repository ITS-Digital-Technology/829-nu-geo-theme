<?php
/**
 * The single post page template.
 *
 * @package    WordPress
 * @subpackage defaultTheme
 * @since      defaultTheme 1.0
 */

get_header();
the_post();

?>

	<main class="content">
		<h1><?php the_title(); ?></h1>

		<div class="entry">
			<?php

			defaultContent();
			ContentBlock::display_theme_blocks();
			wp_link_pages();

			?>
		</div>

		<?php comments_template(); ?>
	</main>

<?php

get_template_part( 'sidebar' );
get_footer();
