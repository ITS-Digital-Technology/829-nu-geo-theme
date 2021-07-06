<?php
/**
* Plugin Name: 829 Blog & Category Filters (React)
* Plugin URI: https://829llc.com
* Description: Display posts asynchronously with filters via React & WP Rest API.  Render posts with shortcode: [eight29_filters]
* Version: 1.2.8
* Author: Chris Roberts
* Author URI: https://829llc.com
**/

defined('ABSPATH') or die();

class eight29_filters {
  public $post_data;

  function __construct() {
    $this->post_data = [
      "post" => [
        "category" => [
          "label" => "Categories", 
          "type" => "select" 
        ]
      ]
    ];

    $this->init();
  }

  function set_post_data($data) {
    $this->post_data = $data;
  }

  function get_post_data() {
    return $this->post_data;
  }

  function post_types() {
    $data = $this->get_post_data();
    $post_types = [];

    if ($data) {
      foreach($data as $post_type => $post_type_value) {
        array_push($post_types, $post_type);
      }
    }

    $this->endpoint_meta_params($post_types);
    
    return $post_types;
  }

  //Adds support for meta queries in Rest API
  public function endpoint_meta_params($post_types) {
    foreach($post_types as $post_type) {
      add_filter('rest_'.$post_type.'_query', function($args, $request) {
        $query_string = $request->get_query_params();
        $queries = [];
  
        foreach($query_string as $query_id => $query_value) {
          if(strpos($query_id, 'meta_key_') !== false) {
            $id = str_replace('meta_key_', '', $query_id);
            $values = explode(',', $query_string['meta_value_'.$id]);
  
            array_push($queries, [
              'key' => $id,
              'value' => $values,
              'compare' => 'IN'
            ]);
          }
        }
  
        if (!empty($queries)) {
          $args += [
            'relation' => 'AND',
            'meta_query' => [
                $queries
            ]
          ];
        }
    
        return $args;
      }, 99, 2);
    }
  }


  public function get_the_sizes() {
    $values = [];
    $sizes = get_intermediate_image_sizes();

    foreach($sizes as $size) {
      $values[$size] = $size;
    }
    
    return $values;
  }

  //Enqueue Scripts & Styles
  public function load_assets() {
    $theme_url = get_stylesheet_directory_uri().'/eight29-filters/dist/';
    $theme_path = get_template_directory().'/eight29-filters/dist/';
    $theme_js_path = $theme_path.'/index.js';
    $theme_css_path = $theme_path.'/style.css';

    $plugin_path = plugin_dir_url(__FILE__).'/dist/';
    $plugin_js_path = $plugin_path.'/index.js';
    $plugin_css_path = $plugin_path.'/style.css';

    $js_path = $plugin_js_path;
    $css_path = $plugin_css_path;

    if (file_exists($theme_js_path) && file_exists($theme_css_path)) {
      $js_path = $theme_url.'/index.js';
      $css_path = $theme_url.'/style.css';
    }

    $params = [
      'plugin_url' => plugin_dir_url(__FILE__),
      'home_url' => home_url()
    ];

    wp_enqueue_style('eight29_style', $css_path, null, '1.0');
    wp_enqueue_script('eight29_assets', $js_path, null, '1.0', true);
    wp_localize_script('eight29_assets', 'wp', $params);
  }

