<?php
/**
 * Theme functions
 * ---------------------------------------------------------------------------------------
 *
 * This file prepares all functionality except theme templates. It automatically
 * includes php files used by theme, therefore no code should be added here.
 * Each piece of functionality should be added as a separate file in the `includes`
 * folder, and it will be automatically included and available in the theme.
 *
 * @package WordPress
 */

/*
 * Initialize the theme core
 */
require_once 'core/init.php';

/*
 * Include the widgets
 * ---------------------------------------------------------------------------------------
 *
 * We only include the files placed directly in the widgets folder. It is the widgets'
 * responsibility to include their own includes and manage their assets.
 *
 */
recursive_include( get_template_directory() . '/widgets', 0 );

//User added scripts in ACF fields
function userScripts($acf_field_name) {
  $in_footer = $acf_field_name === 'footer_scripts' ? true : false;

  if(have_rows($acf_field_name, 'option')): while(have_rows($acf_field_name, 'option')): the_row();

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

//Conditionally display the_content
function defaultContent() {
  if (get_the_content() !== "") {
    $content = '<section class="block-content default-content">
        <div class="container">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-8 offset-lg-2">
          '.get_the_content().'
          </div>
        </div>
      </div>
    </section>';

    $content = apply_filters('the_content', $content);
    echo $content;
  }
}
