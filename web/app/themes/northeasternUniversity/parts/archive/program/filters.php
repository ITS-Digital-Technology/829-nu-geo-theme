<?php
$types           = isset( $_GET['p_types'] ) ? array_map('intval', explode(',', $_GET['p_types'])) : [];
$countries       = isset( $_GET['p_country'] ) ? array_map('intval', explode(',', $_GET['p_country'])) : [];
$terms           = isset( $_GET['p_term'] ) ? array_map('intval', explode(',', $_GET['p_term'])) : [];
$fields_of_study = isset( $_GET['p_field_of_study'] ) ? array_map('intval', explode(',', $_GET['p_field_of_study'])) : [];

$obj = (object) [
    'program_type' =>$types,
    'country' => $countries,
    'term' =>$terms,
    'field_of_study' =>$fields_of_study
];

$JSON =  json_encode($obj);

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
            display_sort = "true"
            display_results = "true"]');
        }
    ?>
</div>