<?php
$title    = get_sub_field( 'title' );
$columns  = get_sub_field( 'columns' );
?>

<section class="block-icon-columns-content"<?php ContentBlock::the_block_id(); ?>>
	<div class="block-icon-columns-content__wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12">
				<?php if ( ! empty( $title ) ) : ?>
					<span class="block-icon-columns-content__title h2"><?php echo $title; ?></span>
				<?php endif; ?>
				<?php if ( ! empty( $columns ) ) : ?>
					<div class="block-icon-columns-content__columns">
						<div class="row">
						<?php
						foreach ( $columns as $key => $column ) :
							$icon = f_img( $column['icon'], 'columns-content-icon' );
							$title = $column['title'];
							$description = $column['description'];
							$button = $column['button'];
                            ?>
                            <div class="col-12 col-lg-4 block-icon-columns-content__column">
                            <?php if ( ! empty( $icon ) ) : ?>
                                <figure class="block-icon-columns-content__column-image"><?php echo $icon; ?></figure>
                            <?php endif; ?>   
                            <?php if ( ! empty( $title ) ) : ?>
                                <span class="block-icon-columns-content__column-title h3"><?php echo $title; ?></span>
                            <?php endif; ?>   
                            <?php if ( ! empty( $description ) ) : ?>
                                <p class="block-icon-columns-content__column-description"><?php echo $description; ?></p>
                            <?php endif; ?>
                            <?php
								echo wp_acf_link( $button, 'c-btn c-btn-tertiary c-btn-color-normal', 'icon-arrow-right-circle' );
                            ?>
                            </div>
						<?php 
						endforeach; 
						?>   
						</div>
                    </div>
				<?php endif; ?>
				</div>
            </div>
        </div>
	</div>
</section>
