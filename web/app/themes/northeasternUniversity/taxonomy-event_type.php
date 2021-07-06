<?php
/**
 * The event type taxonomy 
 * @package    WordPress
 * @subpackage northeasternUniversity
 * @since      northeasternUniversity 1.0
 */

$term_id = $wp_query->queried_object->term_id;
$param =  "?tribe_event_type[0]=$term_id" . "&is_term=true";

header( 'Location: ' . tribe_get_listview_link() . $param ); 
