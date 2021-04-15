<?php
$title = isset($title) ? $title : get_field('news_hero_title','options');
$news_featured_post = isset($news_featured_post) ? $news_featured_post : get_field('news_featured_post', 'options');
$args_posts = [
    'post_type' => 'news',
	'posts_per_page' => 1,
];
if ( empty( $news_featured_post ) ) {
	$news_featured_post = get_posts( $args_posts )[0]->ID;
}
?>
<section class="block-news-hero">
	<div class="container">
		<?php if ( ! empty( $title ) ) : ?>
			<h1 class="block-news-hero__title"><?php echo $title; ?></h1>
		<?php endif; ?>
		<?php if ( ! empty( $news_featured_post ) ) : ?>
		<div class="block-news-hero__featured-post">
			<?php
				$title            = get_the_title( $news_featured_post );
				$cat              = get_primary_taxonomy_term( $news_featured_post, 'news_category' );
				$post_author_id   = get_post_field( 'post_author', $news_featured_post );
				$post_author_link = get_author_posts_url( $post_author_id );
				$author           = get_the_author_meta( 'display_name', $post_author_id );
				$thumbnail        = get_the_post_thumbnail( $news_featured_post, 'post-featured-card' );
			if ( empty( $thumbnail ) ) {
				$thumbnail = wp_get_attachment_image( get_field( 'default_post_thumbnail', 'options' )['ID'], 'post-featured-card' );
			}
				$permalink = get_permalink( $news_featured_post );
			if ( has_excerpt( $news_featured_post ) ) {
				$excerpt = get_the_excerpt( $news_featured_post );
			} else {
				$excerpt = '';
			}
			?>
			<article class="featured-news-card">
				<a class="featured-news-card__link" href="<?php echo $permalink; ?>" aria-label="<?php echo $title; ?>"></a>
				<div class="featured-news-card__wrapper">
				<?php if ( ! empty( $thumbnail ) ) : ?>
					<figure class="featured-news-card__thumbnail">
						<span class="featured-news-card__label"><?php _e( 'Featured', 'northeasternUniversity' ); ?></span>
						<?php echo $thumbnail; ?></figure>
				<?php endif; ?>
					<div class="featured-news-card__content">
					<?php if ( ! empty( $cat ) ) : ?>
						<div class="featured-news-card__cat">
                            <a class="featured-news__cat-link" aria-label="<?php echo $cat['title']; ?> " href="<?php echo $cat['url']; ?>"><?php echo $cat['title']; ?></a>
						</div>
					<?php endif; ?>
						<h2 class="featured-news-card__title"><?php echo $title; ?></h2>
					<?php if ( ! empty( $excerpt ) ) : ?>
						<div class="featured-news-card__excerpt"><?php echo wp_trim_words( $excerpt, 40, '...' ); ?></div>
					<?php endif; ?>
                        <p class="featured-news-card__date"><?php echo get_the_date( 'F d, Y', $news_featured_post ); ?></p>
					</div>
				</div>
			</article>
		</div>
		<?php endif; ?>
	</div>
</section>
