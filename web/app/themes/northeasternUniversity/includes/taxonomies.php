<?php
/**
 * Register theme taxonomies
 *
 * Please follow the same format for registering new taxonomies.
 *
 * Reference: https://developer.wordpress.org/reference/functions/register_taxonomy/
 */

 namespace BaseTheme\Taxonomies;

 /**
  * Get taxonomy labels
  *
  * @param  string $singular  Singular name for the taxonomy.
  * @param  string $plural    Plural name for the taxonomy.
  * @param  string $menu_name Name the taxonomy will appear as in the admin sidebar.
  * @return array             Lables for registering a taxonomy.
  */
function get_labels( string $singular, string $plural = '', string $menu_name = '' ) : array {
	if ( empty( $plural ) ) {
		$plural = $singular . 's';
	}

	if ( empty( $menu_name ) ) {
		$menu_name = $plural;
	}

	return [
		'name'                       => _x( $plural, 'Taxonomy General Name', 'northeasternUniversity' ),
		'singular_name'              => _x( $singular, 'Taxonomy Singular Name', 'northeasternUniversity' ),
		'menu_name'                  => __( $menu_name, 'northeasternUniversity' ),
		'all_items'                  => __( 'All ' . $plural, 'northeasternUniversity' ),
		'parent_item'                => __( 'Parent ' . $singular, 'northeasternUniversity' ),
		'parent_item_colon'          => __( 'Parent ' . $singular . ':', 'northeasternUniversity' ),
		'new_item_name'              => __( 'New ' . $singular . ' Name', 'northeasternUniversity' ),
		'add_new_item'               => __( 'Add New ' . $singular, 'northeasternUniversity' ),
		'edit_item'                  => __( 'Edit ' . $singular, 'northeasternUniversity' ),
		'update_item'                => __( 'Update ' . $singular, 'northeasternUniversity' ),
		'view_item'                  => __( 'View ' . $singular, 'northeasternUniversity' ),
		'separate_items_with_commas' => __( 'Separate ' . strtolower( $plural ) . ' with commas', 'northeasternUniversity' ),
		'add_or_remove_items'        => __( 'Add or remove ' . strtolower( $plural ), 'northeasternUniversity' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'northeasternUniversity' ),
		'popular_items'              => __( 'Popular ' . $plural, 'northeasternUniversity' ),
		'search_items'               => __( 'Search ' . $plural, 'northeasternUniversity' ),
		'not_found'                  => __( 'Not Found', 'northeasternUniversity' ),
		'no_terms'                   => __( 'No ' . strtolower( $plural ), 'northeasternUniversity' ),
		'items_list'                 => __( $plural . ' list', 'northeasternUniversity' ),
		'items_list_navigation'      => __( $plural . ' list navigation', 'northeasternUniversity' ),
	];
}

// Type
// function type() {
// $args = array(
// 'labels'                     => get_labels( 'Type' ),
// 'hierarchical'               => false,
// 'public'                     => true,
// 'show_ui'                    => true,
// 'show_admin_column'          => true,
// );

// register_taxonomy( 'type', array( 'post', 'gallery' ), $args );
// }
// add_action( 'init', 'BaseTheme\Taxonomies\type' );


//PROGRAM

// Program Type
function program_type() {
	$args = array(
		'labels'            => get_labels( 'Program Type' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'program-type', 'with_front' => false )
	);

	register_taxonomy( 'program_type', array( 'program' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\program_type' );


// Country
function country() {
	$args = array(
		'labels'            => get_labels( 'Country', 'Countries' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
        'show_in_rest'      => true,
	);

	register_taxonomy( 'country', array( 'program' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\country' );


// Term
function term() {
	$args = array(
		'labels'            => get_labels( 'Term' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
	);

	register_taxonomy( 'term', array( 'program' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\term' );


// Field of Study
function field_of_study() {
	$args = array(
		'labels'            => get_labels( 'Field of Study', 'Fields of Study' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'fields-of-study', 'with_front' => false )
	);

	register_taxonomy( 'field_of_study', array( 'program' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\field_of_study' );


// Program Track
function program_track() {
	$args = array(
		'labels'            => get_labels( 'Program Track' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'program-track', 'with_front' => false )
	);

	register_taxonomy( 'program_track', array( 'program' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\program_track' );

// Program City
function city() {
	$args = array(
		'labels'            => get_labels( 'City', 'Cities' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
        'show_in_rest'      => true,
	);

	register_taxonomy( 'city', array( 'program' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\city' );

// region
function region() {
	$args = array(
		'labels'            => get_labels( 'Region' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
	);

	register_taxonomy( 'region', array( 'program' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\region' );


// class type
function class_type() {
	$args = array(
		'labels'            => get_labels( 'Class Type' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'class-type', 'with_front' => false )
	);

	register_taxonomy( 'class_type', array( 'program' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\class_type' );

// NEWS
//news_category
function news_category() {
	$args = array(
		'labels'            => get_labels( 'News Category', 'News Categories' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'news-category', 'with_front' => false )
	);

	register_taxonomy( 'news_category', array( 'news' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\news_category' );



function news_tag() {
	$args = array(
		'labels'            => get_labels( 'News Tag', 'News Tags' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'news-tag', 'with_front' => false )
	);

	register_taxonomy( 'news_tag', array( 'news' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\news_tag' );

// events
function event_program_type() {
	$args = array(
		'labels'            => get_labels( 'Event Program Type', 'Event Program Types' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
	);

	register_taxonomy( 'event_program_type', array( 'tribe_events' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\event_program_type' );

function event_type() {
	$args = array(
		'labels'            => get_labels( 'Event Type', 'Event Types' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
	);

	register_taxonomy( 'event_type', array( 'tribe_events' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\event_type' );


//POST
//post_content_types
function post_content_type() {
	$args = array(
		'labels'            => get_labels( 'Content Type' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'content-type', 'with_front' => false )
	);

	register_taxonomy( 'post_content_type', array( 'post' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\post_content_type' );

// post_topic
function post_topic() {
	$args = array(
		'labels'            => get_labels( 'Topic' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'topic', 'with_front' => false )
	);

	register_taxonomy( 'post_topic', array( 'post' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\post_topic' );

//post_programs
function post_program() {
	$args = array(
		'labels'            => get_labels( 'Program' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'program', 'with_front' => false )
	);

	register_taxonomy( 'post_program', array( 'post' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\post_program' );

//post_destination
function post_destination() {
	$args = array(
		'labels'            => get_labels( 'Destination' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'destination', 'with_front' => false )
	);

	register_taxonomy( 'post_destination', array( 'post' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\post_destination' );


//STAFF
function staff_category() {
	$args = array(
		'labels'            => get_labels( 'Category', 'Categories' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'staff-category', 'with_front' => false )
	);

	register_taxonomy( 'staff_category', array( 'staff' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\staff_category' );
