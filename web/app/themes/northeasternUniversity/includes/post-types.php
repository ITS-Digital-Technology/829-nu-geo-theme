<?php
/**
 * Register theme post types
 *
 * Post types should always support revisions.
 * Please follow the same format for registering new post types.
 *
 * Reference: https://developer.wordpress.org/reference/functions/register_post_type/
 * Dashicons for menu_icon: https://developer.wordpress.org/resource/dashicons/
 */

 namespace BaseTheme\PostTypes;

 /**
  * Get post type labels
  *
  * @param  string $singular  Singular name for the post type.
  * @param  string $plural    Plural name for the post type.
  * @param  string $menu_name Name the post type will appear as in the admin sidebar.
  * @return array             Lables for registering a post type.
  */
function get_labels( string $singular, string $plural = '', string $menu_name = '' ) : array {
    if ( empty( $plural ) ) {
        $plural = $singular . 's';
    }

    if ( empty( $menu_name ) ) {
        $menu_name = $plural;
    }

    return [
        'name'                  => _x( $plural, 'Post Type General Name', 'northeasternUniversity' ),
        'singular_name'         => _x( $singular, 'Post Type Singular Name', 'northeasternUniversity' ),
        'menu_name'             => __( $menu_name, 'northeasternUniversity' ),
        'name_admin_bar'        => __( $singular, 'northeasternUniversity' ),
        'archives'              => __( $singular . ' Archives', 'northeasternUniversity' ),
        'attributes'            => __( $singular . ' Attributes', 'northeasternUniversity' ),
        'parent_item_colon'     => __( 'Parent ' . $singular, 'northeasternUniversity' ),
        'all_items'             => __( 'All ' . $plural, 'northeasternUniversity' ),
        'add_new_item'          => __( 'Add New ' . $singular, 'northeasternUniversity' ),
        'add_new'               => __( 'Add New', 'northeasternUniversity' ),
        'new_item'              => __( 'New ' . $singular, 'northeasternUniversity' ),
        'edit_item'             => __( 'Edit ' . $singular, 'northeasternUniversity' ),
        'update_item'           => __( 'Update ' . $singular, 'northeasternUniversity' ),
        'view_item'             => __( 'View ' . $singular, 'northeasternUniversity' ),
        'view_items'            => __( 'View ' . $plural, 'northeasternUniversity' ),
        'search_items'          => __( 'Search ' . $singular, 'northeasternUniversity' ),
        'not_found'             => __( 'Not found', 'northeasternUniversity' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'northeasternUniversity' ),
        'featured_image'        => __( 'Featured Image', 'northeasternUniversity' ),
        'set_featured_image'    => __( 'Set featured image', 'northeasternUniversity' ),
        'remove_featured_image' => __( 'Remove featured image', 'northeasternUniversity' ),
        'use_featured_image'    => __( 'Use as featured image', 'northeasternUniversity' ),
        'insert_into_item'      => __( 'Insert into ' . strtolower( $singular ), 'northeasternUniversity' ),
        'uploaded_to_this_item' => __( 'Uploaded to this ' . strtolower( $singular ), 'northeasternUniversity' ),
        'items_list'            => __( $plural . ' list', 'northeasternUniversity' ),
        'items_list_navigation' => __( $plural . ' list navigation', 'northeasternUniversity' ),
        'filter_items_list'     => __( 'Filter ' . strtolower( $plural ) . ' list', 'northeasternUniversity' ),
    ];
}

// Universal Block.
function universal_block() {
    register_post_type( 'universal_block', [
        'label'           => __( 'Universal Block', 'northeasternUniversity' ),
        'labels'          => get_labels( 'Universal Block' ),
        'supports'        => [ 'title', 'revisions' ],
        'taxonomies'      => [],
        'public'          => true,
        'menu_icon'       => 'dashicons-editor-kitchensink',
        'has_archive'     => false,
    ] );
}
add_action( 'init', 'BaseTheme\PostTypes\universal_block' );

// Gallery.
function gallery() {
    register_post_type ( 'gallery', [
        'label'               => __( 'Gallery', 'northeasternUniversity' ),
        'labels'              => get_labels( 'Gallery', 'Galleries' ),
        'supports'            => [ 'title', 'revisions' ],
        'taxonomies'          => [],
        'publicly_queryable'  => false,
        'public'              => false,
        'menu_icon'           => 'dashicons-format-gallery',
        'has_archive'         => false,
    ] );
}
add_action( 'init', 'BaseTheme\PostTypes\gallery' );


// Programs.
function programs() {
    register_post_type ( 'program', [
        'label'               => __( 'Program', 'northeasternUniversity' ),
        'labels'              => get_labels( 'Program', 'Programs' ),
        'supports'            => [ 'title','thumbnail'],
        'taxonomies'          => [],
        'public'             => true,
        'publicly_queryable' => true,
        'hierarchical'        => false,
        'menu_icon'           => 'dashicons-clipboard',
        'has_archive'         => true,
        'show_in_rest'        => true,
        'show_ui'             => true,
        'rewrite'             => array( 'slug' => 'browse-programs', 'with_front' => false )
    ] );

    remove_rewrite_tag( '%program%' );
}
add_action( 'init', 'BaseTheme\PostTypes\programs' );

// News.
function news() {
    register_post_type ( 'news', [
        'label'               => __( 'News', 'northeasternUniversity' ),
        'labels'              => get_labels( 'News', 'News' ),
        'supports'            => [ 'title','editor','thumbnail', 'page-attributes', 'excerpt' ],
        'taxonomies'          => [],
        'public'             => true,
        'publicly_queryable' => true,
        'hierarchical'        => false,
        'menu_icon'           => 'dashicons-media-text',
        'has_archive'         => true,
        'show_in_rest'        => true,
        'show_ui'             => true,
        'rewrite'             => array( 'slug' => 'news', 'with_front' => false )
    ] );
}
add_action( 'init', 'BaseTheme\PostTypes\news' );

// Staff.
function staff() {
    register_post_type ( 'staff', [
        'label'               => __( 'Staff', 'northeasternUniversity' ),
        'labels'              => get_labels( 'Staff', 'Staff' ),
        'supports'            => [ 'title', 'editor','revisions' ,'thumbnail', 'page-attributes', 'excerpt' ],
        'taxonomies'          => [],
        'public'             => true,
        'publicly_queryable' => true,
        'hierarchical'        => false,
        'menu_icon'           => 'dashicons-admin-users',
        'has_archive'         => true,
        'show_in_rest'        => true,
        'show_ui'             => true,
        'rewrite'             => array( 'slug' => 'staff', 'with_front' => false )
    ] );
}
add_action( 'init', 'BaseTheme\PostTypes\staff' );