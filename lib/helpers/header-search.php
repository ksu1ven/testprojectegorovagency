<?php
function hm_get_search_results( $search_query ) {
	$results_query = new WP_Query( [
		'post_type'      => array( 'post', 'page' ),
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		's'              => $search_query
	] );

	$results = array();

	if ( ! $results_query->have_posts() ) {
		wp_reset_postdata();

		return $results;
	}

	foreach ( $results_query->posts as $post ) {
		$results[] = array(
			'url'   => get_permalink( $post->ID ),
			'title' => hm_highlight_search_result( $post->post_title, $search_query ),
		);
	}

	wp_reset_postdata();

	return $results;
}

function hm_highlight_search_result( $haystack, $needle ) {
	if ( strlen($haystack) < 1 || strlen( $needle ) < 1 ) {
		return $haystack;
	}

	$matches ='';
	$haystack = preg_replace( "/($needle+)/i", '<strong>$1</strong>', $haystack );

	return $haystack;
}

add_action( 'wp_ajax_handle_header_search', 'hm_handle_header_search' );
add_action( 'wp_ajax_nopriv_handle_header_search', 'hm_handle_header_search' );
function hm_handle_header_search() {
	$search_query   = hm_request_param( 'search_query' );
	$search_results = hm_get_search_results( $search_query );

	if ( ! empty( $search_results ) ) {
		ob_start();
		?>

		<ul>
			<?php foreach( $search_results as $search_result ) : ?>
				<li>
					<a href="<?php echo esc_url( $search_result['url'] ); ?>">
						<?php echo $search_result['title']; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php
		$html = ob_get_clean();

		wp_send_json_success( $html );

		exit;
	}

	wp_send_json_error();

	exit;
}
