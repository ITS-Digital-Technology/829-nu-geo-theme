<section class="block-post-hero">
	<div class="container">
		<?php
		$title            = get_the_title();
		$cat              = get_primary_taxonomy_term( get_the_ID(), 'post_topic' );
		$post_author_id   = get_post_field( 'post_author', get_the_ID() );
		$post_author_link = get_author_posts_url( $post_author_id );
		$author           = get_the_author_meta( 'display_name', $post_author_id );
		$thumbnail        = get_the_post_thumbnail( get_the_ID(), 'full' );

		if ( empty( $thumbnail ) ) {
			$thumbnail = wp_get_attachment_image( get_field( 'default_post_thumbnail', 'options' )['ID'], 'full' );
		}
		?>
		<a href="<?php echo get_post_type_archive_link( 'post' ); ?>" class="block-post-hero__back">
			<?php _e( 'Blog', 'northeasternUniversity' ); ?>
		</a>
		<div class="block-post-hero__wrapper">
		<?php if ( ! empty( $cat ) ) : ?>
			<a class="block-post-hero__cat-link" href="<?php echo $cat['url']; ?>">
				<?php echo $cat['title']; ?>
			</a>
		<?php endif; ?>
			<h1 class="block-post-hero__title"><?php echo get_the_title(); ?></h1>
			<div class="block-post-hero__meta">
				<?php if ( $author !== 'Northeastern University' ) : ?>
					<div class="block-post-hero__author">
						<a href="<?php echo $post_author_link; ?>" class="block-post-hero__author-link">
							<?php echo $author; ?>
						</a>
					</div>
				<?php endif; ?>
				<div class="block-post-hero__date">
					<?php echo get_the_date(); ?>
				</div>
			</div>
		</div>

	<?php if ( ! empty( $thumbnail ) ) : ?>
		<figure class="block-post-hero__thumbnail">
			<?php echo $thumbnail; ?>
		</figure>
	<?php endif; ?>
	</div>
</section>
<section class="bg-pattern"></section>
