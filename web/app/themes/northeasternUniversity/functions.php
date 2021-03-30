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
  $all_program_data = [];

  //Loop thru the program list and get details about each program and add those details to an array
  foreach ($programs as $program) {
    $program_id = $program->PROGRAM_ID;
    $api_url = $program_url.$program_id;
    $api_result = parse_api_data($api_url);
    $program_data = $api_result;

    $parameters = $program_data->DETAILS->PARAMETERS->PARAMETER;
    //TODO: VAR for terms;

    if ($parameters) {
      $program_types = [];
      $fields_of_study = [];
      $partners = [];
      $internship = false;

      foreach($parameters as $parameter) {
        if ($parameter->PROGRAM_PARAM_TEXT === 'Global Program Type' ) {
          array_push($program_types, $parameter->PARAM_VALUE);
        }

        if ($parameter->PROGRAM_PARAM_TEXT === 'Fields of Study' ) {
          array_push($fields_of_study, $parameter->PARAM_VALUE);
        }

        if ($parameter->PROGRAM_PARAM_TEXT === 'Partner Institution' ) {
          array_push($partners, $parameter->PARAM_VALUE);
        }

        if ($parameter->PROGRAM_PARAM_TEXT === 'Internship Available?' && $parameter->PARAM_VALUE === 'YES' ) {
          $internship = true;
        }
      }

      $program_data->DETAILS->CUSTOM->PROGRAM_TYPE = $program_types;
      $program_data->DETAILS->CUSTOM->FIELDS_OF_STUDY = $fields_of_study;
      $program_data->DETAILS->CUSTOM->PARTNERS = $partners;
      $program_data->DETAILS->CUSTOM->INTERNSHIP = $internship;
    }

    array_push($data, $program_data);
  }

  //JSON format the array and dump into a JSON file for WP All Import to process
  $data = json_encode($data);
  file_put_contents(get_template_directory().'/data.json', $data);

  //Trigger Import for WP All Import
  $trigger_url = get_field('wp_all_import_trigger_url', 'option');
  wp_remote_get($trigger_url);
}

add_action('terra_dotta_query', 'create_programs_json');

function ping_import() {
  $processing_url = get_field('wp_all_import_processing_url', 'option');
  wp_remote_get($processing_url);
}

add_action('processing_wp_all_import', 'ping_import');