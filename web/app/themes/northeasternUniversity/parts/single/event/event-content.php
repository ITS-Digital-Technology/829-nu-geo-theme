<?php
$event_id = get_queried_object_id();
?>
<div class="event-content">
    <?php echo do_shortcode( get_the_content( null, false, $event_id ) ); ?>
</div>


