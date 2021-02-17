<?php
$links     = get_field( 'footer_b_links', 'options' );
$text      = get_field( 'footer_b_text', 'options' );
$socials   = get_field( 'footer_b_socials', 'options' );
$add_links = get_field( 'footer_b_add_links', 'options' );
?>
<div class="main-footer__bottom">
	<div class="container-fluid">
		<div class="footer-bottom row">
			<div class="col-12 col-lg-7">
                <div class="footer-bottom__left">
                    <div class="footer-bottom__links">
                        <?php
                        foreach ( $links as $link ) :
                            echo wp_acf_link( $link['link'], 'footer-bottom__link' );
                        endforeach;
                        ?>
                    </div>
                    <div class="footer-bottom__text">
                        <?php echo $text; ?>
                    </div>
                </div>
			</div>
			<div class="col-12 col-lg-5">
                <div class="footer-bottom__right">
                    <div class="footer-bottom__socials">
                    <?php
                    foreach ( $socials as $social ) :
                        $link = $social['link'];
                        $icon = $social['icon'];
                        $aria = $social['aria_label'];

                        if ( $link ) :
                            $link_url    = $link['url'];
                            $link_title  = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                        <a class="footer-bottom__social" aria-label="<?php echo $aria; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><span class="footer-bottom__social-icon"><i class="<?php echo $icon; ?>"></i></span></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </div>
                    <div class="footer-bottom__add-links">
                    <?php
                    foreach ( $add_links as $link ) :
                        echo wp_acf_link( $link['link'], 'footer-bottom__add-link' );
                        endforeach;
                    ?>

                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