  public function register_shortcode($atts) {
    $atts = shortcode_atts(
      array(
        'post_type' => '',
        'posts_per_row' => '',
        'posts_per_page' => '',
        'taxonomy' => '',
        'term_id' => '',
        'exclude_posts' => '',
        'tax_relation' => '',
        'mobile_style' => '',
        'display_sidebar' => '',
        'display_author' => '',
        'display_excerpt' => '',
        'display_date' => '',
        'display_post_counts' => '',
        'display_categories' => '',
        'display_selected' => '',
        'display_results' => '',
        'display_reset' => '',
        'display_search' => '',
        'display_sort' => '',
        'hide_uncategorized' => '',
        'pagination_style' => '',
        'order_by' => '',
        'remember_filters' => '',
        'layout' => ''
      ),
      $atts
    );

    return '<div class="eight29-filters"
    data-layout="'.$atts['layout'].'" 
    data-remember-filters="'.$atts['remember_filters'].'" 
    data-post-type="'.$atts['post_type'].'" 
    data-posts-per-row="'.$atts['posts_per_row'].'" 
    data-posts-per-page="'.$atts['posts_per_page'].'" 
    data-taxonomy="'.$atts['taxonomy'].'" 
    data-term-id="'.$atts['term_id'].'"
    data-exclude-posts="'.$atts['exclude_posts'].'"
    data-tax-relation="'.$atts['tax_relation'].'"
    data-mobile-style="'.$atts['mobile_style'].'"
    data-order-by="'.$atts['order_by'].'"
    data-pagination-style="'.$atts['pagination_style'].'"
    data-display-sidebar="'.$atts['display_sidebar'].'"
    data-display-post-counts="'.$atts['display_post_counts'].'"
    data-display-selected="'.$atts['display_selected'].'"
    data-display-excerpt="'.$atts['display_excerpt'].'"
    data-display-author="'.$atts['display_author'].'"
    data-display-date="'.$atts['display_date'].'"
    data-display-categories="'.$atts['display_categories'].'"
    data-display-results="'.$atts['display_results'].'"
    data-display-reset="'.$atts['display_reset'].'"
    data-display-search="'.$atts['display_search'].'"
    data-display-sort="'.$atts['display_sort'].'"
    data-hide-uncategorized="'.$atts['hide_uncategorized'].'"
    ></div>';
  }

  public function get_meta_list($meta_key, $post_type) {
    $data = [];
    $i = 0;
    $args = [
      'post_type' => $post_type,
      'numberposts' => -1,
      'meta_key' => $meta_key
    ];

    $values = [];

    $posts = get_posts($args);

    foreach ($posts as $post) {
      $value = get_field($meta_key, $post->ID);

      if (!in_array($value, $values)) {
        array_push($data, [
          'id' => $i,
          'name' => $value,
          'slug' => str_replace(' ', '-', strtolower($value)),
          'taxonomy' => $meta_key
        ]);
      }
    
      array_push($values, $value);
      $i++;
    }

    return $data;
  }

  public function get_filter_list($term, $post_type) {
    $data = [];

    if ($term === 'author') {
      $authors = get_users();

      foreach($authors as $author) {
        array_push($data, [
          'id' => $author->ID,
          'description' => $author->description,
          'name' => $author->display_name,
          'slug' => $author->user_login,
          'taxonomy' => $term,
          'parent'=> 0,
          'count' => [],
          'children' => []
        ]);
      }
    }

    if ($term === 'date') {
      $args = [
        'post_type' => $post_type,
        'numberposts' => -1,
      ];

      $dates = get_posts($args);
      $data_array = [];

      foreach($dates as $date) {
        array_push($data_array, get_the_date('Y-m', $date->ID));
      }

      $data_array = array_unique($data_array);
      foreach($data_array as $id => $date) {
        $month = date('F Y', strtotime($date));
        $start = date('Y-m-d\TH:i:s', strtotime($date));
        $end = date('Y-m-t\TH:i:s', strtotime($date));

        array_push($data, [
          'id' => $id,
          'name' => $month,
          'slug' => $date,
          'taxonomy' => $term,
          'parent' => 0,
          'count' => 0,
          'children' => [],
          'after' => $start,
          'before' => $end
        ]);
      }

      //$data = $data_array;
    }

    else {
      $args = [
        'taxonomy' => $term,
        'parent' => 0,
        'hide_empty' => false
      ];
      
      $categories = get_terms($args);
      
      foreach($categories as $category) {
        array_push($data, [
          'id' => $category->term_id,
          'description' => $category->description,
          'name' => html_entity_decode($category->name),
          'slug' => $category->slug,
          'taxonomy' => $category->taxonomy,
          'parent' => $category->parent,
          'count' => $category->count,
          'children' => eight29_filters::get_cat_children($category->taxonomy, $category->term_id)
        ]);
      }
    }
    
    return $data;
  }

  public function get_cat_children($taxonomy, $id) {
    $child_data = [];

    $children = get_terms([
      'hide_empty' => false,
      'taxonomy' => $taxonomy,
      'child_of' => $id
    ]);

    if ($children) {
      foreach ($children as $child) {
        array_push($child_data, [
          'id' => $child->term_id,
          'description' => $child->description,
          'name' => html_entity_decode($child->name),
          'slug' => $child->slug,
          'taxonomy' => $child->taxonomy,
          'parent' => $child->parent,
          'count' => $child->count,
          'children' => eight29_filters::get_cat_children($child->taxonomy, $child->term_id)
        ]);
      }
    }

    return $child_data;
  }

