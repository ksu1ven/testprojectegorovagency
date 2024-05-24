<?php

/**
 * A safer alternative of $_REQUEST - only for $_GET and $_POST
 * @param  string $key the name of the requested parameter
 * @return the requested parameter value
 */
function hm_request_param($key = '') {
	$value = false;
	if (!$key) {
		return $value;
	}

	if ( isset($_POST[$key]) ) {
		$value = $_POST[$key];
	} elseif ( isset($_GET[$key]) ) {
		$value = $_GET[$key];
	}

	return $value;
}

function hm_convert_path_to_url($path) {
	if ( stripos( $path, '://' ) === false ) {
		$url = str_replace(
			array(
				ABSPATH,
				DIRECTORY_SEPARATOR
			),
			array(
				trailingslashit( get_bloginfo('url') ),
				'/'
			),
			$path
		);

		return $url;
	}

	return $path;
}

function hm_convert_url_to_path($url) {
	if ( stripos( $url, '://' ) !== false ) {
		$path = str_replace( get_bloginfo('url'), ABSPATH, $url );

		return $path;
	}

	return $url;
}

function hm_sanitize_phone_number_for_href($phone) {
	return preg_replace('~[^0-9]~', '', $phone);
}

function hm_maybe_add_target_attr_to_link($link) {
	$link_parts = parse_url( $link );
	$site_link_parts = parse_url( get_bloginfo('url') );

	if ( $link_parts['host'] != $site_link_parts['host'] ) {
		return 'target="_blank"';
	}
}

function hm_render_button( $button = [], $button_class = 'btn' ) {
	if ( empty( $button['url'] ) || empty( $button['title'] ) ) {
		return;
	}

	ob_start();
	?>

	<a href="<?php echo esc_url( $button['url'] ); ?>" class="<?php echo esc_attr( $button_class ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>" rel="noopener">
		<?php echo esc_html( $button['title'] ); ?>
	</a>

	<?php
	return ob_get_clean();
}

function hm_get_google_maps_api_key() {
	$api_key = get_field( 'google_maps_api_key', 'option' );

	return $api_key;
}

function hm_parse_blocks( $blocks = array() ) {
	global $post;

	if ( isset( $post->post_content ) && has_blocks( $post->post_content ) ) {
		$post_content_blocks = parse_blocks( $post->post_content );

		if ( ! empty( $post_content_blocks ) ) {
			$post_content_blocks = wp_list_pluck( $post_content_blocks, 'blockName' );
		}

		return count( array_intersect( $blocks, $post_content_blocks ) ) > 0 ? true : false;
	}

	return false;
}

/**
 * Replace a character with an HTML tag...
 *
 * @return string
 */

function hm_replace_char_with( $value, $char, $tagname, $new_lines = true ) {
	$regex = '~' . preg_quote( $char ) . '(.+?)' . preg_quote( $char ) . '~';

	if ( $new_lines ) {
		return nl2br( preg_replace( $regex, "<${tagname}>$1</${tagname}>", $value ) );
	}

	return preg_replace( $regex, "<${tagname}>$1</${tagname}>", $value );
}

/**
 * @param mixed $id Image ID
 *
 * @return bool
 */
function hm_is_svg_image( $id ) : bool {
	return false !== strstr(get_post_mime_type($id), 'image/svg');
}
