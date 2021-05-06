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
    <select>
        <option value="default">Select Filter Name</option>
        <?php
        foreach ( $terms as $term ) :
            ?>
            <option value="<?php echo $term->term_id; ?>" data-id="<?php echo $term->term_id; ?>" data-tax="<?php echo $taxonomy; ?>"><?php echo $term->name; ?></option>
            <?php
        endforeach;
        ?>
    </select>
</div>
