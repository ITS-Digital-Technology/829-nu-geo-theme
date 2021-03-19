<?php

$blog_newsletter = get_field('blog_newsletter', 'options');

if( $blog_newsletter ): 
    $left_content = $blog_newsletter['left_content'];
    $right_content = $blog_newsletter['right_content'];
    $button = $blog_newsletter['button'];
?>
<div class="container">
    <div class="newsletter-post">
        <div class="newsletter-post__left">
            <?php if ( !empty($left_content) ) : ?>
                <?= $left_content; ?>
            <?php endif; ?>
        </div>

        <div class="newsletter-post__right">
            <div class="newsletter-post__right-content">
            <?php if ( !empty($right_content) ) : ?>
                <?= $right_content; ?>
            <?php endif; ?>
            </div>
            <div class="c-btn-wrapper">
                <?php if(!empty($button)) :
                    $link_url    = $button['url'];
                    $link_title  = $button['title'];
                    $link_target = $button['target'] ? $button['target'] : '_self';
                    ?>
                    <a class="c-btn c-btn-primary c-btn-color-normal" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                        <?php echo esc_html( $link_title ); ?>
                    </a>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<?php endif;

