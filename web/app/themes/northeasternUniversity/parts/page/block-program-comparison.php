<?php
$title    = get_sub_field( 'title' );
$programs = get_sub_field( 'programs' );
?>

<section class="block-program-comparison"<?php ContentBlock::the_block_id(); ?>>
	<div class="block-program-comparison__wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12">
				<?php if ( ! empty( $title ) ) : ?>
					<h2 class="block-program-comparison__title"><?php echo $title; ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $programs ) ) : ?>
					<div class="block-program-comparison__programs">
						<div class="block-program-comparison__programs-nav">
						<?php
						foreach ( $programs as $key => $tab ) :
							$tab_title = $tab['tab_title'];
							?>
							<button class="block-program-comparison__programs-nav-item c-btn c-btn-secondary c-btn-color-normal" data-tab="#tab-<?php echo $key; ?>"><span><?php echo $tab_title; ?></span></button>
						<?php 
						endforeach; 
						?>   
						</div>
						<div class="block-program-comparison__programs-tab-content">
						<?php
						foreach ( $programs as $key => $tab ) :
							$tab_content = $tab['tab_content'];
							$show_button = false;
							?>
							<div class="block-program-comparison__programs-tab" data-tab="#tab-<?php echo $key; ?>">
								<div class="block-program-comparison__programs-tab-wrapper row">
								<?php
								foreach ( $tab_content as $key => $article ) : 
									$image                   = wp_get_attachment_image( $article['image'], 'program-compare' );
									$title                   = $article['title'];
									$description             = $article['description'];
									$primary_button          = $article['primary_button'];
									$tertiary_button         = $article['tertiary_button'];
									$additional_informations = $article['additional_information'];

									if ( ! empty( $additional_informations ) ) { 
										$show_button = true;
									}
									?>
									<article class="block-program-comparison__programs-article col-12 col-lg-4">
										<div class="block-program-comparison__programs-article-wrapper">
										<?php if ( ! empty( $image ) ) : ?>
											<figure class="block-program-comparison__programs-article-image"><?php echo $image; ?></figure>
										<?php endif; ?>
											<div class="block-program-comparison__programs-article-content">
											<?php if ( ! empty( $title ) ) : ?>
												<h3 class="block-program-comparison__programs-article-title"><?php echo $title; ?></h3>
											<?php endif; ?>
											<?php if ( ! empty( $description ) ) : ?>
												<p class="block-program-comparison__programs-article-description"><?php echo $description; ?></p>
											<?php endif; ?>
											</div>
											<div class="block-program-comparison__programs-article-buttons">
											<?php
											if ( ! empty( $primary_button ) ) {
												echo wp_acf_link( $primary_button, 'c-btn c-btn-primary c-btn-color-normal' );
											}

											if ( ! empty( $tertiary_button ) ) {
												echo wp_acf_link( $tertiary_button, 'c-btn c-btn-tertiary c-btn-color-normal', 'icon-arrow-right-circle' );
											}
											?>
											</div>
										</div>
									<?php if ( ! empty( $additional_informations ) ) : ?>	
										<div class="block-program-comparison__programs-article-informations">
										<?php
										foreach ( $additional_informations as $key => $info ) :
											$info_title = $info['title'];
											$info_text = $info['text'];
											?>
											<div class="block-program-comparison__programs-article-information-item-wrapper">
											<?php if ( ! empty( $info_title ) ) : ?>
												<p class="block-program-comparison__programs-article-information-title"><?php echo $info_title; ?></p>
											<?php endif; ?>
											<?php if ( ! empty( $info_text ) ) : ?>
												<p class="block-program-comparison__programs-article-information-text"><?php echo $info_text; ?></p>
											<?php endif; ?>
											</div>
											<?php
										endforeach;
										?>
										</div>
									<?php endif; ?>
									</article>
									<?php
								endforeach;
								?>
								</div>
								<?php if ( $show_button ) : ?>
								<div class="block-program-comparison__programs-information-button">
									<button class="c-btn c-btn-secondary c-btn-color-normal">
										<span><?php esc_html_e( 'Compare Results', 'northeasternUniversity' ); ?></span>
										<span><?php esc_html_e( 'Hide Results', 'northeasternUniversity' ); ?></span>
										<span class="c-btn-icon"><span class="icon-arrow-downward"></span></span>
									</button>
								</div> 
								<?php endif; ?>                          
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
