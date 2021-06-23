<?php
global $wp_query;

$search_quick_links = get_field( 'search_information', 'options' );
$ppp                = $wp_query->query_vars['posts_per_page'];
$paged              = $wp_query->query_vars['paged'];
$search_term        = $wp_query->query_vars['s'];
$found_posts        = $wp_query->found_posts;
$not_found          = $search_quick_links['serach_no_results_info'];
$results            = $found_posts . __( ' results for ', 'northeasternUniversity' ) . '"' . $search_term . '"';
?>
<section class="search-found-posts">
	<div class="search-found-posts-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-8">
					<div class="posts-list">
						<p role="alert" aria-live="assertive" class="search-results-info" tabindex="0" data-results='<?php echo $results; ?>'></p>
						<div class="posts-wrapper">
						<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
								$id        = get_the_ID();
								$post_type = get_post_type();
								get_theme_part(
									'search/results-single',
									[
										'id'        => $id,
										'post_type' => $post_type,
									]
								);
							endwhile;
						else :
							?>
							<div class="search-found-posts__not-found">
							<?php
							if ( ! empty( $not_found ) ) :
								echo $not_found;
							else :
								?>
								<h3><?php _e( 'Please try a different search term.', 'northeasternUniversity' ); ?></h3>
								<p><?php _e( 'If you still can\'t find what you are looking for, please contact us.', 'northeasternUniversity' ); ?></p>
								<?php
							endif;
							?>
							</div>
							<?php
						endif;
						?>
						</div>
						<?php get_theme_part( 'search/pagination' ); ?>
					</div>
				</div>
				<?php
				if ( ! empty( $search_quick_links ) ) :
					$menu_title = $search_quick_links['search_menu_title'];
					$menu       = $search_quick_links['search_quick_links'];
					?>
				<div class="col-12 col-lg-3 offset-lg-1 offset-xl-2 col-xl-2">
					<div class="quick-links">
						<p class="quick-links__title"><?php echo $menu_title; ?></p>
						<nav class="quick-links__menu">
							<?php
							wp_nav_menu(
								[
									'menu'      => $menu,
									'container' => false,
								]
							);
							?>
						</nav>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

</section>
