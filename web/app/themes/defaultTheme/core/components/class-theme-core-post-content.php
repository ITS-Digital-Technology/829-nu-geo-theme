<?php
/**
 * Post Content
 * ---------------------------------------------------------------------------------------
 *
 * This component modifies how WordPress generates post content.
 *
 * @package WordPress
 */

defined( 'ABSPATH' ) or die();

class Theme_Core_Post_Content extends Theme_Core_Component {

	/**
	 * Add paragraphs to content after parsing shortcodes (WP default is before).
	 * That fixes some shortcode usages, but breaks more complex shortcodes,
	 * so should be enabled / disabled based on theme.
	 */
	protected function init() {
		if ( isset( $this->settings->enable_shortcodes_fix ) && true === $this->settings->enable_shortcodes_fix ) {
			remove_filter( 'the_content', 'shortcode_unautop' );
			remove_filter( 'the_content', 'wpautop' );
			add_filter( 'the_content', 'wpautop', 12 );
		}
	}
}
