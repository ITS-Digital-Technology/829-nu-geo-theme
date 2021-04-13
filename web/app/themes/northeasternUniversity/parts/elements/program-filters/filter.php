<?php
$program_types   = isset( $program_types ) ? $program_types : [];
$countries       = isset( $countries ) ? $countries : [];
$terms           = isset( $terms ) ? $terms : [];
$fields_of_study = isset( $fields_of_study ) ? $fields_of_study : [];
$taxonomy        = isset( $taxonomy ) ? $taxonomy : null;
$label           = isset( $label ) ? $label : null;
$current_label   = isset($current_label) ? $current_label : null;
$terms           = get_terms(
	[
		'taxonomy'   => $taxonomy,
		'hide_empty' => false,
	]
);

$current_label_id = (str_replace(' ', '-', strtolower($current_label)));
?>

<div id="filter-<?php echo $taxonomy; ?>" class="program-filters__filter">
	<span class="program-filters__filter-label"><?php echo $label; ?></span>
    <button class="program-filters__filter-trigger <?php echo $taxonomy;?>"><?php echo $current_label;?></button>
    <div class="program-filters__filter-list-wrapper" aria-label="<?php  __( 'Dropdown option listing', 'sr-description' ); ?>" data-simplebar data-simplebar-auto-hide="false">
        <ul class="program-filters__filter-list">
            <li class="program-filters__filter-list-item select-all">
                <input type="checkbox" id="<?php echo $current_label_id;?>" data-id="all" data-tax="<?php echo $taxonomy;?>">
                <label class="program-filters__filter-term" for="<?php echo $current_label_id;?>" >All</label>
            </li>
        <?php
        foreach ( $terms as $term ) :
            ?>
            <li class="program-filters__filter-list-item">
                <input type="checkbox" id="<?php echo $term->term_id; ?>" data-id="<?php echo $term->term_id; ?>" data-tax="<?php echo $taxonomy; ?>">
                <label class="program-filters__filter-term" for="<?php echo $term->term_id; ?>" ><?php echo $term->name; ?></label>
            </li>
            <?php
        endforeach;
        ?>
        </ul>
    </div>
	</button>
</div>
