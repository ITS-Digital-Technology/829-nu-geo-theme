<?php
use Tribe\Events\Filterbar\Views\V2\Filters\Context_Filter;
if (class_exists('Tribe__Events__Filterbar__Filter')):
    class Event_Type extends \Tribe__Events__Filterbar__Filter {
        // Use the trait required for filters to correctly work with Views V2 code.
        use Context_Filter;
    
        public $type = 'checkbox';

        public function get_admin_form() {
            $title = $this->get_title_field();
            $type  = $this->get_multichoice_type_field();

            return $title . $type;
        }
        
        protected function get_values() {
            $terms = array();

            // Load all available event categories
            $source = get_terms( $this->slug, array( 'orderby' => 'name', 'order' => 'ASC' ) );
            if ( empty( $source ) || is_wp_error( $source ) ) {
                return array();
            }

            // Preprocess the terms
            foreach ( $source as $term ) {
                $terms[ (int) $term->term_id ] = $term;
                $term->parent                  = (int) $term->parent;
                $term->depth                   = 0;
                $term->children                = array();
            }

            // Initially copy the source list of terms to our ordered list
            $ordered_terms = $terms;

            // Re-order!
            foreach ( $terms as $id => $term ) {
                // Skip root elements
                if ( 0 === $term->parent ) {
                    continue;
                }

                // Reposition child terms within the ordered terms list
                unset( $ordered_terms[ $id ] );
                $term->depth                             = $this->get_depth( $term );
                $terms[ $term->parent ]->children[ $id ] = $term;
            }

            // Finally flatten out and return
            return $this->flattened_term_list( $ordered_terms );
        }
        
        /**
         * Get Term Depth
         *
         * @since 4.5
         *
         * @param     $term
         * @param int $level
         *
         * @return int
         */
        protected function get_depth( $term, $level = 0 ) {
            if ( ! $term instanceof WP_Term ) {
                return 0;
            }

            if ( 0 == $term->parent ) {
                return $level;
            } else {
                $level++;
                $term = get_term_by( 'id', $term->parent, $this->slug );

                return $this->get_depth( $term, $level );
            }

        }

        /**
         * Flatten out the hierarchical list of event categories into a single list of values,
         * applying formatting (non-breaking spaces) to help indicate the depth of each nested
         * item.
         *
         * @param array $term_items
         * @param array $existing_list
         *
         * @return array
         */
        protected function flattened_term_list( array $term_items, array $existing_list = null ) {
            // Pull in the existing list when called recursively
            $flat_list = is_array( $existing_list ) ? $existing_list : array();

            // Add each item - including nested items - to the flattened list
            foreach ( $term_items as $term ) {

                $has_child = ! empty( $term->children ) ? ' has-child closed' : '';
                $parent_child_cat = '';
                if ( ! $term->parent && $has_child ) {
                    $parent_child_cat = ' parent-' . absint( $term->term_id );
                } elseif ( $term->parent && $has_child ) {
                    $parent_child_cat = ' parent-' . absint( $term->term_id ) . ' child-' . absint( $term->parent );
                } elseif ( $term->parent && ! $has_child ) {
                    $parent_child_cat = ' child-' . absint( $term->parent );
                }

                $flat_list[] = array(
                    'name'  => $term->name,
                    'depth' => $term->depth,
                    'value' => $term->term_id,
                    'data'  => array( 'slug' => $term->slug ),
                    'class' =>
                        esc_html( $this->set_category_class( $term->depth ) ) .
                        'tribe-events-category-' . $term->slug .
                        $parent_child_cat .
                        $has_child,
                );

                if ( ! empty( $term->children ) ) {
                    $child_items = $this->flattened_term_list( $term->children, $existing_list );
                    $flat_list   = array_merge( $flat_list, $child_items );
                }
            }

            return $flat_list;
        }
        
            /**
         * Return class based on dept of the event category
         *
         * @param $depth
         *
         * @return bool|string
         */
        protected function set_category_class( $depth ) {

            $class = 'tribe-parent-cat ';

            if ( 1 == $depth ) {
                $class = 'tribe-child-cat ';
            } elseif ( 1 <= $depth ) {
                $class = 'tribe-grandchild-cat tribe-depth-' . $depth . ' ';
            }

            /**
             * Filter the event category class based on the term depth for the Filter Bar
             *
             * @param string $class class as a string
             * @param int    $depth numeric value of the depth, parent is 0
             */
            $class = apply_filters( 'tribe_events_filter_event_category_display_class', $class, $depth );

            return $class;
        }

        /**
         * This method will only be called when the user has applied the filter (during the
         * tribe_events_pre_get_posts action) and sets up the taxonomy query, respecting any
         * other taxonomy queries that might already have been setup (whether by The Events
         * Calendar, another plugin or some custom code, etc).
         *
         * @see Tribe__Events__Filterbar__Filter::pre_get_posts()
         *
         * @param WP_Query $query
         */
        protected function pre_get_posts( WP_Query $query ) {
            $new_rules      = array();
            $existing_rules = (array) $query->get( 'tax_query' );
            $values         = (array) $this->currentValue;

            // if select display and event category has children get all those ids for query
            if ( 'select' === $this->type ) {

                $categories = get_categories( array(
                    'taxonomy' => 'tribe_events_cat',
                    'child_of' => current( $values ),
                ) );

                if ( ! empty( $categories ) ) {
                    foreach ( $categories as $category ) {
                        $values[] = $category->term_id;
                    }
                }
            } elseif ( 'multiselect' === $this->type ) {
                $values = ! empty( $values[0] ) ? explode( ',', $values[0] ) : $values;
            }

            $new_rules[] = array(
                'taxonomy' => $this->slug,
                'operator' => 'IN',
                'terms'    => array_map( 'absint', $values ),
            );

            /**
             * Controls the relationship between different taxonomy queries.
             *
             * If set to an empty value, then no attempt will be made by the additional field filter
             * to set the meta_query "relation" parameter.
             *
             * @var string $relation "AND"|"OR"
             */
            $relationship = apply_filters( 'tribe_events_filter_taxonomy_relationship', 'AND' );

            /**
             * If taxonomy filter meta queries should be nested and grouped together.
             *
             * The default is true in WordPress 4.1 and greater, which allows for greater flexibility
             * when combined with taxonomy queries added by other filters/other plugins.
             *
             * @var bool $group
             */
            $nest = apply_filters( 'tribe_events_filter_nest_taxonomy_queries', version_compare( $GLOBALS['wp_version'], '4.1', '>=' ) );

            if ( $nest ) {
                $new_rules = array(
                    __CLASS__ => $new_rules,
                );
            }

            $tax_query = array_merge_recursive( $existing_rules, $new_rules );

            // Apply the relationship (we leave this late, or the recursive array merge would potentially cause duplicates)
            if ( ! empty( $relationship ) && $nest ) {
                $tax_query[ __CLASS__ ]['relation'] = $relationship;
            } elseif ( ! empty( $relationship ) ) {
                $tax_query['relation'] = $relationship;
            }

            // Apply our new meta query rules
            $query->set( 'tax_query', $tax_query );
        }        
    }

    function tec_kb_create_filter_type() {
        if ( ! class_exists( 'Tribe__Events__Filterbar__Filter' ) ) {
        return;
        }
        
       new \Event_Type( __( 'Event Type', 'tribe-events-filter-view' ), 'event_type' );
    }

    function tec_kb_filter_map_type( array $map ) {
        if ( ! class_exists( 'Tribe__Events__Filterbar__Filter' ) ) {
        // This would not make much sense, but let's be cautious.
        return $map;
        }
    
        // Add the filter class to our filters map.
        $map['event_type'] = 'Event_Type';
    
        // Return the modified $map.
        return $map;
    }

    function tec_kb_filter_context_locations_type( array $locations ) {
        // Read the filter selected values, if any, from the URL request vars.
        $locations['event_type'] = [
        'read' => [
        \Tribe__Context::REQUEST_VAR => [ 'tribe_event_type' ] ]
        ];
    
        // Return the modified $locations.
        return $locations;
    }
    
    // Make it work in v1.
    add_action( 'tribe_events_filters_create_filters', 'tec_kb_create_filter_type' );
    // Make it work in v2
    add_filter( 'tribe_context_locations', 'tec_kb_filter_context_locations_type'  );
    add_filter( 'tribe_events_filter_bar_context_to_filter_map',  'tec_kb_filter_map_type'  );

endif;
