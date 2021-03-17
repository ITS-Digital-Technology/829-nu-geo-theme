<?php
$links = get_sub_field('links');
if (!empty($links)) :
?>
<div class="mm-link-wrapper">
<?php
foreach ($links as $single) :
    $image = $single['image'];
    $link = $single['link'];

    if ( ! empty( $link ) ) :
        $link_url    = $link['url'];
        $link_title  = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
?>
    <a class="mm-link <?php echo !empty($image) ? 'mm-link--has-image' : ''; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
    <?php if (!empty($image)) : ?>
        <figure class="mm-link__image">
            <?php echo f_img($image, 'mega-menu-link-image'); ?>
        </figure>
    <?php endif; ?>
        <div class="mm-link__text">
            <span><?php echo esc_html( $link_title ); ?></span><span class="c-btn-icon"><i class="icon-arrow-right-circle"></i></span>
        </div>
    </a>
<?php
    endif;
endforeach;
?>
</div>
<?php
endif;