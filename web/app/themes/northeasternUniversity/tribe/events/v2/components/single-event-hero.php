<?php
$event_id   = get_queried_object_id();
$cat        = get_primary_taxonomy_term( $event_id, 'event_type' );
$start_date = strtotime( tribe_get_start_date( $event_id, false, 'Y-m-j g:i a' ) );
$end_date   = strtotime( tribe_get_end_date( $event_id, false, 'Y-m-j g:i a' ) );
$is_all_day = tribe_event_is_all_day( $event_id );
$image      = get_the_post_thumbnail( $event_id, 'single-event' );

$days = date( 'F j, Y', $start_date );
if ( date( 'Y', $start_date ) !== date( 'Y', $end_date ) ) {
	$days = date( 'M j, Y - ', $start_date ) . date( 'M j, Y', $end_date );
} elseif ( date( 'm', $start_date ) !== date( 'm', $end_date ) ) {
	$days = date( 'M j - ', $start_date ) . date( 'M j, Y', $end_date );
} elseif ( date( 'd', $start_date ) !== date( 'd', $end_date ) ) {
	$days = date( 'M j - ', $start_date ) . date( 'j, Y', $end_date );
}

?>
<section class="single-event-hero">
	<div class="single-event-hero__wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-lg-6">
					<div class="single-event-hero__left">
						<a aria-label="Return to Events" href="<?php echo esc_url( tribe_get_listview_link() ); ?>" class="btn-all-posts"><?php esc_html_e( 'All Events', 'northeasternUniversity' ); ?></a>
						<?php if ( ! empty( $cat ) ) : ?>
							<a href="<?php echo esc_url( $cat['url'] ); ?>" class="single-event-hero__cat"><?php echo esc_html( $cat['title'] ); ?></a>
						<?php endif; ?>
						<h1 class="h2 single-event-hero__title"><?php echo esc_html( get_the_title( $event_id ) ); ?></h1>
						<div class="single-event-hero__date">
							<div class="single-event-hero__day">
								<span class="icon-calendar"></span>
								<span><?php esc_html_e( $days ); ?></span>
							</div>
							<?php if ( ! $is_all_day ) : ?>
							<div class="single-event-hero__time">
								<span class="icon-time"></span>
								<span class="single-event-hero__start-time"><?php echo date( 'g:ia', $start_date ); ?></span>
								<span class="single-event-hero__end-time"><?php echo date( 'g:ia', $end_date ); ?></span>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php if ( ! empty( $image ) ) : ?>
				<div class="col-12 col-lg-6 single-event-hero__right">
					<figure class="single-event-hero__image"><?php echo $image; ?></figure>
				</div>
			<?php endif; ?>
			</div>
		</div>
	</div>
</section>
