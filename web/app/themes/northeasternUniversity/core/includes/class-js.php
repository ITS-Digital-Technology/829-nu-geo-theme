<?php

class JS {

	/**
	 * Data to be passed to JS.
	 *
	 * @var array
	 */
	private $data = [];

	/**
	 * Script name to localize the data to.
	 *
	 * @var string
	 */
	private $script_name = 'script';

	/**
	 * Singleton of this class.
	 *
	 * @var JS
	 */
	private static $_instance;

	/**
	 * Retrieve singleton of this class, or create one if it doesn't exist yet.
	 *
	 * @return JS
	 */
	public static function get_instance() {
		if ( self::$_instance ) {
			return self::$_instance;
		}

		self::$_instance = new self();

		return self::$_instance;
	}

	private function __construct() {
	}

	/**
	 * Add more data to be passed to JS.
	 * The function accepts a key and value, or an associative array of values.
	 *
	 * @param string|array $key   Key of the new value, or array of data.
	 * @param string       $value New value.
	 */
	public static function add( $key, $value = null ) {
		$js = self::get_instance();

		if ( is_array( $key ) ) {
			$js->data = array_merge( $js->data, $key );
		} elseif ( $value !== null ) {
			$js->data[ $key ] = $value;
		}
	}

	/**
	 * Set the name of the script that should receive the data.
	 *
	 * @param string $name Script name.
	 */
	public static function set_script( $name ) {
		$js              = self::get_instance();
		$js->script_name = $name;
	}

	/**
	 * Pass all the data to the JS file.
	 *
	 * @param string $name Name of the object that the JS file should receive.
	 */
	public static function localize( $name ) {
		$js = self::get_instance();
		wp_localize_script( $js->script_name, $name, $js->data );
	}
}
