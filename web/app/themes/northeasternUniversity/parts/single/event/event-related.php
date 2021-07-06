<?php
$today            = date( 'Y-m-d' );
$event_id         = get_queried_object_id();
$title            = get_field( 'se_related_events_title', 'options' );
$button           = get_field( 'se_related_events_button', 'options' );
$program_type     = get_the_terms( $event_id , 'event_program_type' );
$program_type_arr = array();

if ( ! empty( $program_type ) ) {
	foreach ( $program_type as $key => $program ) {
		$program_type_arr[$key] = $program->term_id;
	} 
}

$events = tribe_get_events(
	[
		'posts_per_page' => 3,
		'post__not_in'   => array( $event_id ),
		'meta_query'     => array(
			array(
				'key'     => '_EventStartDate',
				'value'   => $today,
				'compare' => '>=',
			),
		),
		'tax_query'      => array(
			array(
				'taxonomy' => 'event_program_type',
				'operator' => 'IN',
				'field'    => 'term_id',
				'terms'    => $program_type_arr,
			)
		)
	]
);

$related_class = count($events) === 0 ? 'no-related-events' : '';
?>

<section class="related-events <?php echo $related_class; ?>">
	<div class="related-events__wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="related-events__header">
					<?php if ( ! empty( $title ) ) : ?>
						<h2><?php echo esc_html( $title ); ?></h2>
					<?php endif; ?>
					<?php
					if ( ! empty( $button ) ) {
						echo wp_acf_link( $button, 'c-btn c-btn-tertiary c-btn-color-normal', 'icon-arrow-right-circle' );
					}
					?>
					</div>
				</div>
				<?php
				if ( ! empty( $events ) ) :
					foreach ( $events as $event ) :
						get_theme_part( 'single/event/event-card', [ 'event_id' => $event->ID ] );
					endforeach;
				else :
					?>
						<span class="col-12 text-center h2"><?php esc_html_e( 'Sorry, nothing found', 'northeasternUniversity' ); ?></span>
					<?php
				endif;
				?>
			</div>
		</div>
	</div>
</section>

