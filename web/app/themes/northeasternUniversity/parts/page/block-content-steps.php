<?php
$content   = isset( $content ) ? $content : get_sub_field( 'content' );
$steps     = isset( $steps ) ? $steps : get_sub_field( 'steps' );
$count     = count( $steps );
$class_col = 'content-steps__step-col';
if ( $count === 3 ) {
	$class_col .= ' col-12 col-lg-4';
} else {
	$class_col = ' col-12 col-lg-6';
}

$cta_message = isset( $cta_message ) ? $cta_message : get_sub_field( 'cta_message' );
$cta_button  = isset( $cta_button ) ? $cta_button : get_sub_field( 'cta_button' );
?>

<section class="block-content-steps"<?php ContentBlock::the_block_id(); ?>>
    <div class="block-content-steps-wrapper">
        <div class="container">
            <div class="content-steps">
            <?php if ( ! empty( $content ) ) : ?>
                <div class="content-steps__content">
                    <?php echo $content; ?>
                </div>
            <?php endif; ?>
            <?php if ( ! empty( $steps ) ) : ?>
                <div class="content-steps__steps">
                    <div class="row justify-content-center">
                        <?php
                        foreach ( $steps as $step ) :
                            $number = $step['step_number'];
                            $title  = $step['step_title'];
                            $desc   = $step['description'];
                            $btn    = $step['button'];
                            ?>
                            <div class="<?php echo $class_col; ?>">
                                <div class="content-steps__step">
                                <?php if ( ! empty( $number ) ) : ?>
                                    <p class="content-steps__step-number"><?php echo $number; ?></p>
                                <?php endif; ?>
                                <?php if ( ! empty( $title ) ) : ?>
                                    <p class="content-steps__step-title"><?php echo $title; ?></p>
                                <?php endif; ?>
                                <?php if ( ! empty( $desc ) ) : ?>
                                    <div class="content-steps__step-desc"><?php echo $desc; ?></div>
                                <?php endif; ?>
                                <?php
                                if ( ! empty( $btn ) ) :
                                    $link_url    = $btn['url'];
                                    $link_title  = $btn['title'];
                                    $link_target = $btn['target'] ? $btn['target'] : '_self';
                                    ?>
                                    <a class="content-steps__step-btn c-btn c-btn-tertiary c-btn-color-alt" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><span><?php echo esc_html( $link_title ); ?></span><span class="c-btn-icon"><i class="icon-arrow-right-circle"></i></span></a>
                                <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ( ! empty( $cta_message ) || ! empty( $cta_button ) ) : ?>
                <div class="content-steps__cta">
                <?php if ( ! empty( $cta_message ) ) : ?>
                    <p class="content-steps__cta-title"><?php echo $cta_message; ?></p>
                <?php endif; ?>
                <?php
                if ( ! empty( $cta_button ) ) :
                        $link_url    = $cta_button['url'];
                        $link_title  = $cta_button['title'];
                        $link_target = $cta_button['target'] ? $cta_button['target'] : '_self';
                    ?>
                    <a class="c-btn c-btn-tertiary c-btn-color-alt" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><span><?php echo esc_html( $link_title ); ?></span><span class="c-btn-icon"><i class="icon-arrow-right-circle"></i></span></a>
                <?php endif; ?>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</section>
