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
  
  wp_enqueue_style('theme-styles', get_stylesheet_directory_uri().'/css/style.css', NULL, filemtime(get_template_directory().'/css/style.css'));

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
  if (empty($data) || $data === NULL || $data === false || (is_array($data) && count($data) === 0)) {
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

function parse_api_data($url, $mode = 'all') {
  $ch = curl_init();
  $data = array();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  $result = curl_exec($ch);
  curl_close($ch);

  $result = str_replace('_cb_getProgramSearchResults(', '', $result);
  $result = str_replace('_cb_getProgramBrochure(', '', $result);
  $result = str_replace(');', '', $result);

  if ( 'all' === $mode ) {
    error_log('List of all programs requested from API');
    // Write data from API into a file
    $file_put_contents_results = file_put_contents(get_template_directory().'/program_data_from_api.json', $result);

    if ( false !== $file_put_contents_results ) {
      error_log('Downloaded programs to file');      
    }
  } else {
    error_log('Single program data requested from API');
  }

  $formatted = json_decode($result);
  return $formatted;
}

function create_programs_json() {
  $url = 'https://goglobal.northeastern.edu/piapi/index.cfm?callname=getProgramSearchResults&ResponseEncoding=json';

  // Get a list of all available programs
  $result = parse_api_data($url);

  if (file_exists(get_template_directory().'/program_data_from_api.json')) {
    $result = file_get_contents(get_template_directory().'/program_data_from_api.json');
    error_log('Loaded programs from file');
  }

  if ('' !== $result) {
    $formatted = json_decode($result);
    $programs = $formatted->PROGRAM;    
  }

  $batch_size = 50;
  $total_programs = count($programs);

  if ($total_programs > $batch_size) {
    $total_batches = ceil($total_programs / $batch_size);
    for ($i = 0; $i < $total_batches; $i++) {
      $offset = $i * $batch_size;
      $first_batch = $i === 0 ? true : false;
      $last_batch = $i + 1 === (int)$total_batches ? true : false;

      $programs_part = array();

      $schedule_time = strtotime('now') + $i * $batch_size * 3; // Schedule each batch with a delay calculated from processing a program every 3 seconds

      // Slice the programs array to get the desired part
      $programs_part = array_slice($programs, $offset, $batch_size);

      $event_scheduled = wp_schedule_single_event($schedule_time, 'process_programs_json_event', array($programs_part, $offset, $batch_size, $first_batch, $last_batch));

      if ( $event_scheduled ) {
        error_log('Event scheduled for batch # ' . $i);        
      } else {
        error_log('Event scheduling error for batch # ' . $i);
      }
    }
  }
}

add_action('process_programs_json_event', 'process_programs_json', 10, 5);

function process_programs_json( $programs, $offset, $batch_size, $first_batch, $last_batch ) {

  $first_batch_text = $first_batch ? 'yes' : 'no';
  $last_batch_text = $last_batch ? 'yes' : 'no';
  error_log( 'Started processing batch # ' . floor($offset / $batch_size) . ' , first batch: ' . $first_batch_text . ' , last batch: ' . $last_batch_text );

  $data = [];

  //Loop thru the program list and get details about each program and add those details to an array
  foreach ($programs as $program) {
    $program_url = 'https://goglobal.northeastern.edu/piapi/index.cfm?callName=getProgramBrochure&ResponseEncoding=JSON&Program_ID=';

    $program_id = $program->PROGRAM_ID;
    $api_url = $program_url.$program_id;
    $api_result = parse_api_data($api_url, 'program');
    $program_data = $api_result;

    if (is_object($api_result) && empty( (array)$api_result) ) {
        error_log( "Failed fetching API data for program with ID " . $program_id . ", batch " . floor($offset / $batch_size) );
    } else {
        error_log( "Successfully fetched API data for program with ID " . $program_id . ", batch " . floor($offset / $batch_size) );
    }

    $parameters = $program_data->DETAILS->PARAMETERS->PARAMETER;
    $terms = $program_data->DETAILS->TERMS->TERM;
    $program_id = $program_data->DETAILS->PROGRAM_ID;
    $program_link = 'https://goglobal.northeastern.edu/index.cfm?FuseAction=Programs.ViewProgramAngular&id='.$program_id;
    $locations = $program_data->DETAILS->LOCATIONS->LOCATION;
    $program_name = $program_data->DETAILS->PROGRAM_NAME;
    $program_deadline = false;
    $program_active = $program_data->DETAILS->PROGRAM_ACTIVE;
    $program_active = $program_active === 1 ? 'publish' : 'draft'; 

    if ( is_object ( $program_data->DETAILS->DATES ) ) {
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
    if (!isset($program_data->DETAILS)) {
        $program_data->DETAILS = new stdClass();
    }
    if (!isset($program_data->DETAILS->CUSTOM)) {
        $program_data->DETAILS->CUSTOM = new stdClass();
    }

    $program_data->DETAILS->CUSTOM->PROGRAM_NAME = check_data($program_name);
    $program_data->DETAILS->CUSTOM->PROGRAM_ID = check_data($program_id);
    $program_data->DETAILS->CUSTOM->PROGRAM_LINK = $program_link;
    $program_data->DETAILS->CUSTOM->PROGRAM_DEADLINE = $program_deadline;
    $program_data->DETAILS->CUSTOM->PROGRAM_ACTIVE = $program_active;
    $program_data->DETAILS->CUSTOM->LAST_UPDATED = $formatted_time;
    //$program_data->DETAILS->CUSTOM->FEATURED_IMAGE = $featured_image;

    if ($parameters) {
      $program_types = [];
      $fields_of_study = [];
      $partners = [];
      $program_mode = [];
      $program_tracks = [];
      $class_type = [];
      $program_status = '';
      $internship = false;

      foreach($parameters as $parameter) {
        if ( isset($parameter->PROGRAM_PARAM_TEXT) ) {
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
            array_push($program_mode, $parameter->PARAM_VALUE);
          }

          if ($parameter->PROGRAM_PARAM_TEXT === 'Program Tracks') {
            array_push($program_tracks, $parameter->PARAM_VALUE);
          }

          if ($parameter->PROGRAM_PARAM_TEXT === 'Colleges and Schools') {
            array_push($class_type, $parameter->PARAM_VALUE);
          }

          if ($parameter->PROGRAM_PARAM_TEXT === 'Program Status') {
            $program_status = $parameter->PARAM_VALUE;
          }

          if ($parameter->PROGRAM_PARAM_TEXT === 'Internship Available?' && $parameter->PARAM_VALUE === 'YES') {
            $internship = true;
          }
        }
      }

      $program_tracks = implode('| ', $program_tracks); //Has commas in it
      $program_data->DETAILS->CUSTOM->PROGRAM_TYPES = check_data($program_types) ? stringify($program_types) : false;
      $program_data->DETAILS->CUSTOM->FIELDS_OF_STUDY = check_data($fields_of_study) ? stringify($fields_of_study) : false;
      $program_data->DETAILS->CUSTOM->PARTNERS = check_data($partners);
      $program_data->DETAILS->CUSTOM->PROGRAM_MODE = check_data($program_mode) ? stringify($program_mode) : false;
      $program_data->DETAILS->CUSTOM->PROGRAM_TRACKS = check_data($program_tracks) ? $program_tracks : false;
      $program_data->DETAILS->CUSTOM->CLASS_TYPE = check_data($class_type) ? stringify($class_type) : false;
      $program_data->DETAILS->CUSTOM->PROGRAM_STATUS = check_data($program_status);
      $program_data->DETAILS->CUSTOM->INTERNSHIP = check_data($internship);
    }

    if ($terms) {
      $program_terms = [];

      if (isset($terms->PROGRAM_TERM)) {
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

      if (isset($locations->PROGRAM_COUNTRY) && $locations->PROGRAM_COUNTRY) {
        array_push($program_countries, $locations->PROGRAM_COUNTRY);
      }

      else {
        foreach($locations as $country) {
          array_push($program_countries, $country->PROGRAM_COUNTRY);
        }
      }

      if (isset($locations->PROGRAM_CITY) && $locations->PROGRAM_CITY) {
        array_push($program_cities, $locations->PROGRAM_CITY);
      }

      else {
        foreach($locations as $city) {
          array_push($program_cities, $city->PROGRAM_CITY);
        }
      }

      if (isset($locations->PROGRAM_REGION) && $locations->PROGRAM_REGION) {
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

  if ( $first_batch ) {
  // If this is the first batch, start writing to /data.json from scratch
    $batch_write_result = file_put_contents( get_template_directory().'/data.json', json_encode($data ) );
    if ( false !== $batch_write_result ) {
      error_log( 'Successully written batch # 1 data to the file' );
    } else {
      error_log( 'Error writing batch # 1 data to the file' );
    }
  } else {
    // If this is not the first batch, append to /data.json
    $current_data = file_get_contents(get_template_directory().'/data.json');
    $current_data = json_decode($current_data);
    $data = array_merge($current_data, $data);
    $batch_write_result = file_put_contents(get_template_directory().'/data.json', json_encode($data));

    if ( false !== $batch_write_result ) {
      error_log( 'Successully added batch # ' . floor($offset / $batch_size) . ' data to the file' );
    } else {
      error_log( 'Error adding batch # ' . floor($offset / $batch_size) . ' data to the file' );
    }
  }

  if ( $last_batch ) {
    // If this is the last batch, trigger the import
    error_log( 'This is the last batch, triggering import' );

    $trigger_url = get_field('wp_all_import_trigger_url', 'option');

    // error_log( 'Trigger URL: ' . esc_html( $trigger_url ) );

    $wp_remote_get_triggered = wp_remote_get($trigger_url);

    if ( is_array( $wp_remote_get_triggered ) && ! is_wp_error( $wp_remote_get_triggered ) ) {
      error_log( 'Remote get triggered for events, result: ' . json_encode( $wp_remote_get_triggered ) );
    } else {
      error_log( 'Error triggering remote get for events , result: ' . json_encode( $wp_remote_get_triggered ) );
    }
  } else {
    error_log( 'This is not the last batch' );
  }
}

add_action('terra_dotta_query', 'create_programs_json');

function ping_import() {
  $processing_url = get_field('wp_all_import_processing_url', 'option');
  wp_remote_get($processing_url);
}

add_action('processing_wp_all_import', 'ping_import');