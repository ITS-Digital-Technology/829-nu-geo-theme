<?php

/**
 * Filter wp_nav_menu args list so that the custom walker is the default one
 * Set the custom walker only if the walker in args is empty to allow
 * the user to specify the walker explicitly, should there be a need for it
 */
add_filter('wp_nav_menu_args', 'ccs_custom_navs_replace_walker');
function ccs_custom_navs_replace_walker( $args ) {
	if( empty($args['walker']) ) {
		global $ccs_custom_nav_menu_walker;
		$args['walker'] = $ccs_custom_nav_menu_walker;
	}

	return $args;
}

/**
 * Custom Walker
 * This is basically Walker_Nav_Menu (default WP menu walker) copied from wp-includes
 * Wordpress defaults are left uncommented
 * All custom code is surrounded by comments for distinction
 */
class CCS_Custom_Nav_Menu_Walker extends Walker {

	public $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;


		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';


		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';


		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/**
		 * BEGIN CUSTOM MENU ITEMS
		 */

		/**
		 * Check if custom menu item post exists
		 */
		$p = null;
		if ( isset( $item->object ) && 'ccs_custom_menu_item' == $item->object ) {
			$p = get_post(intval($item->object_id));
		}

		/**
		 * Custom menu item
		 * If menu item being processed is custom menu item CPT then instead of default <a>
		 * print out the custom menu template file
		 */
		if ( $p && 'ccs_custom_menu_item' == $item->object ) {
			$template_folder = 'custom-menus';
			$template_file = 'template.php';
			$template_path_base = get_template_directory() . '/' . $template_folder . '/';
			$template_saved = get_post_meta($p->ID, '_template', true);

			if ( $template_saved ) {
				$template_file = $template_saved;
			}

			$template_path = $template_path_base . $template_file;

			if ( file_exists($template_path) ) {
				global $post;
				$post = $p;
				setup_postdata($post);

				ob_start();
				include($template_path);
				$template = ob_get_clean();

				wp_reset_postdata();

				$output .= $template;
			} else {
				$output .= '<span>' . $p->post_title . '</span>';
			}
		} else {
			// Contrary to the default value of the paramter, $args is an object.
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		/**
		 * END CUSTOM MENU ITEMS
		 */
	}

	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}

global $ccs_custom_nav_menu_walker;
$ccs_custom_nav_menu_walker = new CCS_Custom_Nav_Menu_Walker();
