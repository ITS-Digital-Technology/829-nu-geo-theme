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

function load_assets() {
  wp_enqueue_style('neu-external-menu', 'https://unpkg.com/@northeastern-web/global-elements@^1.0.0/dist/css/index.css');

  wp_enqueue_script('neu-external-menu-global', 'https://unpkg.com/@northeastern-web/global-elements@^1.0.0/dist/js/index.umd.js', NULL, NULL, true);
  wp_enqueue_script('neu-external-menu-kernl', 'https://unpkg.com/@northeastern-web/kernl-ui@^2.0.0/dist/js/index.umd.js', NULL, NULL, true);
}

add_action('wp_enqueue_scripts', 'load_assets');

//Re-order staff post staff for REST API
add_filter(
  'rest_staff_collection_params',
  function( $params ) {
      $params['orderby']['enum'][] = 'menu_order';
      return $params;
  }, 10,1
);

function check_data($data) {
  if (empty($data) || $data === NULL || $data === false || count($data) === 0) {
    return false;
  }
  else {
    return $data;
  }
}

function stringify($array) {
  $data = implode(', ', $array);
  return $data;
}

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
    $program_data = $api_result;

    $parameters = $program_data->DETAILS->PARAMETERS->PARAMETER;
    $terms = $program_data->DETAILS->TERMS->TERM;
    $program_id = $program_data->DETAILS->PROGRAM_ID;
    $program_link = 'https://goglobal.northeastern.edu/index.cfm?FuseAction=Programs.ViewProgramAngular&id='.$program_id;
    $locations = $program_data->DETAILS->LOCATIONS->LOCATION;
    $program_name = $program_data->DETAILS->PROGRAM_NAME;
    $program_deadline = false;

    if ($program_data->DETAILS->DATES->DATE->APP_DEADLINE) {
      $program_deadline = $program_data->DETAILS->DATES->DATE->APP_DEADLINE;
    }
    else if ($program_data->DETAILS->DATES->DATE) {
      $deadlines = $program_data->DETAILS->DATES->DATE;
      $deadline_array = [];

      foreach($deadlines as $deadline) {
        array_push($deadline_array, $deadline->APP_DEADLINE);
      }

      if (count($deadline_array) > 0) {
        $program_deadline = $deadline_array[0];
      }
    }

    // $featured_image = $program_name;
    // $featured_image = strtolower($featured_image);
    // $featured_image = str_replace('-', '_', $featured_image);
    // $featured_image = str_replace(' ', '_', $featured_image);
    // $featured_image = str_replace('_', '-', $featured_image);
    // $featured_image = $featured_image.'.jpg';

    //Format the last updated time
    $current_time = date("F d, Y g:i A");
    $timezone = new DateTimeZone('America/New_York');
    $formatted_time = new DateTime($current_time);
    $formatted_time->setTimeZone($timezone);

    //Add all of the data needed into the "custom" object
    $program_data->DETAILS->CUSTOM->PROGRAM_NAME = check_data($program_name);
    $program_data->DETAILS->CUSTOM->PROGRAM_ID = check_data($program_id);
    $program_data->DETAILS->CUSTOM->PROGRAM_LINK = $program_link;
    $program_data->DETAILS->CUSTOM->PROGRAM_DEADLINE = $program_deadline;
    $program_data->DETAILS->CUSTOM->LAST_UPDATED = $formatted_time;
    //$program_data->DETAILS->CUSTOM->FEATURED_IMAGE = $featured_image;

    if ($parameters) {
      $program_types = [];
      $fields_of_study = [];
      $partners = [];
      $program_mode = '';
      $internship = false;

      foreach($parameters as $parameter) {
        if ($parameter->PROGRAM_PARAM_TEXT === 'Global Program Type') {
          array_push($program_types, $parameter->PARAM_VALUE);
        }

        if ($parameter->PROGRAM_PARAM_TEXT === 'Fields of Study') {
          $string = $parameter->PARAM_VALUE;
          $string = preg_replace("/[^A-Za-z :]/", '', $string);
          array_push($fields_of_study, $string); //API has whitespace in it
        }

        if ($parameter->PROGRAM_PARAM_TEXT === 'Partner Institution') {
          array_push($partners, $parameter->PARAM_VALUE);
        }

        if ($parameter->PROGRAM_PARAM_TEXT === 'Program Mode') {
          $program_mode = $parameter->PARAM_VALUE;
        }

        if ($parameter->PROGRAM_PARAM_TEXT === 'Internship Available?' && $parameter->PARAM_VALUE === 'YES') {
          $internship = true;
        }
      }

      $program_data->DETAILS->CUSTOM->PROGRAM_TYPES = check_data($program_types) ? stringify($program_types) : false;
      $program_data->DETAILS->CUSTOM->FIELDS_OF_STUDY = check_data($fields_of_study) ? stringify($fields_of_study) : false;
      $program_data->DETAILS->CUSTOM->PARTNERS = check_data($partners);
      $program_data->DETAILS->CUSTOM->PROGRAM_MODE = check_data($program_mode);
      $program_data->DETAILS->CUSTOM->INTERNSHIP = check_data($internship);
    }

    if ($terms) {
      $program_terms = [];

      if ($terms->PROGRAM_TERM) {
        array_push($program_terms, $terms->PROGRAM_TERM);
      }

      else {
        foreach($terms as $term) {
          array_push($program_terms, $term->PROGRAM_TERM);
        }
      }

      $program_data->DETAILS->CUSTOM->TERMS = check_data($program_terms) ? stringify($program_terms) : false;
    }

    if ($locations) {
      $program_countries = [];
      $program_cities = [];
      $program_regions = [];

      if ($locations->PROGRAM_COUNTRY) {
        array_push($program_countries, $locations->PROGRAM_COUNTRY);
      }

      else {
        foreach($locations as $country) {
          array_push($program_countries, $country->PROGRAM_COUNTRY);
        }
      }

      if ($locations->PROGRAM_CITY) {
        array_push($program_cities, $locations->PROGRAM_CITY);
      }

      else {
        foreach($locations as $city) {
          array_push($program_cities, $city->PROGRAM_CITY);
        }
      }

      if ($locations->PROGRAM_REGION) {
        array_push($program_regions, $locations->PROGRAM_REGION);
      }

      else {
        foreach($locations as $city) {
          array_push($program_regions, $city->PROGRAM_REGION);
        }
      }

      $program_data->DETAILS->CUSTOM->COUNTRIES = check_data($program_countries) ? stringify($program_countries) : false;
      $program_data->DETAILS->CUSTOM->CITIES = check_data($program_cities) ? stringify($program_cities) : false;
      $program_data->DETAILS->CUSTOM->REGIONS = check_data($program_regions) ? stringify($program_regions) : false;
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