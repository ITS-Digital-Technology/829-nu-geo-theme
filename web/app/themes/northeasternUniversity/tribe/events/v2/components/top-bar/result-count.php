<?php
$count_events  = wp_count_posts( 'tribe_events' );
$result_string = __( 'result', 'northeasternUniversity' );

// if ( $count_events > 1 ) {
//     $result_string = __( 'results', 'northeasternUniversity' );
// }
$events = tribe_get_events();
?>
<div class="tribe-events-c-top-bar__result-count">
    <span><?php _e( 'Returning', 'northeasternUniversity' ); ?></span>
 
    <span><?php echo $result_string; ?></span>
</div>
