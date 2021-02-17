<?php
//User added scripts in ACF fields
function userScripts($acf_field_name) {
  $in_footer = $acf_field_name === 'footer_scripts' ? true : false;

  $field = get_field( $acf_field_name, 'option' );
  if( ! empty( $field ) ): 
    while(have_rows($acf_field_name, 'option')): the_row();

    $script_name = get_sub_field('script_name');
    $script_name = str_replace(' ', '_', $script_name);
    $script_name = strtolower($script_name);
    $script_type = get_sub_field('script_type');

    if ($script_type === 'internal') {
      $script = get_sub_field('internal_script');
      wp_register_script($script_name, '', '', '', $in_footer);
      wp_enqueue_script($script_name);
      wp_add_inline_script($script_name, $script);
    }
    elseif ($script_type === 'external') {
      $script = get_sub_field('external_script');
      wp_enqueue_script($script_name, $script, '', '', $in_footer);
    }
  endwhile; endif;
}

function loadAssets() {
  userScripts('header_scripts');
  userScripts('footer_scripts');
}

add_action('wp_enqueue_scripts', 'loadAssets');