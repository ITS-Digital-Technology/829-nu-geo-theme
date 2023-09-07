<?php
/**
 * Functions
 * ---------------------------------------------------------------------------------------
 *
 * This file defines all functions that are intended to be used by developers,
 * and therefore are not hidden behind a class for simplicity.
 *
 * @package WordPress
 */

/**
 * Recursively include all files from specified directory (and it's subdirectories).
 *
 * @param string $dir       Directory to include all files from.
 * @param int    $max_depth Maximum depth allowed.
 * @param int    $depth     Number of levels below specified directory current recursive call is on.
 */
function recursive_include( $dir, $max_depth = 5, $depth = 0 ) {
	if ( $depth > $max_depth ) {
		return;
	}

	$scan = glob( $dir . DIRECTORY_SEPARATOR . '*' );
	foreach ( $scan as $path ) {
		if ( preg_match( '/\.php$/', $path ) ) {
			include_once $path;
		} elseif ( is_dir( $path ) ) {
			recursive_include( $path, $max_depth, $depth + 1 );
		}
	}
}

/**
 * Generate the heading for the archive pages based on which type of archive is being displayed.
 *
 * @return string|null Heading, or null if the type of archive is not recognized.
 */
function get_blog_heading() {
	if ( is_archive() ) {
		if ( is_day() ) {
			return __( 'Daily Archives:', 'northeasternUniversity' ) . get_the_date();
		} elseif ( is_month() ) {
			return __( 'Monthly Archives:', 'northeasternUniversity' ) . get_the_date( _x( 'F Y', 'monthly archives date format', 'northeasternUniversity' ) );
		} elseif ( is_year() ) {
			return __( 'Yearly Archives:', 'northeasternUniversity' ) . get_the_date( _x( 'Y', 'yearly archives date format', 'northeasternUniversity' ) );
		} elseif ( is_category() ) {
            return __( 'Category:', 'northeasternUniversity' ) . ' ' . single_cat_title( '', false );
        } elseif ( is_author() ) {
            $author_data = get_query_var( 'author_name' ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );

            return __( 'Author:', 'northeasternUniversity' ) . ' ' . $author_data->display_name;
        } elseif ( is_tag() ) {
            return __( 'Tag:', 'northeasternUniversity' ) . ' ' . single_tag_title( '', false );
        } else {
            return __( 'Blog Archives', 'northeasternUniversity' );
        }
	} elseif ( is_search() ) {
		return __( 'Search:', 'northeasternUniversity' ) . ' ' . get_search_query();
	}

	return null;
}

//Sample data for filter plugin (this should be formatted as an associative array)
//Read here for instructions: https://bitbucket.org/829studios/829-blog-category-filters-react/src/master/

// $eight29_filter_data = [
// 	"post" => [
// 		"category" => [
// 			"label" => "Categories",
// 			"type" => "button-group"
// 		]
// 	],
// 	"post_b" => [
// 		"tax_b1" => [
// 			"label" => "Tax 1",
// 			"type" => "select"
// 		],
// 		"tax_b2" => [
// 			"label" => "Tax 2",
// 			"type" => "select"
// 		]
// 	],
// 	"post_c" => [
// 		"tax_c1" => [
// 			"label" => "Tax 1",
// 			"type" => "checkbox"
// 		]
// 	],
// 	"post_d" => [
// 		"tax_d1" => [
// 			"label" => "Tax 1",
// 			"type" => "multi-select"
// 		],
// 		"tax_d2" => [
// 			"label" => "Tax 2",
// 			"type" => "multi-select"
// 		]
// 	]
// ];

//Pass data to filter plugin here

// if (class_exists('eight29_filters')) {
// 	$eight29_filters->set_post_data($eight29_filter_data);
// }

$program_type = get_field('td_program_program_type','options');
$program_country = get_field('td_program_country','options');
$program_term = get_field('td_program_term','options');
$program_field_of_study = get_field('td_program_field_of_study','options');
$program_track = get_field('td_program_program_track','options');
$program_city = get_field('td_program_city','options');
$program_region = get_field('td_program_region','options');
$program_class_type = get_field('td_program_class_type','options');

