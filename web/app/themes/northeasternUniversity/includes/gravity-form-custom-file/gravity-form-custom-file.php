<?php
add_filter( 'gform_field_input', 'file_input', 10, 5 );
function file_input($input, $field) {
    if ( $field->type == 'fileupload' && !is_admin() ) {
        $id             = $field->id;
        $formId         = $field->formId;
        $max_file_sizes = $field->maxFileSize;
        $max_file_bytes = ! empty( $max_file_sizes ) ? $max_file_sizes * 1024 * 1024 : 128 * 1024 * 1024;
        $label          = __('No file chosen', 'northeasternUniversity');
        $label_button   = __('Choose File', 'northeasternUniversity');
        $id_input       =  "custom_input_${formId}_${id}";

        $input = "<div class='ginput_container ginput_container_fileupload'>
            <input name='input_${id}' id='${id_input}' class='custom-file' type='file' onchange='javascript:gformValidateFileSize( this, ${max_file_bytes} );'><label for='${id_input}' data-button='${label_button}'>${label}</label>
            <script>const ${id_input} = document.querySelector('#${id_input}');${id_input}.addEventListener('change', e => {const target = e.target;const fileName = target.files[0].name;target.nextElementSibling.innerHTML = fileName;});</script>
        </div>";
    }

    return $input;
}
