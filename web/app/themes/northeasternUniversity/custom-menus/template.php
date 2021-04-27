<?php
/**
 * Menu Item Template: Menu Template
 */
 ?>
<a href="#"><?php the_title(); ?></a>
<?php if(have_rows('mega_menu_columns')): ?>
	<div class="mega-menu-wrapper" aria-label="<?php  __( 'Menu listings', 'sr-description' ); ?>"><!-- Mega menu wrapper -->
		<div class="container">
            <div class="row"><!-- Mega menu row -->
            <button class="mega-menu-back"><?php echo get_the_title(); ?></button>
			<?php
                while(have_rows( 'mega_menu_columns') ): the_row();
                $col_class = "col-12 col-lg-3";
                $width = get_sub_field( 'width' );
                if ($width){
                    $col_class = "col-12 col-lg-" . $width;
                }
            ?>
				<div class="<?php echo $col_class; ?>"><!-- Mega menu column -->
                    <?php if( get_row_layout() === 'mmc_wp_menu' ): ?>
                        <?php get_theme_part('header/mm-menu'); ?>
                    <?php elseif( get_row_layout() === 'mmc_wp_links' ): ?>
                        <?php get_theme_part('header/mm-links'); ?>
                    <?php endif; ?>
				</div><!-- End of mega menu column -->
			<?php endwhile; ?>
			</div><!-- End of mega menu row -->
		</div>
	</div><!-- End of mega menu wrapper -->
<?php endif; ?>
