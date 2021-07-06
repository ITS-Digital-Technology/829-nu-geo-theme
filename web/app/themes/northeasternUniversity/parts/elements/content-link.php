<?php
$link_title  = isset( $link_title ) ? $link_title : null;
$link_target = isset( $link_target ) ? $link_target : null;
$link_url = isset( $link_url ) ? $link_url : null;
$hyperlink_start = $link_url ? '<a '.$link_target.' href="'.$link_url.'">' : '';
$hyperlink_end = $link_url ? '</a>' : '';
?>

<div class="content-link">
    <?php echo $hyperlink_start; ?>
        <span class="heading content-link__title">
            <?php echo $link_title; ?>
        </span>
        <?php if ( $link_target !== 'target="_self"' ) : ?>
            <span class="content-link__icon"><span class="icon-external-link"></span></span>
        <?php else : ?>
            <span class="content-link__icon"><span class="icon-arrow-right-circle"></span></span>
        <?php endif; ?>
    <?php echo $hyperlink_end; ?>
</div>
