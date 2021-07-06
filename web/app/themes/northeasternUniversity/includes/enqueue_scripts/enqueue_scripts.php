<?php
function loadScripts() {
	$scriptFile = get_template_directory_uri() . '/js/bundle.js';

	wp_enqueue_script( 'script', $scriptFile, [], false, true );
}

add_action( 'wp_enqueue_scripts', 'loadScripts' );

add_action( 'admin_head', 'get_theme_url' );
function get_theme_url() {
	if ( is_admin() ) {
		?>
	<script type="text/javascript">
		const stylesheetDirectoryUri = '<?php echo get_stylesheet_directory_uri(); ?>';
	</script>
		<?php
	}
}
