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
		'name'                       => _x( $plural, 'Taxonomy General Name', 'defaultTheme' ),
		'singular_name'              => _x( $singular, 'Taxonomy Singular Name', 'defaultTheme' ),
		'menu_name'                  => __( $menu_name, 'defaultTheme' ),
		'all_items'                  => __( 'All ' . $plural, 'defaultTheme' ),
		'parent_item'                => __( 'Parent ' . $singular, 'defaultTheme' ),
		'parent_item_colon'          => __( 'Parent ' . $singular . ':', 'defaultTheme' ),
		'new_item_name'              => __( 'New ' . $singular . ' Name', 'defaultTheme' ),
		'add_new_item'               => __( 'Add New ' . $singular, 'defaultTheme' ),
		'edit_item'                  => __( 'Edit ' . $singular, 'defaultTheme' ),
		'update_item'                => __( 'Update ' . $singular, 'defaultTheme' ),
		'view_item'                  => __( 'View ' . $singular, 'defaultTheme' ),
		'separate_items_with_commas' => __( 'Separate ' . strtolower( $plural ) . ' with commas', 'defaultTheme' ),
		'add_or_remove_items'        => __( 'Add or remove ' . strtolower( $plural ), 'defaultTheme' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'defaultTheme' ),
		'popular_items'              => __( 'Popular ' . $plural, 'defaultTheme' ),
		'search_items'               => __( 'Search ' . $plural, 'defaultTheme' ),
		'not_found'                  => __( 'Not Found', 'defaultTheme' ),
		'no_terms'                   => __( 'No ' . strtolower( $plural ), 'defaultTheme' ),
		'items_list'                 => __( $plural . ' list', 'defaultTheme' ),
		'items_list_navigation'      => __( $plural . ' list navigation', 'defaultTheme' ),
    ];
}

// Type
// function type() {
//     $args = array(
//         'labels'                     => get_labels( 'Type' ),
// 		'hierarchical'               => false,
// 		'public'                     => true,
// 		'show_ui'                    => true,
// 		'show_admin_column'          => true,
//     );
    
// 	register_taxonomy( 'type', array( 'post', 'gallery' ), $args );
// }
// add_action( 'init', 'BaseTheme\Taxonomies\type' );
