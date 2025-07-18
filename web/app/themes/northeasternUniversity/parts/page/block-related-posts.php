<?php
$title                 = get_sub_field( 'section_title' );
$button                = get_sub_field( 'button' );
$blog_manual_selection = get_sub_field( 'manual_selection' );
$blog_manual_posts     = get_sub_field( 'posts' );
$choose_category       = get_sub_field( 'choose_category' );
$category_id           = get_sub_field( 'category_id' );

$tax_query_array = [
	[
		'taxonomy' => 'post_program',
		'field'    => 'term_id',
		'terms'    => $category_id,
	],
];

$tax_query = $category_id && $choose_category ? $tax_query_array : false;

$args_posts = [
	'posts_per_page' => 3,
	'tax_query'      => $tax_query,
];

$posts = $blog_manual_selection ? $blog_manual_posts : get_posts( $args_posts );
?>

<section class="block-related-posts">
	<div class="container">
		<div class="related-posts">
			<div class="related-posts__top">
			<?php if ( ! empty( $title ) ) : ?>
				<h2 class="related-posts__title"><?php echo $title; ?></h2>
			<?php endif; ?>
			<?php
			if ( ! empty( $button ) ) :
				$link_url    = $button['url'];
				$link_title  = $button['title'];
				$link_target = $button['target'] ? $button['target'] : '_self';
				?>
				<a class="c-btn c-btn-tertiary c-btn-color-normal" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
					<span><?php echo esc_html( $link_title ); ?></span>
					<span class="c-btn-icon"><span class="icon-arrow-right-circle"></span></span>
				</a>
			<?php endif; ?>
			</div>
			<div class="related-posts__bottom">
				<div class="row">
				<?php
				foreach ( $posts as $post ) :
					$title            = get_the_title( $post );
					$cat              = get_primary_taxonomy_term( $post, 'post_topic' );
					$post_author_id   = get_post_field( 'post_author', $post );
					$post_author_link = get_author_posts_url( $post_author_id );
					$author           = get_the_author_meta( 'display_name', $post_author_id );
					$thumbnail        = get_the_post_thumbnail( $post, 'thumbnail-card' );
					$default_image    = get_field( 'default_post_thumbnail', 'option' );
					$permalink        = get_permalink( $post );

					if ( empty( $thumbnail ) ) {
						$thumbnail = wp_get_attachment_image( $default_image, 'thumbnail-card' );
					}

					?>
					<div class="col-12 col-lg-4 related-posts__post-col">
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
			</div>
		</div>
	</div>
</section>

