<?php
/**
 * View: Events Bar Views
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/components/events-bar/views.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://m.tri.be/1aiy
 *
 * @version 5.3.0
 *
 * @var string $view_slug            Slug of the current view.
 * @var string $view_label           Label of the current view.
 * @var array  $public_views         Array of data of the public views, with the slug as the key.
 * @var bool   $disable_event_search Boolean on whether to disable the event search.
 */

$is_tabs_style         = empty( $disable_event_search ) && 3 >= count( $public_views );
$view_selector_classes = [
	'tribe-events-c-view-selector'         => true,
	'tribe-events-c-view-selector--labels' => empty( $disable_event_search ),
	'tribe-events-c-view-selector--tabs'   => $is_tabs_style,
];
?>
<div class="tribe-events-c-events-bar__views">
	<h3 class="tribe-common-a11y-visual-hide">
		<?php printf( esc_html__( '%s Views Navigation', 'the-events-calendar' ), tribe_get_event_label_singular() ); ?>
	</h3>

</div>
