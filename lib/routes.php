<?php

add_action( 'rest_api_init', 'hmt_rest_api_routes' );
function hmt_rest_api_routes() {

	# Namespace
	$namespace = 'api';

	# Header Search
	register_rest_route( $namespace, '/header_search/', [
		'methods' => 'GET',
		'callback' => 'hm_header_search',
	] );

	# Show More Posts
	register_rest_route( $namespace, '/load_equipment/', [
		'methods' => 'POST',
		'callback' => 'hm_load_equipment',
	] );

	register_rest_route( $namespace, '/load_resources/', [
		'methods' => 'POST',
		'callback' => 'hm_load_resources',
	] );
}

function hm_header_search ( WP_REST_Request $request ) {
	$search_query = (string)$request->get_param('search_query');

	echo $search_query;

	die;
}

function hm_load_equipment ( WP_REST_Request $request ) {
	global $wp_query;
    $page = (int)$request->get_param('page');

	$posts = get_posts(array(
		'post_type' => 'hm_equipment',
		'posts_per_page' => 8,
		'paged' => $page,
		'orderby' => 'date',
		'order' => 'DESC'
	));

	foreach ($posts as $post) {
		$id = $post->ID;
		$name = get_the_title( $id );
		$description = get_field( 'equipment_item_description', $id );
		$image_id = get_field( 'equipment_item_image', $id );
		$image_url = esc_url( wp_get_attachment_image_url( $image_id ) );

		$card_data = [
			'title' => $name,
			'description' => $description,
			'image_url' => $image_url,
		];

		get_template_part( 'fragments/motor-express-equipment/motor-express-equipment-card', '', $card_data );
	}

	die; // here we exit the script and even no wp_reset_query() required!
}

function hm_load_resources ( WP_REST_Request $request ) {
	global $wp_query;

	$tab_type = $request->get_param('tab_type');
	$page = (int)$request->get_param('page');
	$category_name = $request->get_param('category_name');

	$wp_query = new WP_Query( [
		'post_type' => 'post',
		'post_status' => array( 'publish' ),
		'posts_per_page' => $tab_type === 'video' ? 4 : 5,
		'paged' => $page,
		'tax_query' => [
			[
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $category_name
			]
		],
	] );

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			if ( 'video' === $tab_type ) {
				$category = get_terms( ['taxonomy' => 'category', 'slug' => $category_name] );

				get_template_part( 'fragments/media-resources/video-library-tab/video-library-card', '', ['active_category' => $category[0], 'post_id' => get_the_ID()] );
			} else {
				get_template_part( 'fragments/media-resources/posts-tab/post-card', '', ['post_id' => get_the_ID()] );
			}
		}
	}

	die;
}
