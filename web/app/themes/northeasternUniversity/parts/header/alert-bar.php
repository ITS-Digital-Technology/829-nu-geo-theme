<?php
$show    = isset( $show ) ? $show : false;
$content = isset( $content ) ? $content : false;
$link    = isset( $link ) ? $link : false;
if ( $show && ! empty( $content ) ) :
?>
<div class="alert-bar" id="header-alert-bar">
	<div class="alert-bar__content">
        <p class="alert-bar__text"><?php echo $content; ?></p>
	<?php
	if ( ! empty( $link ) ) {
		echo wp_acf_link( $link , 'alert-bar-link');
	}
	?>
	</div>
	<button class="alert-bar__close" type="button" aria-label="Close Alert"><span class="icon-close"></span></button>
</div>
<script>
    (function setAlertBar() {
        const alertBarClosed = sessionStorage.getItem('alertBarClosed');
        const element = document.getElementById('header-alert-bar');
        if (alertBarClosed == 1) {
            document.body.classList.remove('alert-bar-on');
            element.parentNode.removeChild(element);
        }
    })();
</script>
	<?php
endif;
