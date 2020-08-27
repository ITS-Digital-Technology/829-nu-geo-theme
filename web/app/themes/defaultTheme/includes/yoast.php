<?php

// Move Yoast SEO to the bottom of the screen.
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');
