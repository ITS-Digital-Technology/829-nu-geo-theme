<?php
add_action( 'gform_field_appearance_settings', 'northeasternUniversity_add_input', 10, 2);

function northeasternUniversity_add_input( $position, $form_id ) {
	if ( $position == 500 ) {
		?>
		<li class="bootstrap_column_setting field_setting">
			<label for="bootstrap_column_range" class="section_label">
				<?php _e( 'Column Width', 'northeasternUniversity' ); ?>
                <?php gform_tooltip('bootstrap_column_range'); ?>
			</label>
			<input type="range" id="bootstrap_column_range" name="bootstrap_column_range" min="1" max="12" step="1" value="1" onchange="SetFieldProperty('columnWidth', this.value);" oninput="jQuery(this).next().val(this.value);"/>
            <input type="number" id="bootstrap_column_input" name="bootstrap_column_input" min="1" max="12" value="1" onchange="SetFieldProperty('columnWidth', this.value);" oninput="jQuery(this).prev().val(this.value);" />
		</li>
		<?php
	}
}

add_filter( 'gform_tooltips', 'northeasternUniversity_add_tooltip' );

function northeasternUniversity_add_tooltip( $tooltips ) {
	$tooltips['bootstrap_column_range'] = __('<h6>Column Width</h6>Set column width (1-12)', 'banner-day-camp');
	return $tooltips;
}

add_action( 'gform_editor_js', 'northeasternUniversity_add_input_js' );

function northeasternUniversity_add_input_js() {
	?>
	<script type="text/javascript">

        const objectKeys = Object.keys(fieldSettings);

        objectKeys.forEach(key => {
            fieldSettings[key] += ', .bootstrap_column_setting';
        });

		jQuery(document).on("gform_load_field_settings", function(event, field, form) {

            const range = jQuery("#bootstrap_column_range");
            const input = jQuery("#bootstrap_column_input");

            if (typeof(field["columnWidth"]) != "undefined" ) {
	        	range.val(field["columnWidth"]);
	        	input.val(field["columnWidth"]);
            } else {
	        	range.val(12);
	        	input.val(12);
            }

	    	});
	</script>
	<?php
}

add_filter( 'gform_field_css_class', 'add_custom_class', 10, 3 );

function add_custom_class( $classes, $field, $form ) {

    $classes .= ' col-12';

    if ( !empty( $field['columnWidth'] ) ) {
        $classes .= ' col-lg-'. $field['columnWidth'];
    }

    return $classes;
}