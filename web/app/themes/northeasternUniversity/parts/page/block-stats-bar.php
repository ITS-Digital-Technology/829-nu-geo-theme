<?php
$stats = isset( $stats ) ? $stats : get_sub_field( 'stats' );
$count = count( $stats );
$class_col = ' stats-bar';
if ( $count === 1 ) {
	$class_col .= ' col-12';
} elseif ( $count === 2 ) {
	$class_col .= ' col-12 col-lg-6';
} elseif ( $count === 3 ) {
	$class_col .= ' col-12 col-lg-4';
} elseif ( $count === 4 ) {
	$class_col .= ' col-12 col-lg-3';
}
?>
<section class="block-stats-bar"<?php ContentBlock::the_block_id(); ?>>
	<div class="container">
		<div class="row stats-bar__row">
			<?php
			foreach ( $stats as $s ) :
				$statistic = $s['statistic'];
				$desc      = $s['description'];
				?>
				<div class="<?php echo $class_col; ?>">
                    <div class="stats-bar__wrapper">
                        <p class="stats-bar__statistic"><?php echo $statistic;?></p>
                        <p class="stats-bar__desc"><?php echo $desc;?></p>
                    </div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
