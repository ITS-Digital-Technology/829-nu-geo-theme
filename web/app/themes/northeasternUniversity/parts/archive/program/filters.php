<?php
$types           = isset( $_GET['p_program_type'] ) ? array_map('intval', explode(',', $_GET['p_program_type'])) : [];
$countries       = isset( $_GET['p_country'] ) ? array_map('intval', explode(',', $_GET['p_country'])) : [];
$terms           = isset( $_GET['p_term'] ) ? array_map('intval', explode(',', $_GET['p_term'])) : [];
$fields_of_study = isset( $_GET['p_field_of_study'] ) ? array_map('intval', explode(',', $_GET['p_field_of_study'])) : [];
$program_tracks = isset( $_GET['p_program_track'] ) ? array_map('intval', explode(',', $_GET['p_program_track'])) : [];
$cities = isset( $_GET['p_city'] ) ? array_map('intval', explode(',', $_GET['p_city'])) : [];
$regions = isset( $_GET['p_region'] ) ? array_map('intval', explode(',', $_GET['p_region'])) : [];
$class_types = isset( $_GET['p_class_type'] ) ? array_map('intval', explode(',', $_GET['p_class_type'])) : [];


$obj = (object) [
    'program_type' => $types,
    'country' => $countries,
    'term' => $terms,
    'field_of_study' => $fields_of_study,
    'program_track' => $program_tracks,
    'city' => $cities,
    'region' => $regions,
    'class_type' => $class_types,
];

$JSON =  json_encode($obj);

//TODO - work with any query string
// $selections = [];
// $query_string = $_SERVER['QUERY_STRING'];
// $queries = explode('&', $query_string);

$preselect = get_post_type() === 'program' ? "data-pre-select='$JSON'" : null;
?>
<div class="posts-list" <?php echo $preselect;?>>
    <?php
        if ( class_exists('eight29_filters') && !is_search() ) {
            echo do_shortcode('[eight29_filters
            post_type="program"
            posts_per_page="12"
            posts_per_row="3"
            display_search="true"
            pagination_style="pagination"
            order_by="abc"
            display_sort = "true"
            display_results = "true"]');
        }
    ?>
</div>