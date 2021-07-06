<?php
$start_date = strtotime( $event->start_date );
$end_date   = strtotime( tribe_get_end_date( $event, false, 'Y-m-j g:i a' ) );
$is_all_day = tribe_event_is_all_day( $event );

$days = date( 'F j, Y', $start_date );
if ( date( 'Y', $start_date ) !== date( 'Y', $end_date ) ) {
    $days = date( 'M j, Y - ', $start_date ) . date( 'M j, Y', $end_date );
} elseif ( date( 'm', $start_date ) !== date( 'm', $end_date ) ) {
    $days = date( 'M j - ', $start_date ) . date( 'M j, Y', $end_date );
} elseif ( date( 'd', $start_date ) !== date( 'd', $end_date ) ) {
    $days = date( 'M j - ', $start_date ) . date( 'j, Y', $end_date );
}
?>
<div class="tribe-events-calendar-list__event-day">
    <span class="icon-calendar"></span>
    <span><?php esc_html_e( $days ); ?></span>
</div>
<?php if ( ! $is_all_day ) : ?>
<div class="tribe-events-calendar-list__event-time">
    <span class="icon-time"></span>
    <span class="tribe-events-calendar-list__start-time"><?php echo date( 'g:ia', $start_date ); ?></span>
    <span class="tribe-events-calendar-list__end-time"><?php echo date( 'g:ia', $end_date ); ?></span>
</div>
<?php endif; ?>
