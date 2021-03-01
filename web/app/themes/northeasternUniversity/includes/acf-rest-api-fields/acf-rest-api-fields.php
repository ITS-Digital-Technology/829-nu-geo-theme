<?php
// Default Options
function get_acf_data() {
	$acf_program_card_image = wp_get_attachment_image( get_field( 'program_default_img', 'options' ), 'thumbnail-card' );
	$acf_post_card_image    = wp_get_attachment_image( get_field( 'default_post_thumbnail', 'options' ), 'thumbnail-card' );
	$acf_news_card_image    = wp_get_attachment_image( get_field( 'default_news_thumbnail', 'options' ), 'thumbnail-card' );
	$acf_staff_card_image   = wp_get_attachment_image( get_field( 'staff_default_image', 'options' ), 'staff-card' );
	$acf_blog_newsletter    = get_field( 'blog_newsletter', 'options' );
	$acf_news_newsletter    = get_field( 'news_newsletter', 'options' );
	$acf_search             = get_field( 'search_information', 'options' );

	$cta_data['acf_search']             = $acf_search;
	$cta_data['acf_program_card_image'] = $acf_program_card_image;
	$cta_data['acf_post_card_image']    = $acf_post_card_image;
	$cta_data['acf_blog_newsletter']    = $acf_blog_newsletter;
	$cta_data['acf_news_card_image']    = $acf_news_card_image;
	$cta_data['acf_staff_card_image']   = $acf_staff_card_image;
	$cta_data['acf_news_newsletter']    = $acf_news_newsletter;

	return $cta_data;
}

function endpoint_acf_fields() {
	register_rest_route(
		'eight29/v1',
		'/acf_data',
		[
			'methods'  => 'GET',
			'callback' => 'get_acf_data',
		]
	);
}

add_action( 'rest_api_init', 'endpoint_acf_fields' );



// PROGRAM
function acf_program_card_link( $response, $post, $request ) {
	if ( ! function_exists( 'get_fields' ) ) {
		return $response;
	}
	if ( isset( $post ) ) {
		$acf_program_card_link                   = get_field( 'program_link', $post );
		$response->data['acf_program_card_link'] = $acf_program_card_link;
	}
	return $response;
}
add_filter( 'rest_prepare_program', 'acf_program_card_link', 10, 3 );

function acf_program_card_app_deadline( $response, $post, $request ) {
	if ( ! function_exists( 'get_fields' ) ) {
		return $response;
	}
	if ( isset( $post ) ) {
		$acf_program_card_app_deadline                   = get_field( 'program_application_deadline', $post );
		$response->data['acf_program_card_app_deadline'] = $acf_program_card_app_deadline;
	}
	return $response;
}
add_filter( 'rest_prepare_program', 'acf_program_card_app_deadline', 10, 3 );

function acf_program_card_program_status( $response, $post, $request ) {
	if ( ! function_exists( 'get_fields' ) ) {
		return $response;
	}
	if ( isset( $post ) ) {
		$acf_program_card_program_status                   = get_field( 'program_status', $post );
		$response->data['acf_program_card_program_status'] = $acf_program_card_program_status;
	}
	return $response;
}
add_filter( 'rest_prepare_program', 'acf_program_card_program_status', 10, 3 );


// STAFF
function acf_staff_postion( $response, $post, $request ) {
	if ( ! function_exists( 'get_fields' ) ) {
		return $response;
	}
	if ( isset( $post ) ) {
		$acf_single_staff_position                   = get_field( 'single_staff_position', $post );
		$response->data['acf_single_staff_position'] = $acf_single_staff_position;
	}
	return $response;
}
add_filter( 'rest_prepare_staff', 'acf_staff_postion', 10, 3 );


// custom search endpoint
function northeasternUniversity_register_search_route() {
	register_rest_route(
		'custom-search/v1',
		'/search',
		[
			'methods'  => WP_REST_Server::READABLE,
			'callback' => 'northeasternUniversity_ajax_search',
			'args'     => northeasternUniversity_get_search_args(),
		]
	);
}
add_action( 'rest_api_init', 'northeasternUniversity_register_search_route' );

function northeasternUniversity_get_search_args() {
	$args             = [];
	$args['s']        = [
		'description' => esc_html__( 'The search term.', 'northeasternUniversity' ),
		'type'        => 'string',
	];
	$args['per_page'] = [
		'description' => esc_html__( 'Posts per page.', 'northeasternUniversity' ),
		'type'        => 'string',
	];
	$args['page']     = [
		'description' => esc_html__( 'Page.', 'northeasternUniversity' ),
		'type'        => 'string',
	];
	return $args;
}

function northeasternUniversity_ajax_search( $request ) {
	$posts         = [];
	$results       = [];
	$exclude_posts = [];

	// hide_from_search
	$args = array(
		'post_type'      => [ 'page', 'post', 'news', 'staff', 'program' ],
		'posts_per_page' => -1,
	);

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {

		while ( $query->have_posts() ) :
			$query->the_post();
			$id               = get_the_ID();
			$hide_from_search = get_field( 'hide_from_search', $id );
			if ( $hide_from_search === true ) {
				$exclude_posts[] = $id;
			}
		endwhile;
		wp_reset_postdata();
	}

	$args = array(
		'post_type'      => [ 'page', 'post', 'news', 'staff', 'program' ],
		'paged'          => $request['page'],
		'posts_per_page' => $request['per_page'],
		's'              => $request['s'],
		'post__not_in'   => $exclude_posts,
	);

	$query = new WP_Query( $args );

	if ( empty( $query->posts ) ) {
		return new WP_Error( 'no_posts', __( 'No post found' ), array( 'status' => 404 ) );
	}

	$max_pages = $query->max_num_pages;
	$total     = $query->found_posts;

	while ( $query->have_posts() ) {
		$query->the_post();
		$id             = get_the_ID();
		$title          = get_the_title( $id );
		$post_type      = get_post_type( $id );
		$content        = get_the_content( $id );
		$excerpt        = get_the_excerpt( $id );
		$permalink      = get_the_permalink( $id );
		$featured_image = wp_get_attachment_image( get_post_thumbnail_id( $id ), 'search-thumbnail' );
		$link           = '';
		if ( $post_type === 'program' ) {
			$link = get_field( 'program_link', $id )['url'];
			$cat  = get_primary_taxonomy_term( $id, 'program_type' )['title'];
		} elseif ( $post_type === 'staff' ) {
			$cat = get_primary_taxonomy_term( $id, 'staff_category' )['title'];
		} elseif ( $post_type === 'news' ) {
			$cat = get_primary_taxonomy_term( $id, 'news_category' )['title'];
		} elseif ( $post_type === 'post' ) {
			$cat = get_primary_taxonomy_term( $id, 'post_content_type' )['title'];
		} else {
			$cat = '';

		}
		array_push(
			$results,
			array(
				'id'             => $id,
				'title'          => $title,
				'permalink'      => $permalink,
				'post_type'      => $post_type,
				'content'        => $content,
				'excerpt'        => $excerpt,
				'featured_image' => $featured_image,
				'link'           => $link,
				'cat'            => $cat,

			)
		);
	}

	$response = new WP_REST_Response( $results, 200 );

	$response->header( 'X-WP-Total', $total );
	$response->header( 'X-WP-TotalPages', $max_pages );

	return $response;

}
