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

function parse_api_data($url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  $result = curl_exec($ch);
  curl_close($ch);

  $result = str_replace('_cb_getProgramSearchResults(', '', $result);
  $result = str_replace('_cb_getProgramBrochure(', '', $result);
  $result = str_replace(');', '', $result);
  $formatted = json_decode($result);

  return $formatted;
}

function create_programs_json() {
  $url = 'https://goglobal.northeastern.edu/piapi/index.cfm?callname=getProgramSearchResults&ResponseEncoding=json';
  $program_url = 'https://goglobal.northeastern.edu/piapi/index.cfm?callName=getProgramBrochure&ResponseEncoding=JSON&Program_ID=';

  //Connect to API to get a list of all available programs
  $result = parse_api_data($url);
  $programs = $result->PROGRAM;
  $data = [];

  //Loop thru the program list and get details about each program and add those details to an array
  foreach ($programs as $program) {
    $program_id = $program->PROGRAM_ID;
    $api_url = $program_url.$program_id;
    $api_result = parse_api_data($api_url);
    array_push($data, $api_result);
  }

  //JSON format the array and dump into a JSON file for WP All Import to process
  $data = json_encode($data);
  file_put_contents(get_template_directory().'/data.json', $data);
}

add_action('terra_dotta_query', 'create_programs_json');