  public function get_data($data) {
    $terms = [];
    $post_data = eight29_filters::get_post_data();

    if ($post_data) {
      foreach($post_data as $post_type => $post_type_value) { //post type
        if ($post_type === $data['post_type']) {
          foreach ($post_type_value as $term => $term_value) { //taxonomy
            $meta_query = false;

            foreach($term_value as $term_detail => $term_detail_value) { //label + type + etc
              $terms[$term][$term_detail] = $term_detail_value;
              
              if ($term_detail === 'meta_query') {
                $meta_query = true;
              }
            }

            if ($meta_query) {
              $terms[$term]['terms'] = eight29_filters::get_meta_list($term, $data['post_type']);
            }
            else {
              if (count(eight29_filters::get_filter_list($term, $data['post_type'])) > 0) { //remove taxonomies with 0 terms
                $terms[$term]['terms'] = eight29_filters::get_filter_list($term, $data['post_type']);
              }
            }
          }
        }
      }
    }

    return $terms;
  }

  public function endpoint_categories() {
    register_rest_route( 'eight29/v1', '/filters/(?P<post_type>\S+)',[
      'methods'             => 'GET',
      'callback'            => [$this, 'get_data'],
      'permission_callback' => '__return_true'
    ]);
  }

  public function endpoint_post_types() {
    register_rest_route( 'eight29/v1', '/post-types',[
      'methods'             => 'GET',
      'callback'            => [$this, 'post_types'],
      'permission_callback' => '__return_true'
    ]);
  }

  public function endpoint_custom_fields() {
    $post_types = eight29_filters::post_types();

    function srcset_data($object, $field_name, $request) {
      $image_sizes = get_intermediate_image_sizes();
      $data = [];

      if ($image_sizes) {
        foreach($image_sizes as $image_size => $image_size_value) {
          $data[$image_size_value] = wp_get_attachment_image_srcset($object['featured_media'], $image_size_value);
        }
      }

      return $data;
    }

    function staff_endpoint_details($object, $field_name, $request) {
      $data = [];
      $data['job_title'] = get_field('job_title', $object['id']);

      return $data;
    }

    register_rest_field(
      $post_types,
      'featured_image_srcset',
      array(
          'get_callback'    => 'srcset_data',
          'update_callback' => null,
          'schema'          => null,
      )
    );
    
    register_rest_field(
      ['staff'],
      'staff_details',
      array(
          'get_callback'    => 'staff_endpoint_details',
          'update_callback' => null,
          'schema'          => null,
      )
    );

    register_rest_field(
      $post_types,
      'author',
      array(
          'get_callback'    => function() {
              return get_the_author();
          },
          'update_callback' => null,
          'schema'          => null,
      )
    );

    register_rest_field(
      $post_types,
      'formatted_date',
      array(
          'get_callback'    => function() {
              return get_the_date();
          },
          'update_callback' => null,
          'schema'          => null,
      )
    );
  }

  public function image_sizes() {
    add_image_size('eight29_post_thumb', 810, 464, true);
    add_image_size('eight29_staff', 600, 560, true);
  }

  private function updater() {
    require 'plugin-update-checker/plugin-update-checker.php';
    $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
      'https://bitbucket.org/829studios/829-blog-category-filters-react',
      __FILE__,
      'eight29-filters-react'
    );

    //Optional: If you're using a private repository, create an OAuth consumer
    //and set the authentication credentials like this:
    //Note: For now you need to check "This is a private consumer" when
    //creating the consumer to work around #134:
    // https://github.com/YahnisElsts/plugin-update-checker/issues/134
    $myUpdateChecker->setAuthentication(array(
      'consumer_key' => 'yzXwvRq699XscypYPk',
      'consumer_secret' => 'nbzNy3ZLaUKGkwBHZqpATX9zaSU69BK6',
    ));

    //Optional: Set the branch that contains the stable release.
    $myUpdateChecker->setBranch('master');
  }

  public function init() {
    add_action('wp_enqueue_scripts', [$this, 'load_assets']);
    add_shortcode('eight29_filters', [$this, 'register_shortcode']);
    add_action('rest_api_init', [$this, 'endpoint_post_types']);
    add_action('rest_api_init', [$this, 'endpoint_categories']);
    add_action('rest_api_init', [$this, 'endpoint_custom_fields']);
    $this->image_sizes();
    $this->updater();
  }
}

$eight29_filters = new eight29_filters();
?>