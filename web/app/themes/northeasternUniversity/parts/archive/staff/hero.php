<?php
$title               = isset( $title ) ? get_field( 'staff_hero_title', 'options' ) : __( 'Staff Directory', 'northeasternUniversity' );
$desc                = get_field( 'staff_hero_descroption', 'options' );
$bg                  = get_field( 'staff_hero_background_image', 'options' );
$thumbnail_align     = 'center center';
$thumbnail           = wp_get_attachment_image(
	$bg,
	'full',
	false,
	[
		'style' => 'object-position: ' . $thumbnail_align,
	]
);
$info_box_title      = get_field( 'staff_hero_info_box_title', 'options' );
$info_box_department = get_field( 'staff_hero_info_box_department', 'options' );
$info_box_button     = get_field( 'staff_hero_info_box_button', 'options' );
$info_box_show       = get_field( 'staff_hero_info_box_show', 'options' );
$class 				 = $info_box_show ? '' : ' no-infobox';

?>

<section class="staff-directory-hero<?php echo $class; ?>">
<?php if ( ! empty( $thumbnail ) ) : ?>
	<figure class="staff-directory-hero__thumbnail"><?php echo $thumbnail; ?></figure>
<?php endif; ?>
	<div class="container">
		<div class="row staff-directory-hero__row">
			<div class="col-12 col-lg-6 col-xl-7">
				<div class="staff-directory-hero__content">
				<?php if ( ! empty( $title ) ) : ?>
					<h1 class="staff-directory-hero__title"><?php echo $title; ?></h1>
				<?php endif; ?>
				<?php if ( ! empty( $desc ) ) : ?>
					<p class="staff-directory-hero__desc"><?php echo $desc; ?></p>
				<?php endif; ?>
				</div>
			</div>
			<?php if ( !empty( $info_box_show ) ) : ?>
			<div class="col-12 col-lg-5 col-xl-4 offset-lg-1">
				<div class="staff-info-box">
					<div class="staff-info-box__wrapper">
					<?php if ( ! empty( $info_box_title ) ) : ?>
						<h4 class="staff-info-box__title"><?php echo $info_box_title; ?></h4>
					<?php endif; ?>
					<?php if ( ! empty( $info_box_department ) ) : ?>
						<div class="staff-info-box__department">
							<?php
							foreach ( $info_box_department as $d ) :
								$title = $d['title'];
								$hours = $d['hours'];
								?>
								<div class="staff-info-box__department-wrapper">
								<?php if ( ! empty( $title ) ) : ?>
									<p class="staff-info-box__department-title"><?php echo $title; ?></p>
								<?php endif; ?>
								<?php if ( ! empty( $hours ) ) : ?>
									<div class="staff-info-box__department-hours">
									<?php
									foreach ( $hours as $hour ) :
										$days  = $hour['days'];
										$times = $hour['times'];
										?>
										<div class="staff-info-box__department-hours__wrapper">
										<?php if ( ! empty( $days ) ) : ?>
											<span class="staff-info-box__department-hours-days"><?php echo $days; ?></span>
                                        <?php endif; ?>
                                        <span class="staff-info-box__department-hours-spacer"></span>
										<?php if ( ! empty( $times ) ) : ?>
											<span class="staff-info-box__department-hours-times"><?php echo $times; ?></span>
										<?php endif; ?>
										</div>
									<?php endforeach; ?>
									</div>
								<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<?php
					if ( ! empty( $info_box_button ) ) :

						$link_url    = $info_box_button['url'];
						$link_title  = $info_box_button['title'];
						$link_target = $info_box_button['target'] ? $info_box_button['target'] : '_self';
						?>
						<a class="staff-info-box__button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php endif; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>

</section>
