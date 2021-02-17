<?php
$dispaly_custom_footer = get_field( 'dispaly_custom_footer' );

$logo             = $dispaly_custom_footer && ! empty( get_field( 'custom_footer_logo' ) ) ? get_field( 'custom_footer_logo' ) : get_field( 'footer_logo', 'options' );
$address          = $dispaly_custom_footer && ! empty( get_field( 'custom_footer_address' ) ) ? get_field( 'custom_footer_address' ) : get_field( 'footer_address', 'options' );
$phone            = $dispaly_custom_footer && ! empty( get_field( 'custom_footer_phone' ) ) ? get_field( 'custom_footer_phone' ) : get_field( 'footer_phone', 'options' );
$menus            = $dispaly_custom_footer && ! empty( get_field( 'custom_footer_menus' ) ) ? get_field( 'custom_footer_menus' ) : get_field( 'footer_menus', 'options' );
$newsletter_text  = $dispaly_custom_footer && ! empty( get_field( 'custom_footer_newsletter_text' ) ) ? get_field( 'custom_footer_newsletter_text' ) : get_field( 'footer_newsletter_text', 'options' );
$newsletter_title = $dispaly_custom_footer && ! empty( get_field( 'custom_footer_newsletter_title' ) ) ? get_field( 'custom_footer_newsletter_title' ) : get_field( 'footer_newsletter_title', 'options' );
$newsletter       = $dispaly_custom_footer && ! empty( get_field( 'custom_footer_newsletter' ) ) ? get_field( 'custom_footer_newsletter' ) : get_field( 'footer_newsletter', 'options' );
$copy             = $dispaly_custom_footer && ! empty( get_field( 'custom_footer_copyright' ) ) ? get_field( 'custom_footer_copyright' ) : get_field( 'footer_copyright', 'options' );
$links            = $dispaly_custom_footer && ! empty( get_field( 'custom_footer_additional_links' ) ) ? get_field( 'custom_footer_additional_links' ) : get_field( 'footer_additional_links', 'options' );
$socials          = $dispaly_custom_footer && ! empty( get_field( 'custom_footer_socials' ) ) ? get_field( 'custom_footer_socials' ) : get_field( 'footer_socials', 'options' );
$logo             = get_svg( $logo );
?>
<div class="main-footer__top">
	<div class="container">
		<div class="main-footer__top-top">
			<div class="row">
				<div class="col-12 col-lg-3">
				<?php if ( ! empty( $logo ) ) : ?>
					<figure class="footer-top__logo">
						<?php echo $logo; ?>
					</figure>
				<?php endif; ?>
				<?php if ( ! empty( $address ) ) : ?>
					<div class="footer-top__address">
						<?php echo $address; ?>
					</div>
				<?php endif; ?>
				<?php
				if ( ! empty( $phone ) ) :
					$link_url   = $phone['url'];
					$link_title = $phone['title'];
					?>
					<div class="footer-top__phone">
						<a class="footer-top__phone" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_title ); ?></a>
					</div>
				<?php endif; ?>
				</div>
				<?php if ( ! empty( $menus ) ) : ?>
				<div class="col-12 col-lg-4 footer-top__col-menu">
					<div class="row">
						<?php
						foreach ( $menus as $menu ) :
							$title = $menu['title'];
							$menu  = $menu['menu'];
							?>
						<div class="col-6">
							<div class="footer-top__menu-col">
								<h4 class="footer-top__menu-title"><?php echo $title; ?></h4>
								<div class="footer-top__menu"><?php echo $menu; ?></div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if ( ! empty( $newsletter ) ) : ?>
				<div class="col-12 col-lg-5">
					<div class="footer-top__newsletter">
						<?php if ( ! empty( $newsletter_title ) ) : ?>
						<h4 class="footer-top__newsletter-title"><?php echo $newsletter_title; ?></h4>
						<?php endif; ?>
						<?php if ( ! empty( $newsletter_text ) ) : ?>
						<p class="footer-top__newsletter-text"><?php echo $newsletter_text; ?></p>
						<?php endif; ?>
						<?php echo $newsletter; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="main-footer__top-bottom">
			<div class="row">
				<div class="col-12 col-xl-6 main-footer__top-bottom-left">
				<?php if ( ! empty( $copy ) ) : ?>
					<div class="footer-top__copy">
						<?php echo $copy; ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $links ) ) : ?>
					<div class="footer-top__links">
						<?php
						foreach ( $links as $link ) :
							$link = $link['link'];
							if ( ! empty( $link ) ) :
								$link_url    = $link['url'];
								$link_title  = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<a class="footer-top__link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				</div>
				<?php if ( ! empty( $socials ) ) : ?>
				<div class="col-12 col-xl-6 main-footer__top-bottom-right">
					<div class="footer-top__socials">
						<?php
						foreach ( $socials as $social ) :
							$link = $social['social'];
							if ( ! empty( $link ) ) :
								$link_url    = $link['url'];
								$link_title  = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<a class="footer-top__social" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
