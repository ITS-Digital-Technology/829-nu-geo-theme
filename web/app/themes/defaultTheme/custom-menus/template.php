<?php
/**
 * Menu Item Template: Menu Template
 */
 ?>
<a href="<?php the_field( 'menu_link' ); ?>"><?php the_title(); ?></a>
<?php if(have_rows('mega_menu_columns')): ?>
	<div class="mega-menu-wrapper"><!-- Mega menu wrapper -->
		<div class="container"><!-- Mega menu container -->
			<div class="row"><!-- Mega menu row -->
			<?php
                while(have_rows( 'mega_menu_columns') ): the_row();
                $col_class = "col-sm-3";
                $width = get_sub_field( 'width' );
                if ($width){
                    $col_class = "col-sm-" . $width;
                }

            ?>
				<div class="<?php echo $col_class; ?>"><!-- Mega menu column -->
                    <?php if( get_row_layout() === 'mmc_wp_menu' ): ?>
    					<?php the_sub_field( 'mm_wp_menu' ); ?>
                    <?php elseif( get_row_layout() === 'mmc_wp_content' ): ?>
                        <?php the_sub_field( 'mm_wp_content' ); ?>
                    <?php endif; ?>
				</div><!-- End of mega menu column -->
			<?php endwhile; ?>
			</div><!-- End of mega menu row -->
		</div><!-- End of mega menu container -->
	</div><!-- End of mega menu wrapper -->
<?php endif; ?>
