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
        'name'                  => _x( $plural, 'Post Type General Name', 'defaultTheme' ),
        'singular_name'         => _x( $singular, 'Post Type Singular Name', 'defaultTheme' ),
        'menu_name'             => __( $menu_name, 'defaultTheme' ),
        'name_admin_bar'        => __( $singular, 'defaultTheme' ),
        'archives'              => __( $singular . ' Archives', 'defaultTheme' ),
        'attributes'            => __( $singular . ' Attributes', 'defaultTheme' ),
        'parent_item_colon'     => __( 'Parent ' . $singular, 'defaultTheme' ),
        'all_items'             => __( 'All ' . $plural, 'defaultTheme' ),
        'add_new_item'          => __( 'Add New ' . $singular, 'defaultTheme' ),
        'add_new'               => __( 'Add New', 'defaultTheme' ),
        'new_item'              => __( 'New ' . $singular, 'defaultTheme' ),
        'edit_item'             => __( 'Edit ' . $singular, 'defaultTheme' ),
        'update_item'           => __( 'Update ' . $singular, 'defaultTheme' ),
        'view_item'             => __( 'View ' . $singular, 'defaultTheme' ),
        'view_items'            => __( 'View ' . $plural, 'defaultTheme' ),
        'search_items'          => __( 'Search ' . $singular, 'defaultTheme' ),
        'not_found'             => __( 'Not found', 'defaultTheme' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'defaultTheme' ),
        'featured_image'        => __( 'Featured Image', 'defaultTheme' ),
        'set_featured_image'    => __( 'Set featured image', 'defaultTheme' ),
        'remove_featured_image' => __( 'Remove featured image', 'defaultTheme' ),
        'use_featured_image'    => __( 'Use as featured image', 'defaultTheme' ),
        'insert_into_item'      => __( 'Insert into ' . strtolower( $singular ), 'defaultTheme' ),
        'uploaded_to_this_item' => __( 'Uploaded to this ' . strtolower( $singular ), 'defaultTheme' ),
        'items_list'            => __( $plural . ' list', 'defaultTheme' ),
        'items_list_navigation' => __( $plural . ' list navigation', 'defaultTheme' ),
        'filter_items_list'     => __( 'Filter ' . strtolower( $plural ) . ' list', 'defaultTheme' ),
    ];
}

// Universal Block.
function universal_block() {
    register_post_type( 'universal_block', [
        'label'           => __( 'Universal Block', 'defaultTheme' ),
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
        'label'               => __( 'Gallery', 'defaultTheme' ),
        'labels'              => get_labels( 'Gallery', 'Galleries' ),
        'supports'            => [ 'title', 'revisions' ],
        'taxonomies'          => [],
        'public'              => true,
        'menu_icon'           => 'dashicons-format-gallery',
        'has_archive'         => false,
    ] );
}
add_action( 'init', 'BaseTheme\PostTypes\gallery' );