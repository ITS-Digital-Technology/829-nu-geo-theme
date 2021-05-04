<?php
$title            = get_field( 'blog_the_latest_title', 'options' );
$manual_selection = get_field( 'blog_the_latest_manual_selection', 'options' );
$posts            = get_field( 'blog_the_latest_posts', 'options' );
$args_posts       = [
	'posts_per_page' => 4,
];
$posts            = $manual_selection ? $posts : get_posts( $args_posts );

?>

<section class="block-blog-latest-post">
	<div class="container">
		<div class="latest-post__title-wrapper">
			<h3 class="latest-post__title"><?php echo $title; ?></h3>
		</div>
		<?php if ( ! empty( $posts ) ) : ?>
		<div class="row">
			<?php
			foreach ( $posts as $post ) :
				$title          = get_the_title( $post );
				$cat            = get_primary_taxonomy_term( $post, 'post_topic' );
				$post_author_id = get_post_field( 'post_author', $post );
				$thumbnail      = '';
				$permalink      = get_permalink( $post );
				?>
			<div class="col-12 col-lg-3 latest-post__card-col">
				<?php
				get_theme_part(
					'archive/post/card',
					[
						'title'          => $title,
						'cat'            => $cat,
						'post_author_id' => $post_author_id,
						'thumbnail'      => $thumbnail,
						'permalink'      => $permalink,
					]
				);
				?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>
