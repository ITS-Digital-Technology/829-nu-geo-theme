<?php
$event_id = get_queried_object_id();
$content_post = get_post($event_id);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
?>

<div class="event-content">
    <?php echo $content;?>
</div>


