<?php
$type         = get_field( 'type' );
$video        = get_field( 'video' );
$thumbnail_id = get_post_thumbnail_id();
$category     = get_primary_taxonomy_term( null, 'news_category' );
$media        = '';

$block_class[] = 'hero-news';
$block_class[] = 'hero-news--' . $type;

if ( 'image' === $type && ! empty( $thumbnail_id ) ) {
	$media = 'image';
}

if ( 'video' === $type && ! empty( $video ) ) {
	$media = 'video';
}

?>
<section class="<?php echo implode( ' ', $block_class ); ?>">
	<div class="hero-news__wrapper">
		<div class="hero-news__container">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="hero-news__header">
							<a href="<?php echo esc_url( get_post_type_archive_link( get_post_type() ) ); ?>" class="btn-all-posts"><?php esc_html_e( 'All News', 'northeasternUniversity' ); ?></a>
						</div>
						<div class="hero-news__content">
						<?php if ( ! empty( $category ) ) : ?>
							<a href="<?php echo esc_url( $category['url'] ); ?>" class="hero-news__cat"><?php echo esc_html( $category['title'] ); ?></a>
						<?php endif; ?>
							<h1 class="hero-news__title"><?php echo esc_html( get_the_title() ); ?></h1>
							<p class="hero-news__date"><?php echo get_the_date(); ?></p>
						</div>                  
					</div>
				</div>
			</div>
		</div>
		<?php if ( ! empty( $media ) ) : ?>
			<div class="hero-news__media">
				<div class="container">
					<div class="row">
						<div class="col-12">
						<?php
						if ( 'video' === $media ) {
								get_theme_part( 'single/news/hero/video' );
						} else {
								get_theme_part( 'single/news/hero/image' );
						}
						?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>  
	</div>
</section>