$eight29_filter_data = [
    "post" => [
        "post_topic" => [
            "label" => "Topics",
            "type" => "select",
            "dropdown" => false
        ],
        "post_program" => [
            "label" => "Programs",
            "type" => "select",
            "dropdown" => false
        ],
        "post_destination" => [
            "label" => "Destinations",
            "type" => "select",
            "dropdown" => false
        ],
    ],
    "news" => [
        "news_category" => [
            "label" => "",
            "type" => "button-group",
            "dropdown" => true
        ],
    ],
    "staff" => [
        "staff_category" => [
            "label" => "",
            //"type" => "accordion-single-select",
            "type" => "button-group",
            "dropdown" => true
        ],
    ],
	"program" => [
		"program_type" => [
			"label" => "Program Type",
            "type" => "select",
            "dropdown" => true,
            "terraDotta" => $program_type
		],
		"country" => [
			"label" => "Country",
			"type" => "select",
            "dropdown" => true,
            "terraDotta" => $program_country
        ],
        "term" => [
			"label" => "Term",
			"type" => "select",
            "dropdown" => true,
            "terraDotta" => $program_term
        ],
        "field_of_study" =>[
            "label" => "Field of Study",
			"type" => "select",
            "dropdown" => true,
            "terraDotta" => $program_field_of_study
        ],
        "program_track" => [
            "label" => "Program Track",
            "type" => "select",
            "dropdown" => true,
            "terraDotta" => $program_track
        ],
        "city" => [
            "label" => "City",
            "type" => "select",
            "dropdown" => true,
            "terraDotta" => $program_city
        ],
        "region" => [
            "label" => "Region",
            "type" => "select",
            "dropdown" => true,
            "terraDotta" => $program_region
        ],
        "class_type" => [
            "label" => "Class Type",
            "type" => "select",
            "dropdown" => true,
            "terraDotta" => $program_class_type
        ],
        "program_status" => [
            "label" => "Program Status",
            "type" => "select",
            "dropdown" => true,
            //"terraDotta" => $program_class_type
        ],
        "program_mode" => [
            "label" => "Program Mode",
            "type" => "select",
            "dropdown" => true,
            //"terraDotta" => $program_class_type
        ]
	],
];

//Pass data to filter plugin here
if (class_exists('eight29_filters')) {
    $eight29_filters->set_post_data($eight29_filter_data);
}

//Generate options from field data
function get_filter_names($field) {
    $field['choices'] = [];
    $data = [];

    $fields = [
        "program_type" => [
			"label" => "Program Type",
            "type" => "checkbox",
            "dropdown" => true,
            "terraDotta" => $program_type
		],
		"country" => [
			"label" => "Country",
			"type" => "checkbox",
            "dropdown" => true,
            "terraDotta" => $program_country
        ],
        "term" => [
			"label" => "Term",
			"type" => "checkbox",
            "dropdown" => true,
            "terraDotta" => $program_term
        ],
        "field_of_study" =>[
            "label" => "Field of Study",
			"type" => "checkbox",
            "dropdown" => true,
            "terraDotta" => $program_field_of_study
        ],
        "program_track" => [
            "label" => "Program Track",
            "type" => "checkbox",
            "dropdown" => true,
            "terraDotta" => $program_track
        ],
        "city" => [
            "label" => "City",
            "type" => "checkbox",
            "dropdown" => true,
            "terraDotta" => $program_city
        ],
        "region" => [
            "label" => "Region",
            "type" => "checkbox",
            "dropdown" => true,
            "terraDotta" => $program_region
        ],
        "class_type" => [
            "label" => "Class Type",
            "type" => "checkbox",
            "dropdown" => true,
            "terraDotta" => $program_class_type
        ],
        "program_status" => [
            "label" => "Program Status",
            "type" => "select",
            "dropdown" => true,
            //"terraDotta" => $program_class_type
        ],
        "program_mode" => [
            "label" => "Program Mode",
            "type" => "select",
            "dropdown" => true,
            //"terraDotta" => $program_class_type
        ]
    ];
  
    $filters = $fields;
  
    foreach($filters as $filter_name => $filter_info) {
        $data[$filter_name] = $filter_info['label'];
    }
  
    $field['choices'] = $data;
    return $field;
  }
  
  add_filter('acf/load_field/name=filter_name', 'get_filter_names');