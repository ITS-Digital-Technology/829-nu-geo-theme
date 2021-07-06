<?php
add_action( 'admin_head', 'hide_oembed_video' );
function hide_oembed_video() {
	if ( is_admin() ) {
		?>
	<style type="text/css">
		.acf-field-oembed .acf-oembed .canvas {
		display:none!important;
		}
	</style>
		<?php
	}
}
