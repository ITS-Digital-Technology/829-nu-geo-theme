<?php

/**
 * Admin Columns
 * ---------------------------------------------------------------------------------------
 *
 * This component modifies the admin panel interface.
 *
 * @package WordPress
 */
class Theme_Core_Admin_Columns extends Theme_Core_Component {

	protected function init() {
		// Add additional column to the posts table
		add_filter( 'manage_posts_columns', array( $this, 'add_id_column' ), 5 );
		add_action( 'manage_posts_custom_column', array( $this, 'output_id_column_content' ), 5, 2 );
		add_filter( 'manage_pages_columns', array( $this, 'add_id_column' ), 5 );
		add_action( 'manage_pages_custom_column', array( $this, 'output_id_column_content' ), 5, 2 );
		add_filter( 'manage_media_columns', array( $this, 'add_media_id_column' ) );
		add_filter( 'manage_media_custom_column', array( $this, 'output_media_id_column' ), 10, 2 );

		// Make it possible to add excerpts to pages
		add_post_type_support( 'page', 'excerpt' );
	}

	/**
	 * Add the header for the ID column for Posts.
	 *
	 * @param array $defaults
	 *
	 * @return array
	 */
	public function add_id_column( $defaults ) {
		$defaults['wps_post_id'] = __( 'ID' );

		return $defaults;
	}

	/**
	 * Print the content of the ID column for Posts.
	 *
	 * @param string $column_name
	 * @param int    $id
	 */
	public function output_id_column_content( $column_name, $id ) {
		if ( $column_name === 'wps_post_id' ) {
			echo $id;
		}
	}

	/**
	 * Add the header for the ID column for Media.
	 *
	 * @param array $columns
	 *
	 * @return array
	 */
	public function add_media_id_column( $columns ) {
		$columns['colID'] = __( 'ID' );

		return $columns;
	}

	/**
	 * Print the content of the ID column for Media.
	 *
	 * @param string $column_name
	 * @param int    $id
	 */
	public function output_media_id_column( $column_name, $id ) {
		if ( $column_name == 'colID' ) {
			echo $id;
		}
	}
}
