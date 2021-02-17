<?php
/**
 * View: List Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://m.tri.be/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

$container_classes = [ 'tribe-common-g-row', 'tribe-events-calendar-list__event-row' ];
$container_classes['tribe-events-calendar-list__event-row--featured'] = $event->featured;

$event_classes = tribe_get_post_class( [ 'tribe-events-calendar-list__event', 'tribe-common-g-row', 'tribe-common-g-row--gutters' ], $event->ID );
$type = get_primary_taxonomy_term( $event->ID, 'event_type' );
$button = get_field( 'rsvp' );

?>
<div <?php tribe_classes( $container_classes ); ?>>

	<div class="tribe-events-calendar-list__event-wrapper tribe-common-g-col">
		<article <?php tribe_classes( $event_classes ) ?>>
			<?php $this->template( 'list/event/featured-image', [ 'event' => $event ] ); ?>

			<div class="tribe-events-calendar-list__event-details tribe-common-g-col">
				<header class="tribe-events-calendar-list__event-header">
                <?php if ( ! empty( $type ) ) : ?>
					<a href="<?php echo $type['url']; ?>" class="tribe-events-calendar-list__event-type"><?php echo $type['title']; ?></a>
				<?php endif; ?>
					<?php $this->template( 'list/event/title', [ 'event' => $event ] ); ?>
                    <?php $this->template( 'list/event/card-day', [ 'event' => $event ] ); ?>
                </header>
                <div class="tribe-events-calendar-list__event-buttons">
                    <?php 
                    if ( ! empty( $button ) ) {
                            echo wp_acf_link( $button, 'c-btn c-btn-primary c-btn-color-normal' );
                        }
                    ?>
                    <a href="<?php echo get_the_permalink( $event ); ?>" class="c-btn c-btn-secondary c-btn-color-normal"><?php _e( 'Learn More', 'northeasternUniversity' ); ?></a>
                </div>
            </div>
		</article>
	</div>

</div>
