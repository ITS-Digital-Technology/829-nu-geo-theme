<?php
/**
 * Thumbnails
 * ---------------------------------------------------------------------------------------
 *
 * This component the thumbnail support and functionalities related to
 * the image sizes.
 *
 * @package WordPress
 */

defined( 'ABSPATH' ) or die();

class Theme_Core_Thumbnails extends Theme_Core_Component {

	/**
	 * Add support for thumbnails and register all images sizes
	 * added in the settings file.
	 */
	protected function init() {
		if ( ! function_exists( 'add_theme_support' ) ) {
			return;
		}

		add_theme_support( 'post-thumbnails' );

		if ( isset( $this->settings->thumbnails ) ) {
			foreach ( $this->settings->thumbnails as $thumb_params ) {
				add_image_size(
					$thumb_params[0],
					$thumb_params[1],
					$thumb_params[2],
					$thumb_params[3]
				);
			}
		}
	}
}
