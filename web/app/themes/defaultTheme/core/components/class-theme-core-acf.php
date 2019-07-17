<?php
/**
 * ACF Integration
 * ---------------------------------------------------------------------------------------
 *
 * This component adds ACF options pages.
 *
 * @package WordPress
 */

defined( 'ABSPATH' ) or die();

class Theme_Core_ACF extends Theme_Core_Component {

	protected function init() {
		$this->add_acf_pages();
		$this->fix_shortcodes();
	}

	/**
	 * Register the ACF option pages defined in settings file.
	 * This function also checks if the option pages settings are enabled, and that ACF is
	 * installed and enabled in the first place.
	 */
	private function add_acf_pages() {
		if (
			! isset( $this->settings->acf_options ) ||         // There are no ACF settings
			true !== $this->settings->acf_options->init ||     // ACF is disabled in settings
			! function_exists( 'acf_add_options_page' )        // ACF is not installed
		) {
			return;
		}

		// Create options page
		acf_add_options_page( array(
			'page_title' => $this->settings->acf_options->page_title,
			'menu_title' => $this->settings->acf_options->menu_title,
			'menu_slug'  => $this->settings->acf_options->menu_slug,
		) );

		// Create all options subpages
		if ( isset( $this->settings->acf_options->subpages ) ) {
			foreach ( $this->settings->acf_options->subpages as $subpage ) {
				acf_add_options_sub_page( array(
					'page_title'  => $subpage->page_title,
					'menu_title'  => $subpage->menu_title,
					'parent_slug' => $this->settings->acf_options->menu_slug,
				) );
			}
		}
	}

	/**
	 * Add paragraphs to content after parsing shortcodes (WP default is before).
	 * That fixes some shortcode usages, but breaks more complex shortcodes,
	 * so should be enabled / disabled based on theme.
	 */
	private function fix_shortcodes() {
		if ( array_key_exists( 'acf_the_content', $GLOBALS['wp_filter'] ) ) {
			remove_filter( 'acf_the_content', 'shortcode_unautop' );
			remove_filter( 'acf_the_content', 'wpautop' );
			add_filter( 'acf_the_content', 'wpautop', 12 );
		}
	}
}
