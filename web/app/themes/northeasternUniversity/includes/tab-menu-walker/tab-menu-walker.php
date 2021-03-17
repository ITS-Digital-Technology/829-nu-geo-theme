<?php

/**
 * Create HTML list of nav menu items.
 * Replacement for the native Walker, using the custom image field.
 *
 */
class Tab_Menu_Walker extends Walker_Nav_Menu
{
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array|object $args    Additional strings. Actually always an 
                                     instance of stdClass. But this is WordPress.
     * @return void
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
        $output .= "<li id='menu-item-$item->ID' class='topbar__menu-item tmi subnav-tabs__link'>";
        $item_id = $item->ID;
        $attributes  = '';

        $image_field = get_field('menu_item_image', $item_id);
        $image = '';

        if (!empty($image_field)) {
            $image = "<figure class='tmi__image'>" . f_img($image_field, 'testimonial-img') . "</figure>";
        }

        ! empty( $item->attr_title )
            and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        ! empty( $item->target )
            and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        ! empty( $item->xfn )
            and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        ! empty( $item->url )
            and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

        // insert description for top level elements only
        // you may change this
        $description = ( ! empty ( $item->description ) and 0 == $depth )
            ? '<p class="menu-item__description">' . esc_attr( $item->description ) . '</p>' : '';

        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $item_output = $args->before
            . "<a $attributes>"
            . $args->link_before
            . $image
            . "<span class='tmi__text'>$title</span>"
            . $description
            . '</a> '
            . $args->link_after
            . $args->after;

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
        ,   $item_output
        ,   $item
        ,   $depth
        ,   $args
        );
    }
}