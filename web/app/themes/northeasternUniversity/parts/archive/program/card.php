<?php
$status       = isset( $status ) ? $status : false;
$link         = isset( $link ) ? $link : false;
$app_deadline = isset( $app_deadline ) ? $app_deadline : false;
$thumbnail    = isset( $thumbnail ) ? $thumbnail : false;
$title        = isset( $title ) ? $title : false;
$city         = isset( $city ) ? $city : false;
$country      = isset( $country ) ? $country : false;
$terms        = isset( $terms ) ? $terms : false;
$class_status = isset( $class_status ) ? $class_status : false;
?>
<article class="program-card col-12 col-lg-4">
	<div class="program-card__wrapper">
	<?php
	if ( ! empty( $link ) ) :
		$link_url    = $link['url'];
		$link_title  = $link['title'];
		$link_target = $link['target'] ? $link['target'] : '_self';

		?>
		<!-- <a class="program-card__link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" aria-label="<?php echo $title; ?>"></a> -->
	<?php endif; ?>
		<?php if ( ! empty( $status ) ) : ?>
		<span class="<?php echo $class_status; ?>"><?php echo $status; ?></span>
		<?php endif; ?>

		<?php if ( ! empty( $thumbnail ) ) : ?>
			<figure class="program-card__thumbnail">
			<a href="<?php echo esc_url( $link_url ); ?>"><?php echo $thumbnail; ?></a>
			</figure>
		<?php endif; ?>

		<div class="program-card__content">
		<?php if ( ! empty( $type ) ) : ?>
			<div class="program-card__type-wrapper">
				<a class="program-card__type" href="<?php echo $type['url']; ?>"><?php echo $type['title']; ?></a>
			</div>
		<?php endif; ?>

			<h3 class="program-card__title">
				<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
					<?php echo $title; ?>
				</a>
			</h3>

		<?php if ( ! empty( $city ) || ! empty( $country ) || ! empty( $terms ) ) : ?>
			<div class="program-card__info">
			<?php if ( ! empty( $city ) || ! empty( $country ) ) : ?>
				<div class="program-card__info-location">
					<span class="program-card__info-name-location program-card__info-name"><?php _e( 'Location: ', 'northeasternUniversity' ); ?></span>
					<?php if ( ! empty( $city ) ) : ?>
					<a href="<?php echo $city['url']; ?>" class="program-card__info-city"><?php echo $city['title'] . ', '; ?></a>
					<?php endif; ?>
					<?php if ( ! empty( $country ) ) : ?>
					<a href="<?php echo $country['url']; ?>" class="program-card__info-country"><?php echo $country['title']; ?></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $terms ) ) : ?>
				<div class="program-card__info-terms">
					<span class="program-card__info-name-terms program-card__info-name"><?php _e( 'Term(s): ', 'northeasternUniversity' ); ?></span>
					<?php
					$separator = '';
					$len       = count( $terms );
					foreach ( $terms as $term ) :
						?>
					<a class="program-card__info-term" href="<?php echo get_term_link( $term->term_id ); ?>">
						<?php
							echo $term->name;
						if ( $len > 1 ) {
							echo ',';
						}
							$len--;
						?>
					</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if ( ! empty( $app_deadline ) ) : ?>
			<p class="program-card__application-deadline">
				<span class="program-card__application-deadline-name"><?php _e( 'Application deadline: ', 'norheasternUniersity' ); ?></span>
				<span class="program-card__application-deadline-date"><?php echo $app_deadline; ?></span>
			</p>
		<?php endif; ?>
		</div>
	</div>
</article>
