<?php
/**
 * Theme Scripts and Styles
 * ---------------------------------------------------------------------------------------
 *
 * This component enqueues all the scripts and styles used by the theme.
 *
 * @package WordPress
 */

defined( 'ABSPATH' ) or die();

class Theme_Core_Scripts extends Theme_Core_Component {

	/**
	 * Enqueue all scripts and styles registered in settings.
	 */
	protected function init() {
		add_action( 'wp_enqueue_scripts', function () {
			$this->enqueue_built_in_scripts();
			$this->enqueue_theme_scripts();
			$this->enqueue_theme_styles();
		} );

		$this->localize_script();
	}

	/**
	 * Enqueue the scripts build into WordPress Core. By default the function includes
	 * just jQuery and script handling comment replies, but it also handles additional
	 * scripts that can be defined in the theme configuration file.
	 */
	protected function enqueue_built_in_scripts() {
		wp_enqueue_script( 'jquery' );

		if ( is_singular() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		$additional_scripts = $this->settings->enqueue_built_in_scripts;
		if ( ! is_array( $additional_scripts ) || empty( $additional_scripts ) ) {
			return;
		}

		foreach ( $additional_scripts as $script ) {
			wp_enqueue_script( $script );
		}
	}

	/**
	 * Enqueue scripts defined by the developer in theme settings file.
	 */
	protected function enqueue_theme_scripts() {
		if ( ! $this->settings ) {
			return;
		}

		if ( false === $this->settings->enqueue_scripts ) {
			return;
		}

		foreach ( $this->settings->enqueue_scripts as $handle => $script ) {
			$params = array(
				'src'          => '',
				'dependencies' => array(),
				'version'      => false,
				'in_footer'    => true,
			);

			if ( is_object( $script ) ) {
				$params = wp_parse_args( (array) $script, $params );
			} else {
				$params['src'] = $script;
			}

			if ( empty( $params['src'] ) ) {
				continue;
			}

			wp_enqueue_script(
				$handle,
				$this->get_script_url( $params['src'] ),
				$params['dependencies'],
				$params['version'],
				$params['in_footer']
			);
		}
	}

	/**
	 * Enqueue styles defined by the user in theme settings file.
	 */
	protected function enqueue_theme_styles() {
		if ( ! $this->settings ) {
			return;
		}

		if ( false === $this->settings->enqueue_styles ) {
			return;
		}

		foreach ( $this->settings->enqueue_styles as $handle => $style ) {
			$params = array(
				'src'          => '',
				'dependencies' => array(),
				'version'      => false,
				'media'        => 'all',
			);

			if ( is_object( $style ) ) {
				$params = wp_parse_args( (array) $style, $params );
			} else {
				$params['src'] = $style;
			}

			if ( empty( $params['src'] ) ) {
				continue;
			}

			wp_enqueue_style(
				$handle,
				$this->get_script_url( $params['src'] ),
				$params['dependencies'],
				$params['version'],
				$params['media']
			);
		}
	}

	/**
	 * Pass basic information about the theme and WP installation to the JS.
	 */
	protected function localize_script() {
		JS::add( array(
			'siteUrl'       => home_url(),
			'templateUrl'   => get_template_directory_uri(),
			'stylesheetUrl' => get_stylesheet_directory_uri(),
			'ajaxUrl'       => site_url() . '/wp-admin/admin-ajax.php',
		) );

		add_action( 'wp_enqueue_scripts', function () {
			JS::localize( 'WP' );
		}, 99 );
	}

	/*
	 * Helpers
	 * ---------------------------------------------------------------------------------------
	 */

	/**
	 * Convert the script source provided into full URL. If the source is already a full
	 * URL, it will not be modified. Otherwise the source will be added to the theme
	 * URL (script is relative to the theme root).
	 *
	 * @param string $src Script source to convert.
	 *
	 * @return string Full URL to the script.
	 */
	protected function get_script_url( $src ) {
		if ( preg_match( '@\/\/@', $src ) ) {
			return $src;
		}

		return get_template_directory_uri() . '/' . $src;
	}
}
