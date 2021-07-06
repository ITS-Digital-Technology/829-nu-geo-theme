<?php
$term     = get_queried_object();
$id       = $term->term_id;
$desc     = term_description($id);
?>
<section class="block-news-tax-hero">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="news-tax__btn-wrapper">
					<a class="news-tax__btn" href="<?php echo get_post_type_archive_link( 'news' ); ?>">
						<span class="icon-chev-left"></span>
						<span><?php _e( 'News' ); ?></span>
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-lg-5">
				<div class="news-tax__title-wrapper">
					<h1 class="news-tax__title"><?php echo $term->name; ?></h1>
				</div>
			</div>
			<?php if ( ! empty( $desc ) ) : ?>
			<div class="col-12 col-lg-6 offset-lg-1">
				<div class="news-tax__desc">
					<?php echo $desc; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
