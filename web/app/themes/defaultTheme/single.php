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

	<main class="content container">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1><?php the_title(); ?></h1>

					<div class="entry">
						<?php
						defaultContent();
						ContentBlock::display_theme_blocks();
						wp_link_pages();
						?>
					</div>
				</div>
			</div>
		</div>
	</main>

<?php
get_footer();
