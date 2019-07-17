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
		<?php

		if ( have_posts() ) :
			if ( $heading_text ) :
				?>

				<h1><?php echo $heading_text; ?></h1>

				<?php
			endif;

			get_theme_part( 'archive/loop-post' );
		else :
			?>

			<h2><?php _e( 'Sorry, nothing found.', 'defaultTheme' ); ?></h2>

			<?php
		endif;

		?>
	</main>

<?php

get_template_part( 'sidebar' );

$args = array(
	'mid_size'           => 3,
	'prev_text'          => __( 'Prev' ),
	'next_text'          => __( 'Next' ),
	'screen_reader_text' => __( 'Posts navigation' ),
);

the_posts_pagination( $args );

get_footer();
