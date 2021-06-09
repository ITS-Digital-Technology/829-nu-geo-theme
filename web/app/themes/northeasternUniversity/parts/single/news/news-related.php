<?php
$title         = get_field( 'sn_related_title', 'options' );
$button        = get_field( 'sn_related_button', 'options' );
$news_category = get_the_terms( null, 'news_category' )[0];

$args = array(
	'post_type'      => 'news',
	'posts_per_page' => 3,
	'post__not_in'   => array( get_the_ID() ),
	'tax_query'      => array(
		array(
			'taxonomy' => 'news_category',
			'field'    => 'slug',
			'terms'    => $news_category->slug,
		)
	)
);

$query = new WP_Query( $args );
?>
<section class="related-news">
	<div class="related-news__wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="related-news__header">
					<?php if ( ! empty( $title ) ) : ?>
						<h2><?php echo esc_html( $title ); ?></h2>
					<?php endif; ?>
					<?php
					if ( ! empty( $button ) ) {
						echo wp_acf_link( $button, 'c-btn c-btn-tertiary c-btn-color-normal', 'icon-arrow-right-circle' );
					}
					?>
					</div>
				</div>
				<?php
				if ( $query->have_posts() ) :
					while ( $query->have_posts() ) :
						$query->the_post();
						get_theme_part( 'single/news/news-card' );
				endwhile;
				else :
					?>
						<span class="col-12 text-center h2"><?php esc_html_e( 'Sorry, nothing found', 'northeasternUniversity' ); ?></span>
					<?php
				endif;
				?>
			</div>
		</div>
	</div>
</section>

