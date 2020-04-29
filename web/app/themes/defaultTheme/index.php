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

			<?php if(have_posts()): ?>

				<?php if($heading_text): ?>
					<h1><?php echo $heading_text; ?></h1>
				<?php endif; ?>

				<?php get_theme_part( 'archive/loop-post' ); ?>

				<?php
				$args = array(
					'mid_size'           => 3,
					'prev_text'          => __( 'Prev' ),
					'next_text'          => __( 'Next' ),
					'screen_reader_text' => __( 'Posts navigation' ),
				);

				the_posts_pagination( $args );
				?>

			<?php else: ?>
				<h2><?php _e( 'Sorry, nothing found.', 'defaultTheme' ); ?></h2>
			<?php endif; ?>

		
			</div>
		</div>
	</main>

<?php
get_footer();
