<?php
$term_id       = '';
$taxonomy_name = '';

if ( isset( $_GET ) ) {
	$term_id       = intval( reset( $_GET )[0] );
	$taxonomy_name = str_replace( 'tribe_', '', key( $_GET ) );
}

$current_term = get_term_by( 'id', $term_id, $taxonomy_name );
?>
<section class="event-tax-hero">
	<div class="event-tax-hero__wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="event-tax-hero__header">
						<a href="<?php echo esc_url( tribe_get_listview_link() ); ?>" class="btn-all-posts"><?php esc_html_e( 'All Events', 'northeasternUniversity' ); ?></a>
					</div>
				</div>
				<div class="col-12 col-lg-6">
					<div class="event-tax-hero__left">
						<?php 
						if($current_term) {
							$current_term_name = $current_term->name;
						}
						else {
							$current_term_name = 'Events';
						}
						?>
						<h1 class="event-tax-hero__term-name"><?php echo esc_html( $current_term_name ); ?></h1>
					</div>
				</div>
				<?php if ( ! empty( $current_term->description ) ) : ?>
				<div class="col-12 col-lg-6">
					<div class="event-tax-hero__right">
						<p class="event-tax-hero__term-description leadparagraph"><?php echo esc_html( $current_term->description ); ?></p>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
