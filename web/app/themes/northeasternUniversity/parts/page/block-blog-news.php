<?php
$blog_title            = get_sub_field( 'blog_title' );
$blog_button_text      = get_sub_field( 'blog_button_text' );
$blog_manual_selection = get_sub_field( 'blog_manual_selection' );
$blog_manual_posts     = get_sub_field( 'blog_manual_posts' );

$news_title            = get_sub_field( 'news_title' );
$news_button_text      = get_sub_field( 'news_button_text' );
$news_manual_selection = get_sub_field( 'news_manual_selection' );
$news_manual_posts     = get_sub_field( 'news_manual_posts' );

$args_posts = [
	'posts_per_page' => 2,
];
$args_news  = [
	'post_type'      => 'news',
	'posts_per_page' => 3,
];
$query_news = new WP_Query( $args_news );


$posts = $blog_manual_posts ? $blog_manual_posts : get_posts( $args_posts );
$news  = $news_manual_selection ? $news_manual_posts : $query_news->posts;
?>
<section class="block-blog-news"<?php ContentBlock::the_block_id(); ?>>
	<div class="block-blog-news-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-7">
					<div class="blog-posts">
						<div class="blog-posts__title-wrapper">
							<h2 class="blog-posts__title"><?php echo $blog_title; ?></h2>
							<a class="c-btn c-btn-tertiary c-btn-color-normal" href="<?php echo get_post_type_archive_link( 'post' ); ?>">
							<span><?php echo $blog_button_text; ?></span><span class="c-btn-icon"><span class="icon-arrow-right-circle"></span></span></a>
						</div>
						<div class="blog-posts__posts-wrapper">
							<?php
							foreach ( $posts as $post ) :
								$title            = get_the_title( $post );
								$cat              = get_primary_taxonomy_term( $post, 'post_topic' );
								$post_author_id   = get_post_field( 'post_author', $post );
								$post_author_link = get_author_posts_url( $post_author_id );
								$author           = get_the_author_meta( 'display_name', $post_author_id );
								$thumbnail        = get_the_post_thumbnail( $post, 'post-card' );
								if ( empty( $thumbnail ) ) {
									$thumbnail = false;

								}
								$permalink = get_permalink( $post );
								?>
								<article class="post-card">
									<div class="post-card__wrapper">
									<?php if ( ! empty( $thumbnail ) ) : ?>
										<figure class="post-card__thumbnail">
											<a href="<?php echo $permalink; ?>"><?php echo $thumbnail; ?></a>
										</figure>
									<?php endif; ?>
										<div class="post-card__content">
										<?php if ( ! empty( $cat ) ) : ?>
											<div class="post-card__cat">
												<a class="post-card__cat-link" href="<?php echo $cat['url']; ?>"><?php echo $cat['title']; ?></a>
											</div>
										<?php endif; ?>
											<a class="post-card__title" href="<?php echo $permalink; ?>">
												<?php echo $title; ?>
											</a>

											<div class="post-card__author">
												<a href="<?php echo $post_author_link; ?>" class="post-card__author-link">
													<?php echo __( 'By', 'norheasternUniversity' ) . ' ' . $author; ?>
												</a>
											</div>
										</div>
									</div>
								</article>

							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4 offset-lg-1">
					<div class="news-posts">
						<div class="news-posts__title-wrapper">
							<h2 class="news-posts__title"><?php echo $news_title; ?></h2>
							<a class="c-btn c-btn-tertiary c-btn-color-normal" href="<?php echo get_post_type_archive_link( 'news' ); ?>">
							<span><?php echo $news_button_text; ?></span><span class="c-btn-icon"><span class="icon-arrow-right-circle"></span></span></a>
						</div>
						<div class="news-posts__posts-wrapper">
							<?php
							foreach ( $news as $post ) :
								$title     = get_the_title( $post );
								$cat       = get_primary_taxonomy_term( $post, 'news_category' );
								$terms     = get_the_terms( $post, 'news_category' );
								$permalink = get_permalink( $post );
								?>
								<article class="news-card">
									<!-- <a class="news-card__link" href="<?php echo $permalink; ?>" aria-label="<?php echo $title; ?>"></a> -->
									<div class="news-card__wrapper">
									<?php if ( ! empty( $cat ) ) : ?>
										<div class="news-card__cat">
											<a class="post-card__cat-link" href="<?php echo $cat['url']; ?>"><?php echo $cat['title']; ?></a>
										</div>
									<?php endif; ?>
										<a href="<?php echo $permalink; ?>" class="news-card__title">
											<?php echo $title; ?>
										</a>

										<p class="news-card__date"><?php echo get_the_date( 'm/d/Y', $post ); ?></p>
									</div>
								</article>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
