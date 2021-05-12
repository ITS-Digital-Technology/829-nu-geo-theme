<?php
$link_title  = isset( $link_title ) ? $link_title : null;
$link_target = isset( $link_target ) ? $link_target : null;
?>
<div class="content-link">
	<span class="heading content-link__title">
		<?php echo $link_title; ?>
	</span>
    <?php if ( $link_target ) : ?>
        <span class="content-link__icon"><span class="icon-external-link"></span></span>
    <?php else : ?>
        <span class="content-link__icon"><span class="icon-arrow-right-circle"></span></span>
    <?php endif; ?>
</div>
