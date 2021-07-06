<?php
$display_box          = get_field( 'display_box' );
$box_title                = get_field( 'title' );
$hours                = get_field( 'hours' );
$button               = get_field( 'button' );
$display_contact_info = get_field( 'display_contact_info' );
$email                = get_field( 'email' );
$phone_number         = get_field( 'phone_number' );
$title                = get_the_title();
$name                 = preg_split( '/[\s,]+/', $title )[0];
?>

<aside class="staff-sidebar">
<?php if ( $display_box && ( ! empty( $box_title ) || ! empty( $hours ) || ! empty( $button ) ) ) : ?>
	<div class="staff-appointment">
	<?php if ( ! empty( $box_title ) ) : ?>
		<h4 class="staff-appointment__title">
			<?php echo $box_title; ?>
		</h4>
	<?php endif; ?>
	<?php if ( ! empty( $hours ) ) : ?>
		<div class="staff-appointment__hours">
		<?php 
		foreach ( $hours as $key => $item ) :
			$day  = $item['day'];
			$time = $item['time'];
		?>
			<p class="staff-appointment__hours-item">
			<?php if ( ! empty( $day ) ) : ?>
				<span class="staff-appointment__hours-day"><?php echo $day; ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $time ) ) : ?>
				<span class="staff-appointment__hours-hour"><?php echo $time; ?></span>
			<?php endif; ?>
			</p>
			<?php
		endforeach;
		?>   
		</div>
	<?php endif; ?>
	<?php
	if ( ! empty( $button ) ) {
		echo wp_acf_link( $button, 'c-btn c-btn-primary c-btn-color-normal' );
	}
	?>
	</div>
<?php endif; ?>
<?php if ( $display_contact_info && ( ! empty( $email ) || ! empty( $phone_number ) ) ) : ?>
	<div class="staff-contact-info">
		<span class="staff-contact-info__title h5">
			<?php
			echo esc_html_e( 'Contact', 'northeasternUniversity' );
			echo ' ' . $name;
			?>
		</span>
	<?php if ( ! empty( $email ) ) : ?>
		<p class="staff-contact-info__email">
			<span class="icon-email"></span>
			<?php echo wp_acf_link( $email, '' ); ?>
		</p>
	<?php endif; ?>
	<?php if ( ! empty( $phone_number ) ) : ?>
		<p class="staff-contact-info__phone">
			<span class="icon-phone"></span>
			<?php echo wp_acf_link( $phone_number, '' ); ?>
		</p>
	<?php endif; ?>
	</div>
<?php endif; ?>
</aside>
