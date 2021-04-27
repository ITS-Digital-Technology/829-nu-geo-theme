<?php
$event_id   = isset( $event_id ) ? $event_id : null;
$start_date = strtotime( tribe_get_start_date( $event_id, false, 'Y-m-j g:i a' ) );
$end_date   = strtotime( tribe_get_end_date( $event_id, false, 'Y-m-j g:i a' ) );
$is_all_day = tribe_event_is_all_day( $event_id );
$permalink  = get_the_permalink( $event_id );
$title      = get_the_title( $event_id );
$cat        = get_primary_taxonomy_term( $event_id, 'event_type' );
$image      = get_the_post_thumbnail( $event_id, 'thumbnail-content-image' );
$rsvp       = get_field( 'rsvp', $event_id );

$days = date( 'F j, Y', $start_date );
if ( date( 'Y', $start_date ) !== date( 'Y', $end_date ) ) {
	$days = date( 'M j, Y - ', $start_date ) . date( 'M j, Y', $end_date );
} elseif ( date( 'm', $start_date ) !== date( 'm', $end_date ) ) {
	$days = date( 'M j - ', $start_date ) . date( 'M j, Y', $end_date );
} elseif ( date( 'd', $start_date ) !== date( 'd', $end_date ) ) {
	$days = date( 'M j - ', $start_date ) . date( 'j, Y', $end_date );
}
?>
<article class="event-card col-12 col-lg-4 <?php if ( empty( $image ) ) { echo 'event-card--no-image'; } ?>">
	<div class="news-card__container">
		<a class="event-card__link" href="<?php echo esc_url( $permalink ); ?>" aria-label="<?php echo $title; ?>"></a>
		<div class="event-card__wrapper">
			<?php if ( ! empty( $cat ) ) : ?>
				<a href="<?php echo esc_url( $cat['url'] ); ?>" class="event-card__cat d-none d-lg-block"><?php echo esc_html( $cat['title'] ); ?></a>
			<?php endif; ?>
			<?php if ( ! empty( $image ) ) : ?>
				<figure class="event-card__image">
					<?php echo $image; ?>
				</figure>
			<?php endif; ?>
			<div class="event-card__content">
			<?php if ( ! empty( $cat ) ) : ?>
				<a href="<?php echo esc_url( $cat['url'] ); ?>" class="event-card__cat d-lg-none"><?php echo esc_html( $cat['title'] ); ?></a>
			<?php endif; ?>
				<h3 class="event-card__title"><?php echo esc_html( $title ); ?></h3>
				<div class="event-card__date">
					<div class="event-card__day">
						<span class="icon-calendar"></span>
						<span><?php esc_html_e( $days, 'northeasternUniversity' ); ?></span>
					</div>
					<?php if ( ! $is_all_day ) : ?>
					<div class="event-card__time">
						<span class="icon-time"></span>
						<span class="event-card__start-time"><?php echo date( 'g:ia', $start_date ); ?></span>
						<span class="event-card__end-time"><?php echo date( 'g:ia', $end_date ); ?></span>
					</div>
					<?php endif; ?>
				</div>
				<div class="event-card__buttons d-lg-none">
				<?php
				if ( ! empty( $rsvp ) ) {
					echo wp_acf_link( $rsvp, 'c-btn c-btn-primary c-btn-color-normal' );
				}
				?>
					<a class="c-btn c-btn-secondary c-btn-color-normal" href="<?php echo esc_url( $permalink ); ?>"><?php esc_html_e( 'Lean More', 'northeasternUniversity' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</article>