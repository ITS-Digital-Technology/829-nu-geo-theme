<?php
$programs_hero_heading     = isset( $programs_hero_heading ) ? $programs_hero_heading : get_field( 'programs_hero_heading', 'options' );
$programs_hero_description = isset( $programs_hero_description ) ? $programs_hero_description : get_field( 'programs_hero_description', 'options' );
?>
<section class="block-hero-programs">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-5">
				<div class="hero-programs__title">
                    <h1><?php echo $programs_hero_heading;?></h1>
				</div>
			</div>
			<div class="col-12 col-lg-6 offset-lg-1">
				<div class="hero-programs__description">
                    <?php echo $programs_hero_description;?>
				</div>
			</div>
		</div>
	</div>
</section>
