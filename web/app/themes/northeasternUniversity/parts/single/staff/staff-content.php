<?php
$columns       = get_field( 'columns' );
$about_content = get_field( 'about_content' );
$set_overflow  = false;
$title         = get_the_title();
$name          = preg_split( '/[\s,]+/', $title )[0];

$args = array(
	'post_type'      => 'staff',
	'posts_per_page' => 1,
	'order'          => 'ASC',
);

$next_post = ! empty( get_next_post() ) ? get_next_post() : get_posts( $args )[0];

if ( ! empty( $columns ) ) {
	foreach ( $columns as $key => $column ) {
		$column_content = $column['content'];
		$document       = new DOMDocument();
		$document->loadHTML( $column_content );
		$li = $document->getElementsByTagName( 'li' );

		if ( $li->length >=4 ) {
			$set_overflow = true;
		}
	}
}
?>
<div class="staff-content">
<?php if ( ! empty( $columns ) ) : ?>
	<section class="staff-focus <?php if ( $set_overflow ) { echo 'staff-focus--overflow'; } ?>">
		<h3 class="staff-focus__title">
			<?php
			echo $name;
			echo esc_html_e( '\'s Focus Areas', 'northeasternUniversity' );
			?>
		</h3>
		<div class="staff-focus__wrapper row">
		<?php
		foreach ( $columns as $key => $column ) :
			$column_content = $column['content'];
			?>
			<div class="staff-focus__column col-12 col-lg-4">
				<?php echo $column_content; ?>
			</div>
			<?php
		endforeach;
		?>	
		</div>
		<?php
		if ( $set_overflow ) :
			?>
			<button class="c-btn c-btn-tertiary c-btn-color-normal staff-focus__btn" target="_blank" rel="noopener">
				<span><?php esc_html_e( 'See More', 'northeasternUniversity' ); ?></span>
				<span><?php esc_html_e( 'See Less', 'northeasternUniversity' ); ?></span>
				<span class="c-btn-icon"><span class="icon-chev-expand"></span></span>
			</button>
			<?php
		endif;
		?>
	</section>
<?php endif; ?>
<?php if ( ! empty( $about_content ) ) : ?>
	<section class="staff-about">
		<span class="staff-about__title h3">
			<?php
			echo esc_html_e( 'About', 'northeasternUniversity' );
			echo ' ' . $name;
			?>
		</span>
		<div class="staff-about__wrapper"><?php echo $about_content; ?></div>
	</section>
<?php endif; ?>

	<div class="staff-button">
		<?php if($next_post->ID !== get_the_ID()): ?>
			<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="c-btn c-btn-tertiary c-btn-color-normal">
			<span><?php esc_html_e( 'Next: Meet', 'northeasternUniversity' ); echo ' ' . $next_post->post_title;  ?></span>
			<span class="c-btn-icon"><span class="icon-arrow-right-circle"></span></span>
		</a>
		<?php endif; ?>
	</div>

</div>
