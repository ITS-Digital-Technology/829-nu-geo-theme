<?php
$position = get_field( 'single_staff_position' );
$category = get_primary_taxonomy_term( null, 'staff_category' );
$image    = get_the_post_thumbnail( null, 'single-staff' );
?>
<section class="hero-staff">
	<div class="hero-staff__wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-6">
					<div class="hero-staff__left">
						<a href="<?php echo esc_url( get_post_type_archive_link( get_post_type() ) ); ?>" class="btn-all-posts"><?php esc_html_e( 'All Staff', 'northeasternUniversity' ); ?></a>
					<?php if ( ! empty( $category ) ) : ?>
						<a href="<?php echo esc_url( $category['url'] ); ?>" class="hero-staff__cat"><?php echo esc_html( $category['title'] ); ?></a>
					<?php endif; ?>
						<h1 class="hero-staff__title"><?php echo esc_html( get_the_title() ); ?></h1>
					<?php if ( ! empty( $position ) ) : ?>
						<span class="hero-staff__position h3"><?php echo esc_html( $position ); ?></span>
					<?php endif; ?>
					</div>
				</div>
			<?php if ( ! empty( $image ) ) : ?>
				<div class="col-12 col-lg-6">
					<figure class="hero-staff__right">
						<?php echo $image; ?>
					</figure>
				</div>
			<?php endif; ?>
			</div>
		</div>
	</div>
</section>
