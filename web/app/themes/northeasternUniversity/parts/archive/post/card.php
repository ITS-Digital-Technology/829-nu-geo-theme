<?php
$permalink        = isset( $permalink ) ? $permalink : false;
$thumbnail        = isset( $thumbnail ) ? $thumbnail : false;
$cat              = isset( $cat ) ? $cat : false;
$title            = isset( $title ) ? $title : false;
$post_author_id   = isset( $post_author_id ) ? $post_author_id : false;
$post_author_link = get_author_posts_url( $post_author_id );
$author           = get_the_author_meta( 'display_name', $post_author_id );
$is_h3			  = isset($is_h3) ? $is_h3 : false;
?>


<article class="blog-post__card">
	<!-- <a class="blog-post__card-link" href="<?php echo $permalink; ?>" aria-label="<?php echo $title; ?>"></a> -->
	<div class="blog-post__card-wrapper">
	<?php if ( ! empty( $thumbnail ) ) : ?>
		<figure class="blog-post__card-thumbnail">
			<a href="<?php echo $permalink; ?>"><?php echo $thumbnail; ?></a>
		</figure>
	<?php endif; ?>
		<div class="blog-post__card-content">
		<?php if ( ! empty( $cat ) ) : ?>
			<div class="blog-post__card-cat">
				<a class="blog-post__card-cat-link" href="<?php echo $cat['url']; ?>"><?php echo $cat['title']; ?></a>
			</div>
		<?php endif; ?>
		<?php if ($is_h3) : ?>
			<span class="blog-post__card-title h3">
				<a href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
			</span>
		<?php else : ?>
			<span class="blog-post__card-title h4">
				<a href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
			</span>
		<?php endif; ?>

			<?php if ($author !== 'Northeastern University'): ?>
				<div class="blog-post__card-author">
					<a href="<?php echo $post_author_link; ?>" class="block-post__card__author-link">
						<?php echo __( 'By', 'norheasternUniversity' ) . ' ' . $author; ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</article>
