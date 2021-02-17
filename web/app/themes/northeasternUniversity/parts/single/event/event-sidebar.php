<?php
$event_id     = get_queried_object_id();
$button       = get_field( 'rsvp', $event_id );
$location     = get_field( 'location', $event_id );
$program_type = get_the_terms( $event_id, 'event_program_type' );

?>
<aside class="event-sidebar">
<?php if ( ! empty( $button ) ) : ?>
	<div class="event-sidebar__button">
		<?php echo wp_acf_link( $button, 'c-btn c-btn-primary c-btn-color-normal' ); ?>
	</div>
<?php endif; ?>	
	<div class="event-sidebar__content">
	<?php if ( ! empty( $location ) ) : ?>
		<div class="event-sidebar__item">
			<p class="event-sidebar__item-label"><?php esc_html_e( 'Event Location', 'northeasternUniversity' ); ?></p>
			<p class="event-sidebar__item-content"><?php echo esc_html( $location ) ?></p>
		</div>
	<?php endif; ?>
	<?php if ( ! empty( $program_type ) ) : ?>
		<div class="event-sidebar__item">
			<p class="event-sidebar__item-label"><?php esc_html_e( 'Program Type', 'northeasternUniversity' ); ?></p>
			<p class="event-sidebar__item-links">
			<?php 
			foreach ( $program_type as $key => $term ) : 
				$term_id = $term->term_id;
				$term_name = $term->name;

				if ( $key > 0 ) {
					echo ', ';
				}
				?>
					<a href="<?php echo esc_url( get_term_link( $term_id ) ); ?>"><?php echo esc_html( $term_name ); ?></a>
				<?php 
			endforeach; 
			?>
			</p>
		</div>
	<?php endif; ?>
	</div>
</aside>