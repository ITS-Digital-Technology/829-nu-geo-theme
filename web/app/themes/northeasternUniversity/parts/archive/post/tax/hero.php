<?php
$authorID = get_the_author_meta('ID');
$term     = get_queried_object();
$id       = $term->term_id;
$desc     = is_author() ? get_the_author_meta( 'description', $authorID ) : term_description($id);
?>
<section class="block-blog-tax-hero">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="blog-tax__btn-wrapper">
					<a class="blog-tax__btn" href="<?php echo get_post_type_archive_link( 'post' ); ?>">
						<span class="icon-chev-left"></span>
						<span><?php _e( 'Blog' ); ?></span>
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-lg-5">
				<div class="blog-tax__title-wrapper">
                <?php if(is_author() ):?>
                    <h1 class="blog-tax__title"><?php echo $term->data->display_name; ?></h1>
                <?php else : ?>
					<h1 class="blog-tax__title"><?php echo $term->name; ?></h1>
                <?php endif;?>
				</div>
			</div>
			<?php if ( ! empty( $desc ) ) : ?>
			<div class="col-12 col-lg-6 offset-lg-1">
				<div class="blog-tax__desc">
					<?php echo $desc; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
