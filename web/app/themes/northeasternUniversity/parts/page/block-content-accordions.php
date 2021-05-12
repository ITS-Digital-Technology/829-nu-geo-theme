<?php
$side_content = isset( $side_content ) ? $side_content : get_sub_field( 'side_content' );
$accordions   = isset( $accordions ) ? $accordions : get_sub_field( 'accordions' );
?>
<section class="block-content-accordions"<?php ContentBlock::the_block_id(); ?>>
    <div class="block-content-accordions-wrapper">
        <div class="container">
            <div class="row">
            <?php if ( ! empty( $side_content ) ) : ?>
                <div class="col-12 col-lg-3">
                    <div class="side-content">
                        <?php echo $side_content; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ( ! empty( $accordions ) ) : ?>
                <div class="col-12 col-lg-8 offset-lg-1">
                    <?php
                    $count  = 0;
                    foreach ( $accordions as $accordion ) :
                        $title   = $accordion['title'];
                        $content = $accordion['content'];
                        $count++;
                        $acc_class = 'single-accordion';
                        $acc_style = '';
                        if ( $count === 1 ) {
                            $acc_class .= ' active';
                            $acc_style .= 'style="display:block;"';
                        }
                        ?>
                        <div class="<?php echo $acc_class; ?>">
                            <div class="single-accordion__title">
                                <span class="heading"><?php echo $title; ?><span class="icon-chev-expand"></span></span>
                            </div>
                            <div class="single-accordion__content"<?php echo $acc_style; ?>><?php echo $content; ?></div>
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</section>
