<?php
$events_title    = isset( $events_title ) ? $events_title : get_field( 'eo_title', 'options' );
$featured_events = isset( $featured_events ) ? $featured_events : get_field( 'eo_featured_events', 'options' );
?>
<section class="event-hero">
	<div class="event-hero__wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12">
				<?php if ( ! empty( $events_title ) ) : ?>
					<h1 class="event-hero__title"><?php echo esc_html( $events_title ); ?></h1>
				<?php endif; ?>
				<h2 class="event-hero__subtitle h3"><span><?php esc_html_e( 'Featured', 'northeasternUniversity' ); ?></span></h2> 
				</div>
			</div>
			<?php if ( ! empty( $featured_events ) ) : ?>
				<div class="row">
				<?php
				foreach ( $featured_events as $event ) :
					get_theme_part( 'single/event/event-card', [ 'event_id' => $event] ); 
				endforeach;
				?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>