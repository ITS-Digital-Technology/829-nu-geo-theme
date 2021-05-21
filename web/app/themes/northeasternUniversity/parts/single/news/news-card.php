<?php
$post_id   = isset( $post_id ) ? $post_id : get_the_ID();
$permalink = get_the_permalink( $post_id );
$title     = get_the_title( $post_id );
$excerpt   = get_the_excerpt( $post_id );
$cat       = get_primary_taxonomy_term( $post_id, 'news_category' );
$image     = get_the_post_thumbnail( $post_id, 'thumbnail-content-image' );
?>
<article class="news-card col-12 col-lg-4 <?php if ( empty( $image ) ) { echo 'news-card--no-image'; } ?>">
	<div class="news-card__container">
		<!-- <a class="news-card__link" href="<?php echo esc_url( $permalink ); ?>" aria-label="<?php echo $title; ?>"></a> -->
		<div class="news-card__wrapper">
			<?php if ( ! empty( $cat ) ) : ?>
				<a href="<?php echo esc_url( $cat['url'] ); ?>" class="news-card__cat"><?php echo esc_html( $cat['title'] ); ?></a>
			<?php endif; ?>
			<?php if ( ! empty( $image ) ) : ?>
				<figure class="news-card__image">
					<?php echo $image; ?>
				</figure>
			<?php endif; ?>
			<div class="news-card__content">
				<h3 class="news-card__title">
					<a href="<?php echo esc_url( $permalink ); ?>">
						<?php echo esc_html( $title ); ?>
					</a>
				</h3>
			<?php if ( ! empty( $excerpt ) ) : ?>
				<p class="news-card__excerpt"><?php echo $excerpt; ?></p>
			<?php endif; ?>
				<p class="news-card__date"><?php echo get_the_date(); ?></p>   
			</div>
		</div>
	</div>
</article>
