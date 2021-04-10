<?php
$event_id = get_queried_object_id();
?>
<div class="event-content">
    <?php the_content(null, false, $event_id); ?>
</div>


